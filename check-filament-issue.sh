#!/bin/bash

echo "========================================="
echo "🔍 DIAGNOSTIC: FILAMENT CMS LOGIN ISSUE"
echo "========================================="

cd /var/www/website-pramuka

echo ""
echo "1️⃣ Laravel Environment Info:"
echo "----------------------------"
php artisan about | grep -E "Environment|Debug Mode|URL|Session|Cache"

echo ""
echo "2️⃣ Check Sessions Table:"
echo "-------------------------"
php artisan tinker --execute="
if (Schema::hasTable('sessions')) {
    echo '✅ Sessions table EXISTS\n';
    echo 'Total sessions: ' . DB::table('sessions')->count() . '\n';
} else {
    echo '❌ Sessions table NOT FOUND - This is the problem!\n';
}
"

echo ""
echo "3️⃣ Check Database Tables:"
echo "-------------------------"
php artisan db:table sessions 2>/dev/null || echo "⚠️ Cannot query sessions table"

echo ""
echo "4️⃣ Check .env Configuration:"
echo "----------------------------"
grep -E "SESSION_|APP_URL|APP_ENV|APP_DEBUG" .env

echo ""
echo "5️⃣ Check Storage Permissions:"
echo "------------------------------"
ls -la storage/ | head -10
ls -la storage/framework/

echo ""
echo "6️⃣ Check if Admin User Exists:"
echo "-------------------------------"
php artisan tinker --execute="
\$count = App\Models\User::count();
echo 'Total users in database: ' . \$count . '\n';
if (\$count > 0) {
    \$user = App\Models\User::first();
    echo 'First user email: ' . \$user->email . '\n';
}
"

echo ""
echo "7️⃣ Test Filament Routes:"
echo "-------------------------"
php artisan route:list --path=admin | head -5

echo ""
echo "8️⃣ Check Recent Laravel Logs:"
echo "------------------------------"
if [ -f storage/logs/laravel.log ]; then
    echo "Last 20 lines of laravel.log:"
    tail -20 storage/logs/laravel.log
else
    echo "⚠️ No laravel.log found"
fi

echo ""
echo "9️⃣ Check Nginx Error Logs:"
echo "---------------------------"
if [ -f /var/log/nginx/website-pramuka-error.log ]; then
    echo "Last 10 lines of nginx error log:"
    tail -10 /var/log/nginx/website-pramuka-error.log
else
    echo "⚠️ No nginx error log found"
fi

echo ""
echo "🔟 Test HTTP Response:"
echo "----------------------"
echo "Testing homepage..."
curl -I http://localhost 2>/dev/null | head -5
echo ""
echo "Testing admin login page..."
curl -I http://localhost/admin/login 2>/dev/null | head -5

echo ""
echo "========================================="
echo "✅ Diagnostic completed!"
echo "========================================="
