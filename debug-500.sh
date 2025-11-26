#!/bin/bash

# Debug Script untuk Laravel 500 Error
echo "🔍 Debugging Laravel 500 Error..."
echo "=================================="
echo ""

# 1. Check Laravel Logs
echo "📋 [1/8] Checking Laravel Error Logs..."
if [ -f "storage/logs/laravel.log" ]; then
    echo "Last 50 lines of Laravel log:"
    tail -50 storage/logs/laravel.log
else
    echo "❌ Laravel log file not found!"
fi
echo ""

# 2. Check PHP-FPM Logs
echo "📋 [2/8] Checking PHP-FPM Logs..."
if [ -f "/var/log/php8.2-fpm.log" ]; then
    echo "Last 30 lines of PHP-FPM log:"
    sudo tail -30 /var/log/php8.2-fpm.log
elif [ -f "/var/log/php-fpm/error.log" ]; then
    sudo tail -30 /var/log/php-fpm/error.log
else
    echo "⚠️ PHP-FPM log not found"
fi
echo ""

# 3. Check Nginx Error Logs
echo "📋 [3/8] Checking Nginx Error Logs..."
if [ -f "/var/log/nginx/error.log" ]; then
    echo "Last 30 lines of Nginx error log:"
    sudo tail -30 /var/log/nginx/error.log
else
    echo "⚠️ Nginx error log not found"
fi
echo ""

# 4. Check File Permissions
echo "🔐 [4/8] Checking File Permissions..."
echo "Storage directory:"
ls -la storage/
echo ""
echo "Bootstrap/cache directory:"
ls -la bootstrap/cache/
echo ""

# 5. Check .env File
echo "⚙️ [5/8] Checking .env Configuration..."
if [ -f ".env" ]; then
    echo "✅ .env file exists"
    echo "APP_ENV: $(grep APP_ENV .env)"
    echo "APP_DEBUG: $(grep APP_DEBUG .env)"
    echo "APP_KEY: $(grep APP_KEY .env | cut -c1-20)..."
else
    echo "❌ .env file NOT FOUND!"
fi
echo ""

# 6. Check Composer Dependencies
echo "📦 [6/8] Checking Composer Dependencies..."
if [ -d "vendor" ]; then
    echo "✅ Vendor directory exists"
    composer check-platform-reqs 2>&1 | grep -E "ext-|php " || echo "All dependencies OK"
else
    echo "❌ Vendor directory NOT FOUND! Run: composer install"
fi
echo ""

# 7. Check Database Connection
echo "🗄️ [7/8] Testing Database Connection..."
php artisan tinker --execute="DB::connection()->getPdo(); echo 'Database connected successfully!';" 2>&1 || echo "❌ Database connection FAILED!"
echo ""

# 8. Check PHP Version
echo "🐘 [8/8] Checking PHP Version..."
php -v
echo ""

echo "=================================="
echo "✅ Debug Complete!"
echo ""
echo "🔧 Common Fixes:"
echo "1. Fix permissions: sudo chown -R www-data:www-data storage bootstrap/cache"
echo "2. Clear cache: php artisan optimize:clear"
echo "3. Check .env: cp .env.example .env && php artisan key:generate"
echo "4. Install deps: composer install --no-dev"
echo "5. Check logs: tail -f storage/logs/laravel.log"
