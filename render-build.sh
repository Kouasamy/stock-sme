#!/usr/bin/env bash
# Script de build pour Render (Optimisé pour Laravel 12)
# -----------------------------------------------------

# Quitter en cas d'erreur
set -e

echo "--- Démarrage du build Render ---"

# Installation des dépendances composer (Production)
composer install --no-dev --optimize-autoloader

# Installation et Build des assets (Si Vite est utilisé)
if [ -f "package.json" ]; then
    echo "--- Build des assets avec NPM ---"
    npm install
    npm run build
fi

# Création du fichier SQLite uniquement si nécessaire (Fallback)
if [ "$DB_CONNECTION" = "sqlite" ]; then
    echo "--- Configuration SQLite ---"
    mkdir -p database
    touch database/database.sqlite
fi

# Exécution des migrations
echo "--- Exécution des migrations ---"
php artisan migrate --force

# Optimisations des caches Laravel pour la production
echo "--- Optimisation des caches ---"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

echo "--- Build terminé avec succès ! ---"
