#!/bin/bash
# Script simple pour corriger APP_KEY sur le serveur de production
# Usage: ./fix-app-key-server.sh

set -e

echo "🔧 Correction de APP_KEY..."
echo ""

# Vérifier qu'on est dans le bon répertoire
if [ ! -f "artisan" ]; then
    echo "❌ Erreur: Ce script doit être exécuté depuis le répertoire racine Laravel"
    exit 1
fi

# Vérifier si on est dans Docker ou sur l'hôte
if [ -f "docker-compose.yml" ] && command -v docker &> /dev/null; then
    USE_DOCKER=true
    if docker compose version &> /dev/null; then
        COMPOSE_CMD="docker compose"
    elif docker-compose version &> /dev/null; then
        COMPOSE_CMD="docker-compose"
    else
        USE_DOCKER=false
    fi
else
    USE_DOCKER=false
fi

if [ "$USE_DOCKER" = true ]; then
    echo "🐳 Mode Docker détecté"
    CONTAINER_NAME=$(docker ps --format "{{.Names}}" | grep -E "v75|app" | head -1 || echo "")
    if [ -z "$CONTAINER_NAME" ]; then
        echo "⚠️  Aucun conteneur trouvé, utilisation du mode hôte"
        USE_DOCKER=false
    else
        echo "✅ Conteneur trouvé: $CONTAINER_NAME"
        DOCKER_EXEC="docker exec $CONTAINER_NAME"
    fi
fi

# Vérifier que .env existe
if [ "$USE_DOCKER" = true ]; then
    if ! $DOCKER_EXEC test -f .env; then
        echo "⚠️  Fichier .env introuvable dans le conteneur, création..."
        if $DOCKER_EXEC test -f .env.example; then
            $DOCKER_EXEC cp .env.example .env
        else
            $DOCKER_EXEC touch .env
        fi
    fi
else
    if [ ! -f ".env" ]; then
        echo "⚠️  Fichier .env introuvable, création..."
        if [ -f ".env.example" ]; then
            cp .env.example .env
        else
            touch .env
        fi
    fi
fi

# Supprimer l'ancienne clé invalide
echo "🗑️  Suppression de l'ancienne clé APP_KEY..."
if [ "$USE_DOCKER" = true ]; then
    $DOCKER_EXEC sed -i '/^APP_KEY=/d' .env 2>/dev/null || true
else
    sed -i '/^APP_KEY=/d' .env 2>/dev/null || true
fi

# Vider le cache de configuration (CRITIQUE!)
echo "🧹 Vidage du cache de configuration..."
if [ "$USE_DOCKER" = true ]; then
    $DOCKER_EXEC php artisan config:clear 2>/dev/null || true
    $DOCKER_EXEC php artisan cache:clear 2>/dev/null || true
else
    php artisan config:clear 2>/dev/null || true
    php artisan cache:clear 2>/dev/null || true
fi

# Générer une nouvelle clé
echo "🔑 Génération d'une nouvelle clé APP_KEY..."
if [ "$USE_DOCKER" = true ]; then
    $DOCKER_EXEC php artisan key:generate --force
else
    php artisan key:generate --force
fi

# Vider à nouveau le cache après génération
echo "🧹 Vidage du cache après génération..."
if [ "$USE_DOCKER" = true ]; then
    $DOCKER_EXEC php artisan config:clear 2>/dev/null || true
else
    php artisan config:clear 2>/dev/null || true
fi

# Vérifier que la clé a été générée
echo ""
echo "✅ Vérification de la clé générée..."
if [ "$USE_DOCKER" = true ]; then
    APP_KEY=$($DOCKER_EXEC grep "^APP_KEY=" .env 2>/dev/null | cut -d '=' -f2- | tr -d '[:space:]' || echo "")
else
    APP_KEY=$(grep "^APP_KEY=" .env 2>/dev/null | cut -d '=' -f2- | tr -d '[:space:]' || echo "")
fi

if [ -z "$APP_KEY" ]; then
    echo "❌ Échec: APP_KEY n'a pas été générée"
    echo "Tentative de génération manuelle..."
    if command -v openssl &> /dev/null; then
        MANUAL_KEY=$(openssl rand -base64 32 | tr -d '\n')
        if [ "$USE_DOCKER" = true ]; then
            $DOCKER_EXEC sh -c "echo 'APP_KEY=base64:$MANUAL_KEY' >> .env"
            $DOCKER_EXEC php artisan config:clear 2>/dev/null || true
        else
            echo "APP_KEY=base64:$MANUAL_KEY" >> .env
            php artisan config:clear 2>/dev/null || true
        fi
        echo "✅ Clé générée manuellement"
    else
        exit 1
    fi
elif [[ ! "$APP_KEY" =~ ^base64: ]]; then
    echo "❌ Échec: Format de clé invalide"
    exit 1
else
    KEY_LENGTH=${#APP_KEY}
    echo "✅ APP_KEY générée avec succès!"
    echo "   Format: base64:..."
    echo "   Longueur: ${KEY_LENGTH} caractères"
    echo ""
    echo "📋 Valeur de APP_KEY:"
    if [ "$USE_DOCKER" = true ]; then
        $DOCKER_EXEC grep "^APP_KEY=" .env | head -c 80
    else
        grep "^APP_KEY=" .env | head -c 80
    fi
    echo "..."
fi

echo ""
echo "=========================================="
echo "✅ Correction terminée!"
echo "=========================================="
echo ""
if [ "$USE_DOCKER" = true ]; then
    echo "⚠️  IMPORTANT: Redémarrez votre application maintenant:"
    echo "   $COMPOSE_CMD restart app"
    echo "   ou"
    echo "   docker restart $CONTAINER_NAME"
else
    echo "⚠️  IMPORTANT: Redémarrez votre application maintenant"
fi
echo ""

