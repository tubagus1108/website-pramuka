#!/bin/bash

echo "🔧 Fixing 403 Forbidden Error on CMS..."

# Navigate to project directory
cd /var/www/website-pramuka || exit 1

echo ""
echo "📋 Step 1: Check sessions table..."
php artisan tinker --execute="echo Schema::hasTable('sessions') ? '✅ Sessions table EXISTS' : '❌ Sessions table NOT FOUND';"

echo ""
echo "📋 Step 2: Create sessions table if not exists..."
php artisan migrate --force

echo ""
echo "🧹 Step 3: Clear all caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
rm -rf bootstrap/cache/*.php

echo ""
echo "🔐 Step 4: Fix permissions..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
chmod -R 664 storage/logs/*.log 2>/dev/null || true

echo ""
echo "📝 Step 5: Verify storage structure..."
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/framework/cache/data
chown -R www-data:www-data storage/framework
chmod -R 775 storage/framework

echo ""
echo "🔄 Step 6: Recache optimizations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ""
echo "🔄 Step 7: Restart PHP-FPM and Nginx..."
systemctl restart php8.2-fpm
systemctl reload nginx

echo ""
echo "✅ Testing admin login page..."
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost/admin/login)
if [ "$HTTP_CODE" = "200" ]; then
    echo "✅ Admin login page is accessible (HTTP $HTTP_CODE)"
else
    echo "❌ Admin login page returned HTTP $HTTP_CODE"
fi

echo ""
echo "📊 Checking sessions table..."
php artisan tinker --execute="echo 'Sessions table columns: ' . implode(', ', Schema::getColumnListing('sessions'));"

echo ""
echo "✅ Fix completed! Try accessing: https://pramukauinsuna.com/admin"
