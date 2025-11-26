# 🚀 Quick Performance Deployment Guide

## Server Deployment Commands

```bash
# 1. Pull latest code
cd /var/www/website-pramuka
git pull origin main

# 2. Install dependencies
composer install --optimize-autoloader --no-dev
npm install --production

# 3. Build assets with optimizations
npm run build

# 4. Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 5. Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Generate sitemap
php artisan sitemap:generate

# 7. Set correct permissions
sudo chown -R www-data:www-data storage bootstrap/cache public
sudo chmod -R 775 storage bootstrap/cache
sudo chmod -R 755 public

# 8. Enable Apache modules
sudo a2enmod deflate expires headers rewrite
sudo systemctl restart apache2
```

## 📊 Verify Optimizations

### 1. Check Gzip Compression
```bash
curl -H "Accept-Encoding: gzip" -I https://your-domain.com
# Should see: Content-Encoding: gzip
```

### 2. Check Cache Headers
```bash
curl -I https://your-domain.com/build/assets/app-*.css
# Should see: Cache-Control: public, max-age=31536000, immutable
```

### 3. Check Security Headers
```bash
curl -I https://your-domain.com
# Should see:
# X-Content-Type-Options: nosniff
# X-Frame-Options: SAMEORIGIN
# X-XSS-Protection: 1; mode=block
```

### 4. Test PageSpeed
```
https://pagespeed.web.dev/
Enter: https://your-domain.com
```

## 🎯 Expected Results

### Before
- Performance: 61-76
- Accessibility: 72-82
- Best Practices: 77
- SEO: 92

### After
- ✅ Performance: **90-100**
- ✅ Accessibility: **85-95**
- ✅ Best Practices: **95-100**
- ✅ SEO: **92-100**

## 🔧 Implemented Features

### 1. Resource Loading
- ✅ DNS Prefetch & Preconnect
- ✅ Async Font Loading
- ✅ Resource Hints
- ✅ Preload Critical Assets

### 2. Image Optimization
- ✅ Lazy Loading Component
- ✅ Intersection Observer
- ✅ Native Lazy Loading
- ✅ Width/Height Attributes
- ✅ Fetchpriority for LCP

### 3. JavaScript
- ✅ Code Splitting
- ✅ Terser Minification
- ✅ Remove Console Logs
- ✅ Deferred Loading

### 4. CSS
- ✅ Lightning CSS Minification
- ✅ Purge Unused CSS
- ✅ Critical CSS Inlining

### 5. Server
- ✅ Gzip Compression
- ✅ Browser Caching (1 year)
- ✅ Security Headers
- ✅ HTML Minification
- ✅ ETag Removal

### 6. Middleware
- ✅ OptimizeResponse Middleware
- ✅ Cache-Control Headers
- ✅ Security Headers
- ✅ HTML Minification

## 📂 Modified Files

```
app/
├── Http/
│   └── Middleware/
│       └── OptimizeResponse.php          [NEW] Response optimization

bootstrap/
└── app.php                                [MODIFIED] Added middleware

public/
└── .htaccess                              [MODIFIED] Compression, caching, security

resources/
├── css/
│   └── app.css                            [EXISTING] Tailwind CSS
├── js/
│   ├── app.js                             [MODIFIED] Import lazy-load
│   └── lazy-load.js                       [NEW] Image lazy loading
└── views/
    ├── components/
    │   └── optimized-image.blade.php      [NEW] Image component
    └── layouts/
        └── app.blade.php                  [MODIFIED] Preconnect, async fonts

vite.config.js                             [MODIFIED] Build optimizations
package.json                               [MODIFIED] Added terser
```

## 🎨 Usage Examples

### Optimized Image Component

```blade
{{-- Hero/LCP image (eager) --}}
<x-optimized-image 
    src="{{ Storage::url($slider->image) }}" 
    alt="{{ $slider->title }}"
    width="1200"
    height="400"
    eager
    fetchpriority="high"
    class="w-full h-full object-cover"
/>

{{-- Content images (lazy) --}}
<x-optimized-image 
    src="{{ Storage::url($news->image) }}" 
    alt="{{ $news->title }}"
    width="400"
    height="300"
    loading="lazy"
    class="rounded-lg"
/>
```

## 🐛 Troubleshooting

### Issue: CSS/JS not updated
```bash
# Clear Vite manifest
rm -rf public/build/*
npm run build
php artisan view:clear
```

### Issue: Images not lazy loading
```bash
# Check browser console for errors
# Verify lazy-load.js is loaded
# Check Network tab for image requests
```

### Issue: Gzip not working
```bash
# Check if mod_deflate enabled
apache2ctl -M | grep deflate

# Enable if missing
sudo a2enmod deflate
sudo systemctl restart apache2
```

### Issue: Cache headers not set
```bash
# Check if mod_expires and mod_headers enabled
apache2ctl -M | grep -E "(expires|headers)"

# Enable if missing
sudo a2enmod expires headers
sudo systemctl restart apache2
```

## 📈 Monitoring

### Local Testing
```bash
# Chrome DevTools
F12 → Lighthouse → Generate Report

# Check bundle size
npm run build
ls -lh public/build/assets/
```

### Production Testing
```bash
# PageSpeed Insights
https://pagespeed.web.dev/

# WebPageTest
https://www.webpagetest.org/

# GTmetrix
https://gtmetrix.com/
```

## 🔄 Maintenance

### Weekly
- [ ] Run PageSpeed test
- [ ] Check error logs
- [ ] Monitor Core Web Vitals

### Monthly
- [ ] Update dependencies (`composer update`, `npm update`)
- [ ] Review unused CSS/JS
- [ ] Optimize database queries
- [ ] Check image sizes

### After Content Updates
```bash
# Regenerate sitemap
php artisan sitemap:generate

# Clear view cache
php artisan view:clear

# Rebuild assets if CSS/JS changed
npm run build
```

---

**Status:** ✅ Production Ready
**Performance Target:** 90-100
**Last Updated:** 2025-11-26
