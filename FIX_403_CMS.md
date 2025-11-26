# Fix 403 Forbidden Error - Filament CMS

## Problem
CMS admin panel returns **403 Forbidden** error when trying to access `/admin` or `/admin/login`

## Root Causes
1. **Sessions table missing** - Laravel needs `sessions` table for database session driver
2. **Permission issues** - `storage/` and `bootstrap/cache/` need correct permissions
3. **No admin user** - Need user account to login to CMS

---

## Quick Fix (Automated)

### On Production Server:

```bash
cd /var/www/website-pramuka

# Pull latest code with fix scripts
git pull origin dev

# Run fix script
bash fix-403-cms.sh

# Create admin user
bash create-admin-user.sh
```

---

## Manual Fix Steps

### Step 1: Create Sessions Table

```bash
cd /var/www/website-pramuka

# Run migration
php artisan migrate --force
```

The migration file `2025_11_26_120000_create_sessions_table.php` will create the sessions table.

### Step 2: Clear All Caches

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
rm -rf bootstrap/cache/*.php
```

### Step 3: Fix Permissions

```bash
# Change owner to web server user
chown -R www-data:www-data storage bootstrap/cache

# Set correct permissions
chmod -R 775 storage bootstrap/cache

# Fix logs
chmod -R 664 storage/logs/*.log
```

### Step 4: Create Storage Directories

```bash
# Ensure all session directories exist
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/framework/cache/data

# Fix permissions
chown -R www-data:www-data storage/framework
chmod -R 775 storage/framework
```

### Step 5: Recache Everything

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 6: Restart Services

```bash
systemctl restart php8.2-fpm
systemctl reload nginx
```

### Step 7: Create Admin User

```bash
php artisan tinker
```

Then in Tinker console:

```php
$user = App\Models\User::firstOrCreate(
    ['email' => 'admin@pramukauinsuna.com'],
    [
        'name' => 'Administrator',
        'password' => Hash::make('admin123'),
        'email_verified_at' => now(),
    ]
);

echo "Admin user created: {$user->email}";
exit;
```

---

## Verification

### Test Admin Login Page:

```bash
curl -I http://localhost/admin/login
# Should return: HTTP/1.1 200 OK
```

### Check Sessions Table:

```bash
php artisan tinker --execute="echo Schema::hasTable('sessions') ? 'Sessions table EXISTS' : 'Sessions table MISSING';"
```

### Check User:

```bash
php artisan tinker --execute="echo 'Users: ' . App\Models\User::count();"
```

---

## Login Credentials

After running the fix:

- **URL**: https://pramukauinsuna.com/admin
- **Email**: `admin@pramukauinsuna.com`
- **Password**: `admin123`

⚠️ **IMPORTANT**: Change password immediately after first login!

---

## If Still Getting 403

### Check Nginx Configuration:

```bash
nginx -t
cat /etc/nginx/sites-available/website-pramuka
```

Ensure this block exists:

```nginx
location /admin {
    try_files $uri $uri/ /index.php?$query_string;
}
```

### Check PHP-FPM:

```bash
systemctl status php8.2-fpm
tail -f /var/log/php8.2-fpm.log
```

### Check Laravel Logs:

```bash
tail -f storage/logs/laravel.log
```

### Check Nginx Error Logs:

```bash
tail -f /var/log/nginx/error.log
```

---

## Prevention for Future

Add to CI/CD workflow before deployment:

```bash
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

This ensures sessions table exists and all caches are fresh on each deployment.
