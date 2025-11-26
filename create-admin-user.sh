#!/bin/bash

echo "👤 Creating Admin User for CMS..."

cd /var/www/website-pramuka || exit 1

echo ""
echo "📋 Checking users table..."
php artisan tinker --execute="echo 'Total users: ' . App\Models\User::count();"

echo ""
echo "🔐 Creating admin user..."
php artisan tinker --execute="
\$user = App\Models\User::firstOrCreate(
    ['email' => 'admin@pramukauinsuna.com'],
    [
        'name' => 'Administrator',
        'password' => Hash::make('admin123'),
        'email_verified_at' => now(),
    ]
);
echo '✅ Admin user created/found: ' . \$user->email;
echo PHP_EOL;
echo '📧 Email: admin@pramukauinsuna.com';
echo PHP_EOL;
echo '🔑 Password: admin123';
echo PHP_EOL;
echo '⚠️  CHANGE PASSWORD IMMEDIATELY AFTER LOGIN!';
"

echo ""
echo "✅ Admin user ready!"
echo ""
echo "Login details:"
echo "URL: https://pramukauinsuna.com/admin"
echo "Email: admin@pramukauinsuna.com"
echo "Password: admin123"
echo ""
echo "⚠️  IMPORTANT: Change password immediately after first login!"
