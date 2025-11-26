#!/bin/bash

# Quick Fix untuk Laravel 500 Error di Production
# Run di server: bash quick-fix-production.sh

echo "🔧 Laravel Production 500 Error - Quick Fix"
echo "==========================================="
echo ""

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Project directory
PROJECT_DIR="/var/www/website-pramuka"

if [ ! -d "$PROJECT_DIR" ]; then
    echo -e "${RED}❌ Project directory not found: $PROJECT_DIR${NC}"
    echo "Please update PROJECT_DIR variable in this script"
    exit 1
fi

cd "$PROJECT_DIR"

echo -e "${YELLOW}[1/10] Checking current errors...${NC}"
if [ -f "storage/logs/laravel.log" ]; then
    echo "Last 10 errors:"
    tail -10 storage/logs/laravel.log
else
    echo -e "${RED}❌ Laravel log not found!${NC}"
fi
echo ""

echo -e "${YELLOW}[2/10] Fixing storage permissions...${NC}"
sudo chown -R www-data:www-data storage
sudo chmod -R 775 storage
echo -e "${GREEN}✅ Storage permissions fixed${NC}"
echo ""

echo -e "${YELLOW}[3/10] Fixing bootstrap/cache permissions...${NC}"
sudo chown -R www-data:www-data bootstrap/cache
sudo chmod -R 775 bootstrap/cache
echo -e "${GREEN}✅ Bootstrap cache permissions fixed${NC}"
echo ""

echo -e "${YELLOW}[4/10] Checking .env file...${NC}"
if [ -f ".env" ]; then
    echo -e "${GREEN}✅ .env file exists${NC}"
    
    # Check APP_KEY
    if grep -q "APP_KEY=base64:" .env; then
        echo -e "${GREEN}✅ APP_KEY is set${NC}"
    else
        echo -e "${RED}❌ APP_KEY not set! Generating...${NC}"
        php artisan key:generate --force
    fi
    
    # Check APP_ENV
    APP_ENV=$(grep "APP_ENV=" .env | cut -d '=' -f2)
    echo "APP_ENV: $APP_ENV"
    
    # Check APP_DEBUG
    APP_DEBUG=$(grep "APP_DEBUG=" .env | cut -d '=' -f2)
    echo "APP_DEBUG: $APP_DEBUG"
    
    if [ "$APP_DEBUG" = "true" ]; then
        echo -e "${YELLOW}⚠️  APP_DEBUG is true (should be false in production)${NC}"
    fi
else
    echo -e "${RED}❌ .env file NOT FOUND!${NC}"
    echo "Creating from .env.example..."
    if [ -f ".env.example" ]; then
        cp .env.example .env
        php artisan key:generate --force
        echo -e "${YELLOW}⚠️  Please edit .env with correct database credentials${NC}"
        echo "Run: nano .env"
    else
        echo -e "${RED}❌ .env.example also not found!${NC}"
    fi
fi
echo ""

echo -e "${YELLOW}[5/10] Clearing all caches...${NC}"
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo -e "${GREEN}✅ All caches cleared${NC}"
echo ""

echo -e "${YELLOW}[6/10] Checking composer dependencies...${NC}"
if [ -d "vendor" ]; then
    echo -e "${GREEN}✅ Vendor directory exists${NC}"
else
    echo -e "${RED}❌ Vendor directory missing! Installing...${NC}"
    composer install --optimize-autoloader --no-dev --no-interaction
fi
echo ""

echo -e "${YELLOW}[7/10] Regenerating autoload...${NC}"
composer dump-autoload --optimize
echo -e "${GREEN}✅ Autoload regenerated${NC}"
echo ""

echo -e "${YELLOW}[8/10] Optimizing Laravel...${NC}"
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo -e "${GREEN}✅ Laravel optimized${NC}"
echo ""

echo -e "${YELLOW}[9/10] Restarting services...${NC}"
# Try different PHP-FPM versions
if systemctl is-active --quiet php8.2-fpm; then
    sudo systemctl restart php8.2-fpm
    echo -e "${GREEN}✅ PHP 8.2-FPM restarted${NC}"
elif systemctl is-active --quiet php8.1-fpm; then
    sudo systemctl restart php8.1-fpm
    echo -e "${GREEN}✅ PHP 8.1-FPM restarted${NC}"
elif systemctl is-active --quiet php-fpm; then
    sudo systemctl restart php-fpm
    echo -e "${GREEN}✅ PHP-FPM restarted${NC}"
else
    echo -e "${YELLOW}⚠️  PHP-FPM service not found${NC}"
fi

sudo systemctl reload nginx
echo -e "${GREEN}✅ Nginx reloaded${NC}"
echo ""

echo -e "${YELLOW}[10/10] Testing website...${NC}"
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost)
if [ "$HTTP_CODE" = "200" ]; then
    echo -e "${GREEN}✅ Website responding with HTTP 200${NC}"
else
    echo -e "${RED}❌ Website responding with HTTP $HTTP_CODE${NC}"
    echo "Check logs: tail -f storage/logs/laravel.log"
fi
echo ""

echo "==========================================="
echo -e "${GREEN}🎉 Quick fix completed!${NC}"
echo ""
echo "📋 Verification steps:"
echo "1. Visit: https://pramukauinsuna.com"
echo "2. Check logs: tail -f storage/logs/laravel.log"
echo "3. Check Nginx: sudo tail -f /var/log/nginx/error.log"
echo ""
echo "🔍 If still 500 error, check detailed logs:"
echo "   tail -50 storage/logs/laravel.log"
echo ""
