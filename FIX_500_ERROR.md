# 🔧 Fix Laravel 500 Error - Quick Guide

## 🔴 Error: HTTP ERROR 500

**Symptoms:**
- Website shows "This page isn't working"
- HTTP ERROR 500
- Server can't handle request

**Cause:** Server-side error di Laravel application

---

## ✅ SOLUSI CEPAT (Run This First!)

### SSH ke Server dan Run:

```bash
# SSH to server
ssh root@your-server-ip

# Navigate to project
cd /var/www/website-pramuka

# Fix permissions (MOST COMMON FIX!)
sudo chown -R www-data:www-data storage bootstrap/cache public
sudo chmod -R 775 storage bootstrap/cache

# Clear all caches
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Check if .env exists
ls -la .env

# If .env missing, copy from example:
cp .env.example .env
php artisan key:generate

# Reload services
sudo systemctl reload php8.2-fpm
sudo systemctl reload nginx

# Test
curl -I http://localhost
```

---

## 🔍 DIAGNOSIS - Check Error Logs

### 1. Check Laravel Logs (MOST IMPORTANT!)

```bash
# SSH to server
ssh root@your-server-ip
cd /var/www/website-pramuka

# View latest errors
tail -50 storage/logs/laravel.log

# Follow logs in real-time
tail -f storage/logs/laravel.log

# Then visit website to see error appear
```

**Common errors & fixes:**

#### Error: "No application encryption key has been specified"
```bash
php artisan key:generate
php artisan optimize:clear
```

#### Error: "SQLSTATE[HY000] [2002] Connection refused"
```bash
# Check database config in .env
cat .env | grep DB_

# Test database connection
mysql -u your_db_user -p -h localhost your_db_name
```

#### Error: "Class 'X' not found"
```bash
# Regenerate autoload
composer dump-autoload
php artisan optimize:clear
```

#### Error: "Permission denied"
```bash
# Fix permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

---

## 🔧 COMMON FIXES (Try In Order)

### Fix 1: Permissions (90% of cases!)

```bash
cd /var/www/website-pramuka

# Fix ownership
sudo chown -R www-data:www-data .

# Fix specific directories
sudo chmod -R 775 storage
sudo chmod -R 775 bootstrap/cache
sudo chmod -R 755 public

# Verify
ls -la storage/
ls -la bootstrap/cache/
```

### Fix 2: Clear All Caches

```bash
# Clear Laravel caches
php artisan optimize:clear

# If error persists, manually delete cache:
rm -rf storage/framework/cache/*
rm -rf storage/framework/sessions/*
rm -rf storage/framework/views/*
rm -rf bootstrap/cache/*

# Recreate cache
php artisan optimize
```

### Fix 3: Check .env File

```bash
# Check if exists
cat .env

# If missing:
cp .env.example .env

# Set APP_KEY
php artisan key:generate

# Verify critical settings:
cat .env | grep -E "APP_KEY|APP_ENV|APP_DEBUG|DB_"

# Should see:
# APP_ENV=production
# APP_DEBUG=false
# APP_KEY=base64:...
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_DATABASE=...
```

### Fix 4: Composer Dependencies

```bash
# Check if vendor exists
ls -la vendor/

# If missing or incomplete:
composer install --optimize-autoloader --no-dev

# Regenerate autoload
composer dump-autoload
```

### Fix 5: PHP-FPM Configuration

```bash
# Check PHP-FPM status
sudo systemctl status php8.2-fpm

# If stopped, start it:
sudo systemctl start php8.2-fpm

# Restart PHP-FPM
sudo systemctl restart php8.2-fpm

# Check for errors
sudo tail -f /var/log/php8.2-fpm.log
```

### Fix 6: Nginx Configuration

```bash
# Test Nginx config
sudo nginx -t

# If errors, check config:
sudo nano /etc/nginx/sites-available/website-pramuka

# Reload Nginx
sudo systemctl reload nginx

# Check Nginx error log
sudo tail -50 /var/log/nginx/error.log
```

---

## 🐛 ADVANCED DEBUGGING

### Enable Debug Mode (TEMPORARILY!)

```bash
# Edit .env
nano .env

# Change:
APP_DEBUG=false
# To:
APP_DEBUG=true

# Save and clear cache
php artisan config:clear

# Visit website - you'll see detailed error
# ⚠️ IMPORTANT: Set back to false after fixing!
```

### Run Debug Script

```bash
# Upload debug-500.sh to server
# Then run:
chmod +x debug-500.sh
./debug-500.sh

# This will check:
# - Laravel logs
# - PHP-FPM logs
# - Nginx logs
# - File permissions
# - .env configuration
# - Dependencies
# - Database connection
```

### Manual Checks

```bash
# 1. Test PHP
php -v

# 2. Test artisan
php artisan --version

# 3. Test database
php artisan tinker
>>> DB::connection()->getPdo();
>>> exit

# 4. Test specific route
php artisan route:list

# 5. Check disk space
df -h

# 6. Check memory
free -m
```

---

## 🚨 EMERGENCY FIXES

### If Nothing Works - Fresh Install:

```bash
# Backup first!
cd /var/www
sudo cp -r website-pramuka website-pramuka-backup

# Remove problematic files
cd website-pramuka
rm -rf vendor/
rm -rf node_modules/
rm -rf public/build/
rm -rf storage/framework/cache/*
rm -rf storage/framework/sessions/*
rm -rf storage/framework/views/*
rm -rf bootstrap/cache/*

# Reinstall
composer install --optimize-autoloader --no-dev
npm install --production
npm run build

# Setup
cp .env.example .env
nano .env  # Configure DB and APP_KEY
php artisan key:generate
php artisan migrate --force
php artisan optimize

# Fix permissions
sudo chown -R www-data:www-data .
sudo chmod -R 775 storage bootstrap/cache

# Restart services
sudo systemctl restart php8.2-fpm
sudo systemctl reload nginx
```

---

## 📋 CHECKLIST - Verify These

- [ ] **Storage permissions:** `775` with owner `www-data:www-data`
- [ ] **Bootstrap/cache permissions:** `775` with owner `www-data:www-data`
- [ ] **.env file exists** and has `APP_KEY` set
- [ ] **Vendor directory exists** (run `composer install` if not)
- [ ] **PHP-FPM running:** `systemctl status php8.2-fpm`
- [ ] **Nginx running:** `systemctl status nginx`
- [ ] **Database accessible:** Test with `mysql -u user -p database`
- [ ] **PHP version:** 8.2+ (`php -v`)
- [ ] **Memory limit:** 256M+ in php.ini
- [ ] **Disk space:** Not full (`df -h`)

---

## 📞 DIAGNOSTIC COMMANDS

```bash
# Quick diagnostic
cd /var/www/website-pramuka

echo "1. Permissions:"
ls -la storage/ | head -5

echo "2. .env exists:"
[ -f .env ] && echo "✅ YES" || echo "❌ NO"

echo "3. APP_KEY set:"
grep APP_KEY .env | grep -q "base64:" && echo "✅ YES" || echo "❌ NO"

echo "4. Vendor exists:"
[ -d vendor ] && echo "✅ YES" || echo "❌ NO"

echo "5. PHP-FPM status:"
systemctl is-active php8.2-fpm

echo "6. Nginx status:"
systemctl is-active nginx

echo "7. Latest error:"
tail -1 storage/logs/laravel.log

echo "8. Disk space:"
df -h / | tail -1
```

---

## 🎯 MOST LIKELY FIXES (In Order)

1. **Permissions** (70% of cases)
   ```bash
   sudo chown -R www-data:www-data storage bootstrap/cache
   sudo chmod -R 775 storage bootstrap/cache
   ```

2. **Missing APP_KEY** (15% of cases)
   ```bash
   php artisan key:generate
   ```

3. **Cache Issues** (10% of cases)
   ```bash
   php artisan optimize:clear
   rm -rf bootstrap/cache/*
   ```

4. **Missing Dependencies** (3% of cases)
   ```bash
   composer install --no-dev
   ```

5. **Database Connection** (2% of cases)
   ```bash
   # Check .env DB settings
   php artisan migrate:status
   ```

---

## ✅ VERIFICATION

After fixes, verify:

```bash
# Test from server
curl -I http://localhost
# Should see: HTTP/1.1 200 OK

# Test externally
curl -I https://pramukauinsuna.com
# Should see: HTTP/2 200

# Check logs
tail storage/logs/laravel.log
# Should be empty or no recent errors
```

---

**Next Steps:**
1. SSH to server
2. Run quick fix commands above
3. Check Laravel logs
4. Apply specific fix based on error
5. Verify website works

**Need help?** Share the output of:
```bash
tail -50 storage/logs/laravel.log
```
