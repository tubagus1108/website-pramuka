# Nginx Configuration Guide for Laravel Performance

## 📋 Overview
This guide provides optimal Nginx configuration for Laravel application with maximum performance optimizations.

## 🚀 Quick Setup

### 1. Copy Nginx Configuration
```bash
cd /var/www/website-pramuka
sudo cp nginx.conf /etc/nginx/sites-available/website-pramuka
```

### 2. Update Server Name
Edit the configuration:
```bash
sudo nano /etc/nginx/sites-available/website-pramuka
```

Change `your-domain.com` to your actual domain:
```nginx
server_name pramuka.uinsuna.ac.id www.pramuka.uinsuna.ac.id;
```

### 3. Update PHP Version
Find and update PHP-FPM socket path (if needed):
```nginx
fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
```

Check your PHP version:
```bash
php -v
ls -la /var/run/php/
```

### 4. Enable Site
```bash
# Create symlink
sudo ln -s /etc/nginx/sites-available/website-pramuka /etc/nginx/sites-enabled/

# Remove default site (optional)
sudo rm /etc/nginx/sites-enabled/default

# Test configuration
sudo nginx -t

# Reload Nginx
sudo systemctl reload nginx
```

## 🔧 Configuration Features

### 1. Gzip Compression
**Impact:** 60-80% file size reduction

```nginx
gzip on;
gzip_vary on;
gzip_min_length 1024;
gzip_comp_level 6;
gzip_types text/plain text/css application/json application/javascript text/xml;
```

**Verify:**
```bash
curl -H "Accept-Encoding: gzip" -I https://your-domain.com
# Should see: Content-Encoding: gzip
```

### 2. Browser Caching
**Impact:** Eliminates redundant downloads

```nginx
# Images - 1 year
location ~* \.(jpg|jpeg|png|gif|ico|svg|webp)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}

# CSS/JS - 1 year
location ~* \.(css|js)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}

# Fonts - 1 year
location ~* \.(woff|woff2|ttf|otf|eot)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}
```

**Verify:**
```bash
curl -I https://your-domain.com/build/assets/app-*.css
# Should see: Cache-Control: public, immutable
# Should see: Expires: (1 year from now)
```

### 3. Security Headers
**Impact:** Improves Best Practices score

```nginx
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-Content-Type-Options "nosniff" always;
add_header X-XSS-Protection "1; mode=block" always;
add_header Referrer-Policy "strict-origin-when-cross-origin" always;
```

**Verify:**
```bash
curl -I https://your-domain.com
# Should see all security headers
```

### 4. PHP-FPM Optimization
```nginx
fastcgi_read_timeout 300;
fastcgi_buffer_size 128k;
fastcgi_buffers 4 256k;
fastcgi_busy_buffers_size 256k;
```

### 5. File Upload Size
```nginx
client_max_body_size 100M;
client_body_buffer_size 128k;
```

## 🔐 SSL/HTTPS Configuration

### 1. Install Certbot (Let's Encrypt)
```bash
sudo apt update
sudo apt install certbot python3-certbot-nginx
```

### 2. Obtain SSL Certificate
```bash
sudo certbot --nginx -d pramuka.uinsuna.ac.id -d www.pramuka.uinsuna.ac.id
```

### 3. Auto-renewal
```bash
# Test renewal
sudo certbot renew --dry-run

# Certbot creates cron job automatically
# Check with:
sudo systemctl status certbot.timer
```

### 4. SSL Configuration (Auto-added by Certbot)
Certbot will add:
```nginx
listen 443 ssl http2;
ssl_certificate /etc/letsencrypt/live/your-domain/fullchain.pem;
ssl_certificate_key /etc/letsencrypt/live/your-domain/privkey.pem;
```

### 5. Force HTTPS
After SSL is working, add redirect in HTTP block:
```nginx
server {
    listen 80;
    server_name pramuka.uinsuna.ac.id www.pramuka.uinsuna.ac.id;
    return 301 https://$server_name$request_uri;
}
```

## ⚡ Advanced Performance Optimizations

### 1. HTTP/2
Already enabled in SSL config:
```nginx
listen 443 ssl http2;
```

### 2. Brotli Compression (Better than Gzip)
```bash
# Install Brotli module
sudo apt install libnginx-mod-http-brotli

# Add to nginx.conf
brotli on;
brotli_comp_level 6;
brotli_types text/plain text/css application/json application/javascript;
```

### 3. FastCGI Cache
For high-traffic sites:
```nginx
# In http block (/etc/nginx/nginx.conf)
fastcgi_cache_path /var/cache/nginx levels=1:2 keys_zone=LARAVEL:100m inactive=60m;

# In server block
set $skip_cache 0;

# Don't cache POST requests
if ($request_method = POST) {
    set $skip_cache 1;
}

# Don't cache admin
if ($request_uri ~* "/admin|/filament") {
    set $skip_cache 1;
}

location ~ \.php$ {
    fastcgi_cache LARAVEL;
    fastcgi_cache_valid 200 60m;
    fastcgi_cache_bypass $skip_cache;
    fastcgi_no_cache $skip_cache;
    add_header X-FastCGI-Cache $upstream_cache_status;
}
```

### 4. Open File Cache
```nginx
# In http block
open_file_cache max=1000 inactive=20s;
open_file_cache_valid 30s;
open_file_cache_min_uses 2;
open_file_cache_errors on;
```

### 5. Connection Optimization
```nginx
# In http block
keepalive_timeout 65;
keepalive_requests 100;
sendfile on;
tcp_nopush on;
tcp_nodelay on;
```

## 🧪 Testing & Verification

### 1. Test Nginx Configuration
```bash
sudo nginx -t
```

### 2. Reload Without Downtime
```bash
sudo systemctl reload nginx
```

### 3. Check Logs
```bash
# Access log
sudo tail -f /var/log/nginx/website-pramuka-access.log

# Error log
sudo tail -f /var/log/nginx/website-pramuka-error.log

# Nginx error log
sudo tail -f /var/log/nginx/error.log
```

### 4. Test Gzip
```bash
curl -H "Accept-Encoding: gzip" -I https://your-domain.com | grep -i "content-encoding"
```

### 5. Test Cache Headers
```bash
curl -I https://your-domain.com/build/assets/app-*.css | grep -i "cache-control"
```

### 6. Test Security Headers
```bash
curl -I https://your-domain.com | grep -i "x-frame-options"
```

### 7. Load Testing
```bash
# Install Apache Bench
sudo apt install apache2-utils

# Test with 1000 requests, 10 concurrent
ab -n 1000 -c 10 https://your-domain.com/
```

## 📊 Performance Monitoring

### 1. Nginx Status Module
Enable in nginx.conf:
```nginx
location /nginx_status {
    stub_status on;
    access_log off;
    allow 127.0.0.1;
    deny all;
}
```

Check status:
```bash
curl http://localhost/nginx_status
```

### 2. PHP-FPM Status
Enable in PHP-FPM pool:
```bash
sudo nano /etc/php/8.2/fpm/pool.d/www.conf
```

Add:
```ini
pm.status_path = /fpm-status
```

Add to Nginx:
```nginx
location ~ ^/(fpm-status|fpm-ping)$ {
    access_log off;
    allow 127.0.0.1;
    deny all;
    include fastcgi_params;
    fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
}
```

Check status:
```bash
curl http://localhost/fpm-status
```

## 🔍 Troubleshooting

### Issue: 502 Bad Gateway
```bash
# Check PHP-FPM
sudo systemctl status php8.2-fpm
sudo systemctl restart php8.2-fpm

# Check socket
ls -la /var/run/php/php8.2-fpm.sock

# Check logs
sudo tail -f /var/log/php8.2-fpm.log
```

### Issue: Permission Denied
```bash
# Check Nginx user
ps aux | grep nginx

# Should be www-data

# Fix permissions
sudo chown -R www-data:www-data /var/www/website-pramuka
sudo chmod -R 755 /var/www/website-pramuka
sudo chmod -R 775 /var/www/website-pramuka/storage
sudo chmod -R 775 /var/www/website-pramuka/bootstrap/cache
```

### Issue: Assets Not Loading
```bash
# Check file exists
ls -la /var/www/website-pramuka/public/build/

# Check permissions
namei -l /var/www/website-pramuka/public/build/assets/app-*.css

# Check Nginx error log
sudo tail -f /var/log/nginx/error.log
```

### Issue: Slow Response
```bash
# Enable slow log in PHP-FPM
sudo nano /etc/php/8.2/fpm/pool.d/www.conf

# Add:
slowlog = /var/log/php-fpm-slow.log
request_slowlog_timeout = 5s

# Restart
sudo systemctl restart php8.2-fpm

# Monitor
sudo tail -f /var/log/php-fpm-slow.log
```

## 📝 Best Practices

### 1. Separate Config Files
```bash
# Create includes directory
sudo mkdir -p /etc/nginx/snippets

# Move common configs
sudo nano /etc/nginx/snippets/ssl-params.conf
sudo nano /etc/nginx/snippets/security-headers.conf

# Include in main config
include /etc/nginx/snippets/ssl-params.conf;
```

### 2. Log Rotation
Already configured by default, check:
```bash
cat /etc/logrotate.d/nginx
```

### 3. Regular Updates
```bash
sudo apt update
sudo apt upgrade nginx
sudo systemctl reload nginx
```

### 4. Backup Configuration
```bash
sudo cp /etc/nginx/sites-available/website-pramuka /etc/nginx/sites-available/website-pramuka.backup.$(date +%Y%m%d)
```

## 📚 References

- [Nginx Documentation](https://nginx.org/en/docs/)
- [Laravel Deployment](https://laravel.com/docs/11.x/deployment)
- [Let's Encrypt](https://letsencrypt.org/)
- [Mozilla SSL Config](https://ssl-config.mozilla.org/)

---

**Status:** ✅ Production Ready
**Web Server:** Nginx
**Last Updated:** 2025-11-26
