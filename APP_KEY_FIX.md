# Fix APP_KEY Error - Guide de résolution

## Problème

Vous rencontrez l'erreur suivante sur le serveur de production :
```
No application encryption key has been specified.
```
ou
```
Unsupported cipher or incorrect key length. Supported ciphers are: aes-128-cbc, aes-256-cbc, aes-128-gcm, aes-256-gcm.
```

## Cause

La clé de chiffrement Laravel (`APP_KEY`) n'est pas définie ou est invalide dans le fichier `.env`.

## Solutions

### Solution 1 : Utiliser le script automatique (Recommandé)

Sur le serveur, exécutez :
```bash
cd /var/www
chmod +x fix-app-key.sh
./fix-app-key.sh
```

### Solution 2 : Génération manuelle

1. Connectez-vous au serveur et naviguez vers le répertoire de l'application :
```bash
cd /var/www
```

2. Vérifiez que le fichier `.env` existe :
```bash
ls -la .env
```

3. Si le fichier n'existe pas, créez-le ou copiez `.env.example` :
```bash
cp .env.example .env
```

4. Générez la clé APP_KEY :
```bash
php artisan key:generate --force
```

5. Vérifiez que la clé a été générée correctement :
```bash
grep APP_KEY .env
```

La sortie devrait ressembler à :
```
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
```

6. Redémarrez l'application (si vous utilisez Docker) :
```bash
docker-compose restart app
# ou
docker restart v75_app
```

### Solution 3 : Vérification et correction manuelle

1. Ouvrez le fichier `.env` :
```bash
nano /var/www/.env
# ou
vi /var/www/.env
```

2. Vérifiez la ligne `APP_KEY`. Elle doit :
   - Commencer par `base64:`
   - Avoir au moins 50 caractères au total
   - Exemple valide : `APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx`

3. Si la clé est absente ou invalide, supprimez-la ou commentez-la, puis exécutez :
```bash
php artisan key:generate --force
```

## Vérification

Pour vérifier que la clé est correcte, vous pouvez tester :
```bash
php artisan tinker
```
Puis dans tinker :
```php
config('app.key')
```
Cela devrait retourner la clé complète commençant par `base64:`.

## Prévention

Le script `docker-entrypoint.sh` a été amélioré pour :
- Vérifier automatiquement si `APP_KEY` existe
- Valider le format et la longueur de la clé
- Générer automatiquement une nouvelle clé si nécessaire

Assurez-vous que le script est exécutable :
```bash
chmod +x docker-entrypoint.sh
```

## Notes importantes

⚠️ **ATTENTION** : Si vous régénérez `APP_KEY` sur un serveur de production avec des données existantes :
- Les sessions utilisateur seront invalidées
- Les données chiffrées existantes ne pourront plus être déchiffrées
- Les utilisateurs devront se reconnecter

Si vous avez déjà des données chiffrées en base de données, **ne régénérez pas** la clé sans sauvegarder l'ancienne valeur.

