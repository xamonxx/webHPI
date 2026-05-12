#!/bin/bash
# ================================================
# Deploy Script for Hostinger Shared Hosting
# ================================================
# Usage: ./scripts/deploy-hostinger-shared.sh
#
# Prerequisites:
# 1. Create GitHub Secrets:
#    - HOSTINGER_SSH_HOST
#    - HOSTINGER_SSH_PORT
#    - HOSTINGER_SSH_USER
#    - HOSTINGER_SSH_PASSWORD
#    - HOSTINGER_DOMAIN
#    - HOSTINGER_HOME
#    - PRODUCTION_DB_HOST
#    - PRODUCTION_DB_PORT
#    - PRODUCTION_DB_DATABASE
#    - PRODUCTION_DB_USERNAME
#    - PRODUCTION_DB_PASSWORD
# ================================================

set -e

echo "=========================================="
echo "Hostinger Shared Hosting Deployment"
echo "=========================================="

# Configuration
DOMAIN="${HOSTINGER_DOMAIN:-homeputrainterior.com}"
PROJECT_DIR="${HOSTINGER_HOME:-$HOME}/domains/$DOMAIN/webHPI"
PUBLIC_DIR="${HOSTINGER_HOME:-$HOME}/domains/$DOMAIN/public_html"
REPO_URL="https://github.com/xamonxx/webHPI.git"
BRANCH="master"

echo "Domain: $DOMAIN"
echo "Project Directory: $PROJECT_DIR"
echo "Public Directory: $PUBLIC_DIR"
echo ""

# Check if running locally or on server
if [ -z "$HOSTINGER_SSH_HOST" ]; then
    echo "This script should be run via GitHub Actions."
    echo "Or set the following environment variables:"
    echo "  HOSTINGER_SSH_HOST"
    echo "  HOSTINGER_SSH_PORT"
    echo "  HOSTINGER_SSH_USER"
    echo "  HOSTINGER_SSH_PASSWORD"
    echo "  HOSTINGER_DOMAIN"
    echo "  HOSTINGER_HOME"
    echo "  PRODUCTION_DB_*"
    exit 1
fi

echo "Checking directories..."

# Create directories if not exists
mkdir -p "$PROJECT_DIR"
mkdir -p "$PUBLIC_DIR"

# Clone or pull repository
if [ -d "$PROJECT_DIR/.git" ]; then
    echo "Repository exists. Pulling latest..."
    cd "$PROJECT_DIR"
    git fetch origin "$BRANCH"
    git reset --hard "origin/$BRANCH"
else
    echo "Cloning repository..."
    rm -rf "$PROJECT_DIR"
    git clone -b "$BRANCH" "$REPO_URL" "$PROJECT_DIR"
    cd "$PROJECT_DIR"
fi

echo "Pull complete."
echo ""

# Install dependencies
echo "Installing PHP dependencies..."

if command -v composer >/dev/null 2>&1; then
    composer install --no-dev --optimize-autoloader --prefer-dist
elif [ -f composer.phar ]; then
    php composer.phar install --no-dev --optimize-autoloader --prefer-dist
else
    echo "WARNING: Composer not found. Make sure vendor folder exists."
fi

echo "PHP dependencies installed."
echo ""

# Build frontend if npm is available
if [ -f package.json ]; then
    echo "Checking Node.js..."

    if command -v npm >/dev/null 2>&1; then
        echo "Building frontend assets..."
        npm ci
        npm run build
    else
        echo "WARNING: npm not found. Frontend build skipped."
        echo "Build assets locally or via GitHub Actions."
    fi
fi

echo ""

# Check .env
if [ ! -f "$PROJECT_DIR/.env" ]; then
    echo "ERROR: .env file not found!"
    echo "Please create .env file manually on server."
    echo "Location: $PROJECT_DIR/.env"
    exit 1
fi

echo "Running Laravel commands..."

cd "$PROJECT_DIR"

# Generate app key
php artisan key:generate --force --no-interaction

# Run migrations
echo "Running migrations..."
php artisan migrate --force --no-interaction || echo "Migration completed or failed"

# Storage link
php artisan storage:link || true

# Clear caches
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Optimize
echo "Optimizing..."
php artisan optimize
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo ""

# Sync public folder to public_html
echo "Syncing public folder to public_html..."

rsync -av --delete \
    --exclude='.env' \
    "$PROJECT_DIR/public/" "$PUBLIC_DIR/"

# Update index.php paths
INDEX_FILE="$PUBLIC_DIR/index.php"

if [ -f "$INDEX_FILE" ]; then
    echo "Updating index.php paths..."

    # Update vendor path
    sed -i "s|__DIR__.'/../vendor/|__DIR__.'/../webHPI/vendor/|g" "$INDEX_FILE" || true

    # Update bootstrap path
    sed -i "s|__DIR__.'/../bootstrap/|__DIR__.'/../webHPI/bootstrap/|g" "$INDEX_FILE" || true
fi

# Copy .htaccess
if [ -f "$PROJECT_DIR/public/.htaccess" ] && [ ! -f "$PUBLIC_DIR/.htaccess" ]; then
    cp "$PROJECT_DIR/public/.htaccess" "$PUBLIC_DIR/.htaccess"
    echo ".htaccess copied to public_html"
fi

echo ""

# Set permissions
echo "Setting permissions..."

if [ -d "$PROJECT_DIR/storage" ]; then
    chmod -R 775 "$PROJECT_DIR/storage" || true
    echo "  storage: 775"
fi

if [ -d "$PROJECT_DIR/bootstrap/cache" ]; then
    chmod -R 775 "$PROJECT_DIR/bootstrap/cache" || true
    echo "  bootstrap/cache: 775"
fi

if [ -f "$PROJECT_DIR/.env" ]; then
    chmod 644 "$PROJECT_DIR/.env" || true
    echo "  .env: 644"
fi

echo ""
echo "=========================================="
echo "Deployment completed successfully!"
echo "=========================================="
echo ""
echo "Website URL: https://$DOMAIN"
echo "Admin Panel: https://$DOMAIN/admin"
echo ""
echo "Remember to:"
echo "  1. Verify HTTPS is working"
echo "  2. Test all functionality"
echo "  3. Check contact form"
echo "  4. Check admin login"
echo ""