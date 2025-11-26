#!/bin/bash

echo "========================================="
echo "🔧 FIX FILAMENT CMS 403 FORBIDDEN ERROR"
echo "========================================="

cd /var/www/website-pramuka

# 1. Check if sessions table exists
echo ""
echo "1️⃣ Checking sessions table..."
php artisan tinker --execute="echo Schema::hasTable('sessions') ? '✅ Sessions table EXISTS' : '❌ Sessions table NOT FOUND';"

# 2. Run migrations to create sessions table
echo ""
echo "2️⃣ Running migrations..."
php artisan migrate --force

# 3. Clear all caches
echo ""
echo "3️⃣ Clearing all caches..."
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 4. Fix storage permissions
echo ""
echo "4️⃣ Fixing storage permissions..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# 5. Create storage directories if missing
echo ""
echo "5️⃣ Creating storage directories..."
mkdir -p storage/framework/sessions
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/views
mkdir -p storage/logs
chown -R www-data:www-data storage
chmod -R 775 storage

# 6. Re-cache optimized configs
echo ""
echo "6️⃣ Recaching configurations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Check .env SESSION configuration
echo ""
echo "7️⃣ Checking .env SESSION configuration..."
grep "SESSION_DRIVER" .env || echo "⚠️ SESSION_DRIVER not found in .env"
grep "SESSION_DOMAIN" .env || echo "⚠️ SESSION_DOMAIN not found in .env"

# 8. Verify database connection
echo ""
echo "8️⃣ Testing database connection..."
php artisan db:show || echo "⚠️ Database connection issue"

# 9. Check if admin user exists
echo ""
echo "9️⃣ Checking admin users..."
php artisan tinker --execute="echo 'Total users: ' . App\Models\User::count();"

# 10. Restart PHP-FPM and Nginx
echo ""
echo "🔄 Restarting services..."
systemctl restart php8.2-fpm
systemctl reload nginx

echo ""
echo "========================================="
echo "✅ Fix completed!"
echo "========================================="
echo ""
echo "📋 Next steps:"
echo "1. Try accessing: https://pramukauinsuna.com/admin"
echo "2. If still 403, check Nginx error log:"
echo "   tail -f /var/log/nginx/website-pramuka-error.log"
echo "3. Check Laravel log:"
echo "   tail -f storage/logs/laravel.log"
echo ""
echo "🔐 If you need to create admin user:"
echo "   php artisan tinker"
echo "   Then run:"
echo "   \$user = App\Models\User::create(['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => bcrypt('password')]);"
echo ""
