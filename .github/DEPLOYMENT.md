# Guide de Déploiement V75 Pro

## Configuration GitHub Actions

Ce projet utilise GitHub Actions pour le déploiement automatique sur un serveur VPS.

### Secrets GitHub Requis

Configurez les secrets suivants dans votre dépôt GitHub (Settings > Secrets and variables > Actions) :

#### Secrets Obligatoires

- `SFTP_HOST` : Adresse IP ou hostname du serveur VPS
- `SFTP_USERNAME` : Nom d'utilisateur SSH
- `SFTP_PASSWORD` : Mot de passe SSH
- `SFTP_PORT` : Port SSH (par défaut: 22)

#### Secrets Optionnels

- `SFTP_DEPLOY_PATH` : Chemin de déploiement sur le serveur (par défaut: `/var/www/v75-pro`)
- `APP_URL` : URL de production (par défaut: `http://72.60.188.146:7000`)

### Déclenchement du Déploiement

Le déploiement se déclenche automatiquement :
- Lors d'un push sur la branche `master`
- Manuellement via l'onglet "Actions" de GitHub (workflow_dispatch)

### Port de Production

L'application sera déployée sur le **port 7000**.

### Prérequis Serveur

Le serveur VPS doit avoir :
- Docker installé
- Docker Compose installé (v1 ou v2)
- Accès SSH configuré
- Permissions d'écriture dans le répertoire de déploiement

### Structure du Déploiement

Le pipeline :
1. Crée une archive du code (excluant node_modules, vendor, .env, etc.)
2. Upload l'archive sur le serveur VPS
3. Extrait les fichiers
4. Gère le fichier .env (préserve l'existant ou crée depuis .env.example)
5. Construit et démarre les conteneurs Docker
6. Installe les dépendances Composer
7. Génère la clé d'application si nécessaire
8. Optimise Laravel (cache config, routes, views)
9. Exécute les migrations
10. Vérifie la santé de l'application

### Configuration .env

Le fichier `.env` sera :
- Préservé s'il existe déjà (sauvegarde avant déploiement)
- Créé depuis `.env.example` si absent
- Adapté automatiquement pour Docker (DB_HOST=mysql, etc.)

**Important** : Vérifiez que votre `.env` contient les bonnes valeurs :
- `DB_PASSWORD` : Mot de passe de la base de données
- `APP_KEY` : Clé d'application Laravel (générée automatiquement si absente)
- `APP_URL` : URL de production
- Autres variables spécifiques à votre application

### Monitoring

Après le déploiement, vérifiez :
- Les logs : `docker compose logs app`
- Le statut des conteneurs : `docker compose ps`
- L'application : `http://VOTRE_IP:7000`

