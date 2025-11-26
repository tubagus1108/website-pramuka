# 🚨 CRITICAL ERROR FIX GUIDE

## ❌ Error: "Class Filament\PanelProvider not found"

### Root Cause:
Composer dependencies tidak terinstall dengan benar di production. Kemungkinan:
1. `composer install` tidak selesai sempurna
2. Vendor directory corrupt
3. Autoload tidak ter-regenerate

### ✅ SOLUTION - Run Emergency Fix:

```bash
# SSH to server
ssh root@your-server-ip

# Navigate to project
cd /var/www/website-pramuka

# Download emergency fix
curl -O https://raw.githubusercontent.com/tubagus1108/website-pramuka/dev/emergency-fix.sh

# Run it
bash emergency-fix.sh
```

**Emergency fix will:**
1. ✅ Set APP_ENV=production, APP_DEBUG=false
2. ✅ Clear ALL cache files
3. ✅ Remove vendor/ and reinstall from scratch
4. ✅ Verify Filament is installed
5. ✅ Regenerate autoload
6. ✅ Optimize Laravel
7. ✅ Fix all permissions
8. ✅ Restart services

---

## ❌ Error: HTTP 404

### Root Cause:
Nginx tidak bisa route request ke Laravel index.php

### ✅ SOLUTION:

```bash
# Check Nginx config
bash fix-nginx-404.sh

# Or manually:
sudo nginx -t
sudo systemctl reload nginx
```

**Common issues:**
1. Site not enabled in sites-enabled/
2. Wrong root path (should be /var/www/website-pramuka/public)
3. Missing try_files directive
4. PHP-FPM socket path wrong

---

## 🔧 MANUAL FIX (If Scripts Don't Work)

### Step 1: Fix Composer Dependencies

```bash
cd /var/www/website-pramuka

# Remove vendor completely
rm -rf vendor/

# Reinstall
COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader --no-dev

# Verify Filament exists
ls -la vendor/filament/
```

### Step 2: Fix .env

```bash
# Edit .env
nano .env

# Change these:
APP_ENV=production    # NOT local!
APP_DEBUG=false       # NOT true!
APP_URL=https://pramukauinsuna.com

# Save: Ctrl+X, Y, Enter
```

### Step 3: Clear Everything

```bash
# Remove all caches
rm -rf bootstrap/cache/*.php
rm -rf storage/framework/cache/data/*
rm -rf storage/framework/sessions/*
rm -rf storage/framework/views/*

# Regenerate
php artisan optimize:clear
php artisan optimize
```

### Step 4: Check Nginx Config

```bash
# View current config
cat /etc/nginx/sites-available/website-pramuka

# Should have:
root /var/www/website-pramuka/public;
index index.php index.html;

location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
    fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    include fastcgi_params;
}
```

### Step 5: Verify Site Enabled

```bash
# Check if enabled
ls -la /etc/nginx/sites-enabled/

# Should see: website-pramuka -> ../sites-available/website-pramuka

# If not, enable:
sudo ln -sf /etc/nginx/sites-available/website-pramuka /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### Step 6: Fix Permissions

```bash
cd /var/www/website-pramuka

# Fix ownership
sudo chown -R www-data:www-data .

# Fix permissions
sudo chmod -R 755 .
sudo chmod -R 775 storage bootstrap/cache
```

### Step 7: Restart Everything

```bash
# Restart PHP-FPM
sudo systemctl restart php8.2-fpm

# Reload Nginx
sudo systemctl reload nginx

# Check status
systemctl status php8.2-fpm
systemctl status nginx
```

### Step 8: Test

```bash
# From server
curl -I http://localhost

# Should see: HTTP/1.1 200 OK
# NOT: HTTP/1.1 404 Not Found
```

---

## 🔍 VERIFICATION COMMANDS

### Check Filament Installation:
```bash
cd /var/www/website-pramuka
ls -la vendor/filament/
# Should show multiple directories

php artisan list | grep filament
# Should show filament commands
```

### Check Nginx Routing:
```bash
# Test different paths
curl -I http://localhost/
curl -I http://localhost/admin
curl -I http://localhost/news

# All should return 200, NOT 404
```

### Check PHP-FPM:
```bash
# Check socket exists
ls -la /var/run/php/php8.2-fpm.sock

# Check PHP-FPM is running
systemctl status php8.2-fpm

# Check PHP-FPM logs
sudo tail -30 /var/log/php8.2-fpm.log
```

### Check Laravel:
```bash
cd /var/www/website-pramuka

# Check artisan works
php artisan --version

# Check routes
php artisan route:list | head -20

# Check if Filament loads
php artisan about
```

---

## 📋 COMPLETE FIX SEQUENCE

**Run these in order:**

```bash
# 1. SSH to server
ssh root@your-server-ip

# 2. Navigate
cd /var/www/website-pramuka

# 3. Fix .env
sed -i 's/APP_ENV=local/APP_ENV=production/' .env
sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env

# 4. Remove vendor
rm -rf vendor/

# 5. Reinstall composer
COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader --no-dev

# 6. Clear caches
rm -rf bootstrap/cache/*.php
rm -rf storage/framework/cache/data/*
rm -rf storage/framework/sessions/*
rm -rf storage/framework/views/*

# 7. Optimize
php artisan optimize:clear
php artisan optimize

# 8. Fix permissions
chown -R www-data:www-data .
chmod -R 775 storage bootstrap/cache

# 9. Check Nginx
nginx -t
systemctl reload nginx

# 10. Restart services
systemctl restart php8.2-fpm
systemctl reload nginx

# 11. Test
curl -I http://localhost
```

**Expected output:** `HTTP/1.1 200 OK`

---

## 🎯 IF STILL NOT WORKING

### Get Complete Diagnostic:

```bash
cd /var/www/website-pramuka

echo "=== COMPOSER ==="
COMPOSER_ALLOW_SUPERUSER=1 composer diagnose

echo "=== FILAMENT ==="
ls -la vendor/filament/ 2>&1

echo "=== ARTISAN ==="
php artisan --version 2>&1

echo "=== NGINX ==="
nginx -t 2>&1

echo "=== PHP-FPM ==="
systemctl status php8.2-fpm 2>&1

echo "=== PERMISSIONS ==="
ls -la storage/ | head -5
ls -la public/

echo "=== .ENV ==="
grep -E "APP_ENV|APP_DEBUG|APP_URL" .env

echo "=== LAST ERRORS ==="
tail -20 storage/logs/laravel.log
```

**Share the complete output!**

---

## ✅ SUCCESS CHECKLIST

- [ ] `APP_ENV=production` in .env
- [ ] `APP_DEBUG=false` in .env
- [ ] Vendor directory exists and complete
- [ ] `vendor/filament/` directory exists
- [ ] `php artisan --version` works
- [ ] Nginx config has correct root path
- [ ] Site enabled in sites-enabled/
- [ ] PHP-FPM socket exists and running
- [ ] Permissions: storage (775), bootstrap/cache (775)
- [ ] Owner: www-data:www-data
- [ ] `curl http://localhost` returns 200
- [ ] No errors in storage/logs/laravel.log

---

**Priority Actions:**
1. Run `emergency-fix.sh` first
2. If 404 persists, run `fix-nginx-404.sh`
3. If Filament error persists, manually remove vendor/ and reinstall
4. Share diagnostic output if still broken
