#!/bin/bash

# Navigate to project directory
# Adjust this path if your project is in a different location on the VPS
cd "$(dirname "$0")"

echo "Starting deployment..."

# Pull latest changes
echo "Pulling latest changes..."
git pull origin main

# Build and start containers
echo "Rebuilding and starting containers..."
docker-compose up -d --build

# Install PHP dependencies
echo "Installing PHP dependencies..."
docker-compose exec -T app composer install --no-dev --optimize-autoloader

# Run migrations
echo "Running database migrations..."
docker-compose exec -T app php artisan migrate --force

# Optimize Laravel
echo "Optimizing application..."
docker-compose exec -T app php artisan optimize:clear
docker-compose exec -T app php artisan config:cache
docker-compose exec -T app php artisan route:cache
docker-compose exec -T app php artisan view:cache

# Install Node dependencies and build assets
echo "Building frontend assets..."
docker-compose exec -T app npm install
docker-compose exec -T app npm run build

echo "Deployment completed successfully!"
