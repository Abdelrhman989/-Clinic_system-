# VPS Setup and Deployment Guide

This guide explains how to set up the Clinic System on a VPS using Docker.

## Prerequisites

- A VPS running Ubuntu 20.04/22.04 or Debian 11/12.
- Root or sudo access.

## 1. Install Docker and Docker Compose

Run the following commands on your VPS to install Docker:

```bash
# Add Docker's official GPG key:
sudo apt-get update
sudo apt-get install -y ca-certificates curl
sudo install -m 0755 -d /etc/apt/keyrings
sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
sudo chmod a+r /etc/apt/keyrings/docker.asc

# Add the repository to Apt sources:
echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu \
  $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update

# Install Docker packages:
sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
```

## 2. Clone the Repository

Navigate to the web directory (create it if it doesn't exist) and clone your project:

```bash
sudo mkdir -p /var/www
sudo chown $USER:$USER /var/www
cd /var/www
git clone <YOUR_REPOSITORY_URL> clinic-system
cd clinic-system
```

## 3. Configure Environment

Copy the `.env.example` file to `.env` and update the configuration:

```bash
cp .env.example .env
nano .env
```

Make sure to update the following variables for production:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=http://<YOUR_VPS_IP_OR_DOMAIN>

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=clinic_system
DB_USERNAME=root
DB_PASSWORD=<YOUR_SECURE_PASSWORD>

CACHE_STORE=redis
REDIS_HOST=redis
```

## 4. First Run

Build and start the Docker containers:

```bash
docker compose up -d --build
```

Install dependencies and set up the application:

```bash
# Install PHP dependencies
docker compose exec app composer install --no-dev --optimize-autoloader

# Generate application key
docker compose exec app php artisan key:generate

# Run database migrations
docker compose exec app php artisan migrate --force

# Link storage
docker compose exec app php artisan storage:link

# Install Node dependencies and build assets
docker compose exec app npm install
docker compose exec app npm run build

# Optimize application
docker compose exec app php artisan config:cache
docker compose exec app php artisan route:cache
docker compose exec app php artisan view:cache
```

## 5. Deploying Updates

To deploy new changes, you can use the provided `deploy.sh` script:

```bash
chmod +x deploy.sh
./deploy.sh
```

This script will:
1. Pull the latest code from git.
2. Rebuild the Docker containers.
3. Install dependencies.
4. Run migrations.
5. Optimize the application.
