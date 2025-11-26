# 🔧 Troubleshooting PageSpeed Issues

## ❌ Problem: All Red Scores in PageSpeed Insights

**Symptoms:**
- Performance: ❌ (Red)
- Accessibility: ❌ (Red)
- Best Practices: ❌ (Red)
- SEO: ❌ (Red)
- Page tidak bisa load sama sekali

**Root Cause:**
Error di production yang menyebabkan JavaScript/CSS tidak load dengan benar.

**Common Causes & Solutions:**

### 1. ❌ Vite Assets Tidak Ditemukan

**Cause:** Build files tidak ada atau path salah

**Solution:**
```bash
# SSH ke server
ssh root@your-server-ip
cd /var/www/website-pramuka

# Rebuild assets
npm run build

# Check build files exist
ls -la public/build/assets/

# Should see:
# - css/app-*.css
# - js/app-*.js
# - js/vendor-*.js
```

### 2. ❌ Permissions Error

**Cause:** Web server tidak bisa akses build files

**Solution:**
```bash
# Fix ownership
sudo chown -R www-data:www-data public/build

# Fix permissions
sudo chmod -R 755 public/build
```

### 3. ❌ Wrong Vite Directive Usage

**WRONG (Causes Error):**
```blade
<!-- ❌ DON'T USE Vite::asset() for source files! -->
<link href="{{ Vite::asset('resources/css/app.css') }}">
<script src="{{ Vite::asset('resources/js/app.js') }}"></script>
```

**CORRECT:**
```blade
<!-- ✅ Use @vite directive -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

**Why?**
- `@vite` directive automatically handles dev vs production
- In production, it reads `public/build/manifest.json` to find compiled files
- `Vite::asset()` expects manifest keys, NOT source paths

### 4. ❌ Cache Issues

**Cause:** Old cached files being served

**Solution:**
```bash
# Clear Laravel cache
php artisan optimize:clear
php artisan cache:clear
php artisan view:clear
php artisan config:clear
php artisan route:clear

# Clear Nginx cache (if enabled)
sudo rm -rf /var/cache/nginx/*
sudo systemctl reload nginx

# Clear CDN/Cloudflare cache (if using)
# Go to Cloudflare dashboard → Caching → Purge Everything
```

### 5. ❌ Manifest.json Missing or Corrupt

**Cause:** Build failed or manifest.json not generated

**Solution:**
```bash
# Check if manifest exists
cat public/build/manifest.json

# Should see JSON like:
# {
#   "resources/css/app.css": {
#     "file": "assets/css/app-CB2QfE8-.css",
#     "isEntry": true,
#     "src": "resources/css/app.css"
#   },
#   ...
# }

# If missing or empty, rebuild:
npm run build
```

### 6. ❌ NODE_ENV Issues

**Cause:** Building with wrong environment

**Solution:**
```bash
# Ensure production build
NODE_ENV=production npm run build

# Or use build script (already in package.json)
npm run build
```

---

## ✅ Verification Steps After Fix

### Step 1: Check Files Exist
```bash
ls -la public/build/manifest.json
ls -la public/build/assets/css/
ls -la public/build/assets/js/
```

### Step 2: Test Homepage Locally
```bash
# Start local server
php artisan serve

# Visit: http://localhost:8000
# Open DevTools (F12) → Console
# Should see NO red errors
```

### Step 3: Check Network Tab
```
F12 → Network → Reload page

Look for:
✅ app-*.css (Status 200, Size ~86KB)
✅ app-*.js (Status 200, Size ~1KB)
✅ vendor-*.js (Status 200, Size ~36KB)

If Status 404:
❌ Build files missing - run `npm run build`

If Status 500:
❌ Server error - check Laravel logs:
   tail -f storage/logs/laravel.log
```

### Step 4: Test Production
```bash
# After deploying to server
curl -I https://your-domain.com

# Should see:
# HTTP/2 200
# content-type: text/html; charset=UTF-8

# Not:
# HTTP/2 500 (Server Error)
# HTTP/2 404 (Not Found)
```

### Step 5: PageSpeed Test
```
1. Wait 2 minutes after deployment (cache propagation)
2. Visit: https://pagespeed.web.dev/
3. Enter: https://your-domain.com
4. Click "Analyze"

Expected:
✅ Performance: 85-95 (Orange/Green)
✅ Accessibility: 70+ (Orange/Green)
✅ Best Practices: 70+ (Orange/Green)
✅ SEO: 90+ (Green)

NOT:
❌ All Red (0-49) = Error on page!
```

---

## 🚨 Emergency Rollback

If deployment breaks the site:

```bash
# SSH to server
ssh root@your-server-ip
cd /var/www/website-pramuka

# Find last working commit
git log --oneline -10

# Rollback to specific commit (example)
git reset --hard 37cc22f

# Rebuild
npm run build
php artisan optimize:clear

# Reload server
sudo systemctl reload nginx
```

**Safe Commits:**
- `37cc22f` - Automated deployment script
- `01e17c7` - Documentation update (safe)
- `d85b70c` - Performance optimizations (tested)

**Fixed Commits:**
- `69ebc92` - ✅ **LATEST FIX** - Vite directive corrected
- `c2a9d41` - ✅ Documentation update

---

## 📞 Quick Diagnostic Commands

```bash
# Check if site is up
curl -I https://your-domain.com

# Check Nginx status
sudo systemctl status nginx

# Check PHP-FPM status
sudo systemctl status php8.2-fpm

# Check recent errors
sudo tail -50 /var/log/nginx/error.log
tail -50 storage/logs/laravel.log

# Check disk space
df -h

# Check memory
free -m

# Check build files size
du -sh public/build/
```

---

## ✅ Current Status (November 26, 2025)

**Latest Commit:** `c2a9d41` - Documentation update
**Previous Fix:** `69ebc92` - Vite directive fix (CRITICAL)
**Build Status:** ✅ Successful (2.18s)
**Assets:**
- CSS: 85.91 KB (PurgeCSS applied)
- JS App: 1.00 KB
- JS Vendor: 35.70 KB

**Known Issues:** None
**Ready to Deploy:** ✅ YES

**Next Steps:**
1. Deploy to production using `./deploy.sh`
2. Wait 2 minutes
3. Test PageSpeed
4. Should see 85-95 score (up from 53-84)
