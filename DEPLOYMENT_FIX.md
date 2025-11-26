# Server Deployment Fix Guide

## Issue Summary
1. ❌ Class "Spatie\Sitemap\Sitemap" not found - package not installed on server
2. ❌ Duplicate schedule entry (was showing twice in `schedule:list`)

## Fixed Issues
✅ Removed duplicate schedule from `routes/console.php` (keeping it in `bootstrap/app.php` per Laravel 12 conventions)

## Server Commands to Run

### 1. Install Missing Dependencies
```bash
cd /var/www/website-pramuka
composer install --optimize-autoloader --no-dev
```

This will install `spatie/laravel-sitemap` and all required dependencies.

### 2. Clear All Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### 3. Optimize for Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 4. Verify Installation
```bash
# Check if sitemap command works
php artisan sitemap:generate

# Should see:
# Generating sitemap...
# Added static pages
# Added profile pages: X
# Added organization pages: X
# Added news pages: X
# Added agenda pages: X
# ✓ Sitemap generated successfully at: /var/www/website-pramuka/public/sitemap.xml
```

### 5. Verify Schedule (Should Show Only Once Now)
```bash
php artisan schedule:list

# Should see only ONE entry:
# 0 0 * * *  php artisan sitemap:generate .................. Next Due: 12 hours from now
```

### 6. Setup Cron Job (If Not Already Configured)
```bash
# Edit crontab
crontab -e

# Add this line (runs Laravel scheduler every minute)
* * * * * cd /var/www/website-pramuka && php artisan schedule:run >> /dev/null 2>&1
```

## Explanation

### Why the Error Happened
The `spatie/laravel-sitemap` package is declared in `composer.json` but wasn't installed on the production server. This happens when:
- Dependencies are installed locally but not pushed to git (vendor/ is gitignored)
- Server didn't run `composer install` after pulling latest code
- Server ran `composer install --no-dev` but package was in wrong section

### Why Duplicate Schedule
The schedule was defined in TWO places:
1. ❌ `routes/console.php` - Old Laravel way (removed)
2. ✅ `bootstrap/app.php` - Laravel 12 way (kept)

In Laravel 12, schedules should be defined in `bootstrap/app.php` using the `->withSchedule()` method.

## Verification Checklist

- [ ] `composer install` completed successfully
- [ ] `php artisan sitemap:generate` works without errors
- [ ] `php artisan schedule:list` shows only ONE sitemap entry
- [ ] Sitemap file created at `public/sitemap.xml`
- [ ] Sitemap accessible at `https://your-domain.com/sitemap.xml`
- [ ] Cron job configured and running

## Testing

```bash
# Test sitemap generation
php artisan sitemap:generate

# Check generated file
ls -lh public/sitemap.xml

# View sitemap content
head -n 20 public/sitemap.xml

# Test via web (replace with your domain)
curl https://your-domain.com/sitemap.xml

# Test robots.txt
curl https://your-domain.com/robots.txt
```

## Common Issues

### Issue: "composer: command not found"
```bash
# Install composer on server
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### Issue: Permission denied writing sitemap
```bash
# Fix permissions
sudo chown -R www-data:www-data /var/www/website-pramuka/public
sudo chmod -R 755 /var/www/website-pramuka/public
```

### Issue: Schedule not running
```bash
# Check if cron is active
sudo systemctl status cron

# Check Laravel logs
tail -f /var/www/website-pramuka/storage/logs/laravel.log

# Manually test schedule
php artisan schedule:run
```

## Production Deployment Checklist

Every time you deploy to production:

```bash
# 1. Pull latest code
git pull origin main

# 2. Install dependencies
composer install --optimize-autoloader --no-dev

# 3. Run migrations (if any)
php artisan migrate --force

# 4. Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 5. Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Generate sitemap
php artisan sitemap:generate

# 7. Build frontend assets (if changed)
npm install --production
npm run build

# 8. Set permissions
sudo chown -R www-data:www-data storage bootstrap/cache public
sudo chmod -R 775 storage bootstrap/cache
```

---

**Status:** Ready for server deployment
**Date:** 2025-11-26
**Branch:** dev → main
