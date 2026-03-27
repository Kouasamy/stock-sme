#!/bin/sh
set -e

# Attendre que la DB soit prête si nécessaire (optionnel)
echo "--- Lancement de l'Entrypoint ---"

# Exécuter les migrations en production
echo "--- Exécution des migrations ---"
php artisan migrate --force

# Lancer Apache en arrière-plan (par défaut dans l'image de base)
echo "--- Démarrage d'Apache ---"
exec apache2-foreground
