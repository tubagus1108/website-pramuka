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
* * * * * cd /var/www/website-pramuka && php artisan schedule:run >> /var/www/website-pramuka/storage/logs/cron.log 2>&1
```

**Note:** We redirect output to `storage/logs/cron.log` instead of `/dev/null` for debugging purposes.

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

## Debugging Cron Jobs

### 1. Check if Cron is Running
```bash
# Check cron service status
sudo systemctl status cron

# Or for older systems
sudo service cron status

# If stopped, start it
sudo systemctl start cron
```

### 2. Verify Crontab Entry
```bash
# List current user's crontab
crontab -l

# Should see:
# * * * * * cd /var/www/website-pramuka && php artisan schedule:run >> /var/www/website-pramuka/storage/logs/cron.log 2>&1

# List root's crontab (if using root)
sudo crontab -l
```

### 3. Monitor Cron Logs in Real-Time
```bash
# Watch cron log file (if redirected to file)
tail -f /var/www/website-pramuka/storage/logs/cron.log

# Watch system cron log
sudo tail -f /var/log/syslog | grep CRON

# Or on some systems
sudo tail -f /var/log/cron
```

### 4. Check Laravel Scheduler Log
```bash
# Create a test to see if schedule runs
cd /var/www/website-pramuka

# Run schedule manually (should execute immediately)
php artisan schedule:run

# Check what would run
php artisan schedule:list

# Run specific command manually
php artisan sitemap:generate
```

### 5. Test Cron Execution Manually
```bash
# Run the exact command that cron runs
cd /var/www/website-pramuka && php artisan schedule:run

# Should see output like:
# No scheduled commands are ready to run.
# OR
# Running scheduled command: php artisan sitemap:generate
```

### 6. Enable Detailed Logging
Add this to `bootstrap/app.php` after the schedule definition for debugging:

```php
->withSchedule(function (Schedule $schedule) {
    $schedule->command('sitemap:generate')
        ->daily()
        ->appendOutputTo(storage_path('logs/sitemap-schedule.log'));
})
```

Then check the log:
```bash
tail -f /var/www/website-pramuka/storage/logs/sitemap-schedule.log
```

### 7. Check File Permissions
```bash
# Ensure cron can write to storage
ls -la /var/www/website-pramuka/storage/logs/

# Fix if needed
sudo chown -R www-data:www-data /var/www/website-pramuka/storage
sudo chmod -R 775 /var/www/website-pramuka/storage
```

### 8. Create Test Schedule (Temporary Debug)
Add a test schedule that runs every minute to verify cron is working:

```php
// In bootstrap/app.php
->withSchedule(function (Schedule $schedule) {
    $schedule->command('sitemap:generate')->daily();
    
    // Temporary test - runs every minute
    $schedule->call(function () {
        \Log::info('Cron is working! Time: ' . now());
    })->everyMinute();
})
```

Then watch the log:
```bash
tail -f /var/www/website-pramuka/storage/logs/laravel.log
```

You should see "Cron is working!" entries every minute. **Remove this test after verification.**

### 9. Check Cron Environment
Cron runs with limited environment variables. Test if PHP path is correct:

```bash
# Add temporary debug to crontab
* * * * * which php >> /tmp/cron-debug.log 2>&1
* * * * * cd /var/www/website-pramuka && php -v >> /tmp/cron-debug.log 2>&1

# Wait 1 minute then check
cat /tmp/cron-debug.log

# Remove debug entries after checking
crontab -e
```

### 10. Quick Debug Checklist
```bash
# Run all these commands to diagnose
echo "=== Cron Service Status ==="
sudo systemctl status cron

echo -e "\n=== Crontab Entries ==="
crontab -l

echo -e "\n=== Laravel Schedule List ==="
cd /var/www/website-pramuka && php artisan schedule:list

echo -e "\n=== Manual Schedule Run ==="
cd /var/www/website-pramuka && php artisan schedule:run

echo -e "\n=== Cron Log (last 20 lines) ==="
tail -n 20 /var/www/website-pramuka/storage/logs/cron.log

echo -e "\n=== Laravel Log (last 20 lines) ==="
tail -n 20 /var/www/website-pramuka/storage/logs/laravel.log

echo -e "\n=== Storage Permissions ==="
ls -la /var/www/website-pramuka/storage/logs/
```

### 11. Common Cron Issues & Solutions

**Issue: Cron runs but command fails**
```bash
# Check if artisan is executable
ls -la /var/www/website-pramuka/artisan

# Make executable if needed
chmod +x /var/www/website-pramuka/artisan
```

**Issue: "php: command not found" in cron**
```bash
# Use full PHP path in crontab
which php  # Get full path, e.g., /usr/bin/php

# Update crontab to use full path
* * * * * cd /var/www/website-pramuka && /usr/bin/php artisan schedule:run >> /var/www/website-pramuka/storage/logs/cron.log 2>&1
```

**Issue: Schedule shows "Next Due: X hours" but never runs**
```bash
# Check server timezone
php -r "echo date_default_timezone_get();"

# Should match APP_TIMEZONE in .env
cat /var/www/website-pramuka/.env | grep APP_TIMEZONE

# Update if needed
php artisan config:clear
php artisan config:cache
```

**Issue: Multiple cron entries running**
```bash
# Check for duplicate crons
crontab -l
sudo crontab -l

# Remove duplicates
crontab -e
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
