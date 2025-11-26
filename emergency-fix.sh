#!/bin/bash

# EMERGENCY FIX for Filament Provider Missing & 404 Error
# Run as: bash emergency-fix.sh

set -e

echo "🚨 EMERGENCY FIX - Filament & 404 Error"
echo "========================================"
echo ""

PROJECT_DIR="/var/www/website-pramuka"
cd "$PROJECT_DIR"

echo "❌ DETECTED ISSUES:"
echo "   1. Filament\PanelProvider not found (missing dependencies)"
echo "   2. HTTP 404 error (routing issue)"
echo "   3. APP_ENV=local (should be production)"
echo ""

# Step 1: Fix .env
echo "[1/8] Fixing .env configuration..."
sed -i 's/APP_ENV=local/APP_ENV=production/' .env
sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env
echo "✅ .env updated to production mode"
echo ""

# Step 2: Clear everything first
echo "[2/8] Clearing ALL caches and compiled files..."
rm -rf bootstrap/cache/*.php
rm -rf storage/framework/cache/data/*
rm -rf storage/framework/sessions/*
rm -rf storage/framework/views/*
echo "✅ All cache directories cleared"
echo ""

# Step 3: Remove vendor and reinstall (CRITICAL!)
echo "[3/8] Reinstalling Composer dependencies..."
echo "⚠️  This will take 2-3 minutes..."
rm -rf vendor/
COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader --no-dev --no-interaction --quiet
echo "✅ Composer dependencies reinstalled"
echo ""

# Step 4: Regenerate autoload
echo "[4/8] Regenerating autoload files..."
COMPOSER_ALLOW_SUPERUSER=1 composer dump-autoload --optimize
echo "✅ Autoload regenerated"
echo ""

# Step 5: Verify Filament is installed
echo "[5/8] Verifying Filament installation..."
if [ -d "vendor/filament" ]; then
    echo "✅ Filament directory exists"
    ls -la vendor/filament/ | head -5
else
    echo "❌ Filament NOT found! Installing..."
    COMPOSER_ALLOW_SUPERUSER=1 composer require filament/filament:"^4.0" --no-interaction
fi
echo ""

# Step 6: Laravel optimization
echo "[6/8] Optimizing Laravel..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "✅ Laravel optimized"
echo ""

# Step 7: Fix permissions
echo "[7/8] Fixing all permissions..."
chown -R www-data:www-data .
chmod -R 755 .
chmod -R 775 storage bootstrap/cache
chmod -R 755 public
echo "✅ Permissions fixed"
echo ""

# Step 8: Restart services
echo "[8/8] Restarting all services..."
systemctl restart php8.2-fpm
systemctl reload nginx
echo "✅ Services restarted"
echo ""

echo "========================================"
echo "🔍 Testing website..."
echo ""

# Test localhost
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost)
echo "HTTP Status from localhost: $HTTP_CODE"

if [ "$HTTP_CODE" = "200" ]; then
    echo "✅ Website is now working!"
elif [ "$HTTP_CODE" = "404" ]; then
    echo "❌ Still 404! Checking Nginx config..."
    echo ""
    echo "Nginx config test:"
    nginx -t
    echo ""
    echo "Current Nginx sites-enabled:"
    ls -la /etc/nginx/sites-enabled/
else
    echo "⚠️  HTTP $HTTP_CODE - Check logs below"
fi

echo ""
echo "========================================"
echo "📋 Final Status:"
echo ""

# Check critical files
echo "✅ Checks:"
echo "   - .env: $([ -f .env ] && echo "EXISTS" || echo "MISSING")"
echo "   - vendor/: $([ -d vendor ] && echo "EXISTS" || echo "MISSING")"
echo "   - vendor/filament/: $([ -d vendor/filament ] && echo "EXISTS" || echo "MISSING")"
echo "   - public/index.php: $([ -f public/index.php ] && echo "EXISTS" || echo "MISSING")"
echo ""

echo "🌐 Current .env settings:"
grep "APP_ENV=" .env
grep "APP_DEBUG=" .env
grep "APP_URL=" .env
echo ""

echo "📋 Next steps:"
echo "1. Visit: https://pramukauinsuna.com"
echo "2. If still 404, check Nginx config"
echo "3. If Filament error, share output below"
echo ""

echo "🔍 Last Laravel error (if any):"
tail -5 storage/logs/laravel.log 2>/dev/null || echo "No recent errors"
echo ""
