# 🚀 Deployment Guide - Performance Optimization

## Branch: `performance-optimization`

### ✅ Changes Summary

#### 1. **Performance Optimizations** (Target: Mobile 90+, Desktop 95+)
- ✅ Lazy loading for all images
- ✅ fetchpriority="high" for hero images
- ✅ Width/height attributes to prevent CLS (Cumulative Layout Shift)
- ✅ Async Font Awesome loading (non-blocking)
- ✅ Resource hints (preconnect, dns-prefetch)
- ✅ Inline critical CSS

#### 2. **Accessibility Improvements** (Target: 90+)
- ✅ Skip-to-content link for keyboard users
- ✅ Better alt text descriptions
- ✅ Focus indicators for keyboard navigation
- ✅ Semantic HTML with proper landmarks

#### 3. **Security & Best Practices** (Target: 90+)
- ✅ Security headers config for Nginx
- ✅ Content Security Policy (CSP)
- ✅ Permissions Policy
- ✅ Meta description for SEO

---

## 📋 Deployment Steps

### On Server:

```bash
# 1. Navigate to project directory
cd /var/www/website-pramuka

# 2. Pull the optimization branch
git fetch origin
git checkout performance-optimization
git pull origin performance-optimization

# 3. Install dependencies (if needed)
composer install --optimize-autoloader --no-dev
npm ci

# 4. Build optimized assets
npm run build

# 5. Clear Laravel caches
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Check for large images that need optimization
php artisan images:optimize

# 7. Fix permissions
chown -R www-data:www-data storage bootstrap/cache public
chmod -R 775 storage bootstrap/cache

# 8. Update Nginx configuration (IMPORTANT!)
# See nginx-security-headers.conf file for headers to add
sudo nano /etc/nginx/sites-available/website-pramuka

# Add these headers inside your server block:
# - Content-Security-Policy
# - Permissions-Policy  
# - Strict-Transport-Security

# 9. Test Nginx configuration
sudo nginx -t

# 10. Reload services
sudo systemctl reload nginx
sudo systemctl restart php8.2-fpm
```

---

## 🔧 Nginx Configuration Update

### Add to your Nginx server block:

```nginx
# Inside server block, add these security headers:

location / {
    try_files $uri $uri/ /index.php?$query_string;
    
    # Existing security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;
    
    # NEW: Content Security Policy
    add_header Content-Security-Policy "default-src 'self' https:; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdnjs.cloudflare.com; style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://fonts.googleapis.com; font-src 'self' https://cdnjs.cloudflare.com https://fonts.gstatic.com; img-src 'self' data: https: blob:; connect-src 'self' https:; frame-ancestors 'self';" always;
    
    # NEW: Permissions Policy
    add_header Permissions-Policy "geolocation=(), microphone=(), camera=()" always;
}

# For HTTPS: add HSTS header
add_header Strict-Transport-Security "max-age=31536000; includeSubDomains; preload" always;
```

---

## 🧪 Testing

### After Deployment:

1. **Test Website Loads:**
   ```bash
   curl -I https://pramukauinsuna.com
   # Should return 200 OK
   ```

2. **Check PageSpeed Insights:**
   - Visit: https://pagespeed.web.dev/
   - Enter: `https://pramukauinsuna.com`
   - Check scores:
     - Mobile Performance: Should be 85-95
     - Desktop Performance: Should be 90-98
     - Accessibility: Should be 85-95
     - Best Practices: Should be 85-95
     - SEO: Should stay 90+

3. **Test Accessibility:**
   - Use Tab key to navigate
   - Look for skip-to-content link
   - Check focus indicators are visible
   - Test with screen reader

4. **Verify Images Load:**
   - Check hero slider loads fast
   - Verify lazy loading works (scroll down page)
   - Confirm no layout shift when images load

---

## 📊 Expected Results

### Before Optimization:
- Mobile Performance: **69** ❌
- Mobile Accessibility: **78** ❌
- Mobile Best Practices: **77** ❌
- Desktop Performance: **92** ⚠️

### After Optimization (Expected):
- Mobile Performance: **85-92** ✅
- Mobile Accessibility: **88-95** ✅
- Mobile Best Practices: **90-95** ✅
- Desktop Performance: **95-98** ✅

---

## 🔍 Verification Commands

```bash
# Check if lazy loading is active
curl https://pramukauinsuna.com | grep 'loading="lazy"'

# Check security headers
curl -I https://pramukauinsuna.com | grep -E "Content-Security|Permissions-Policy|X-Frame"

# Check for large images
php artisan images:optimize

# Monitor performance
tail -f storage/logs/laravel.log
```

---

## ⚠️ Rollback Plan (If Issues Occur)

```bash
cd /var/www/website-pramuka

# Rollback to master
git checkout master
git pull origin master

# Rebuild
npm run build
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Restart services
sudo systemctl reload nginx
sudo systemctl restart php8.2-fpm
```

---

## 💡 Additional Recommendations

### For Even Better Scores:

1. **Convert Images to WebP:**
   - Use tools like Squoosh.app or cwebp
   - WebP images are 25-35% smaller than JPG/PNG

2. **Implement Service Worker:**
   - Cache static assets
   - Offline support
   - Faster repeat visits

3. **CDN Implementation:**
   - Cloudflare (free tier)
   - Faster global delivery
   - Additional security

4. **Database Optimization:**
   - Add indexes to frequently queried columns
   - Enable query caching

5. **Enable HTTP/2 Push:**
   - Push critical CSS/JS
   - Faster initial page load

---

## 📞 Support

If you encounter any issues:
1. Check Laravel logs: `tail -f storage/logs/laravel.log`
2. Check Nginx logs: `tail -f /var/log/nginx/website-pramuka-error.log`
3. Test configuration: `sudo nginx -t`
4. Verify permissions: `ls -la storage/ bootstrap/cache/`

---

**Deployed by:** GitHub Actions (when merged to master)  
**Branch:** performance-optimization  
**Date:** November 26, 2025
