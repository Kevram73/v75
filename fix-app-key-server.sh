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

# Vérifier que .env existe
if [ ! -f ".env" ]; then
    echo "⚠️  Fichier .env introuvable, création..."
    if [ -f ".env.example" ]; then
        cp .env.example .env
    else
        touch .env
    fi
fi

# Supprimer l'ancienne clé invalide
echo "🗑️  Suppression de l'ancienne clé APP_KEY..."
sed -i '/^APP_KEY=/d' .env 2>/dev/null || true

# Vider le cache de configuration (CRITIQUE!)
echo "🧹 Vidage du cache de configuration..."
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

# Générer une nouvelle clé
echo "🔑 Génération d'une nouvelle clé APP_KEY..."
php artisan key:generate --force

# Vider à nouveau le cache après génération
echo "🧹 Vidage du cache après génération..."
php artisan config:clear 2>/dev/null || true

# Vérifier que la clé a été générée
echo ""
echo "✅ Vérification de la clé générée..."
APP_KEY=$(grep "^APP_KEY=" .env 2>/dev/null | cut -d '=' -f2- | tr -d '[:space:]')

if [ -z "$APP_KEY" ]; then
    echo "❌ Échec: APP_KEY n'a pas été générée"
    exit 1
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
    grep "^APP_KEY=" .env | head -c 80
    echo "..."
fi

echo ""
echo "=========================================="
echo "✅ Correction terminée!"
echo "=========================================="
echo ""
echo "⚠️  IMPORTANT: Redémarrez votre application maintenant:"
echo "   docker-compose restart app"
echo "   ou"
echo "   docker restart v75_app"
echo ""

