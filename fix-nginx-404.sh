#!/bin/bash

# Nginx Configuration Checker & Fixer
# Run if website shows 404 error

echo "🔍 Nginx Configuration Check"
echo "============================="
echo ""

PROJECT_DIR="/var/www/website-pramuka"

# Check if project exists
if [ ! -d "$PROJECT_DIR" ]; then
    echo "❌ Project directory not found: $PROJECT_DIR"
    exit 1
fi

# Check Nginx config
echo "[1/5] Testing Nginx configuration..."
nginx -t
echo ""

# Check sites-enabled
echo "[2/5] Checking enabled sites..."
echo "Sites in /etc/nginx/sites-enabled/:"
ls -la /etc/nginx/sites-enabled/
echo ""

# Check if our site is enabled
SITE_NAME="website-pramuka"
if [ -f "/etc/nginx/sites-enabled/$SITE_NAME" ]; then
    echo "✅ $SITE_NAME is enabled"
else
    echo "❌ $SITE_NAME NOT enabled!"
    echo "Available sites:"
    ls -la /etc/nginx/sites-available/ | grep -v "^total" | grep -v "^d"
    echo ""
    
    if [ -f "/etc/nginx/sites-available/$SITE_NAME" ]; then
        echo "Enabling site..."
        ln -sf /etc/nginx/sites-available/$SITE_NAME /etc/nginx/sites-enabled/
        echo "✅ Site enabled"
    else
        echo "❌ Site config not found in sites-available!"
        echo "Need to create Nginx config first"
        exit 1
    fi
fi
echo ""

# Check public directory
echo "[3/5] Checking public directory..."
if [ -f "$PROJECT_DIR/public/index.php" ]; then
    echo "✅ public/index.php exists"
    echo "Public directory contents:"
    ls -la "$PROJECT_DIR/public/" | head -10
else
    echo "❌ public/index.php NOT FOUND!"
    echo "Laravel not properly installed"
    exit 1
fi
echo ""

# Check current Nginx config
echo "[4/5] Current Nginx config for this site:"
if [ -f "/etc/nginx/sites-available/$SITE_NAME" ]; then
    echo "---"
    cat "/etc/nginx/sites-available/$SITE_NAME" | grep -E "root|server_name|try_files|fastcgi_pass" | head -10
    echo "---"
else
    echo "❌ Config file not found"
fi
echo ""

# Verify root path in Nginx
echo "[5/5] Verifying Nginx root path..."
NGINX_ROOT=$(grep "root" /etc/nginx/sites-available/$SITE_NAME 2>/dev/null | head -1 | awk '{print $2}' | tr -d ';')
echo "Nginx root: $NGINX_ROOT"
echo "Project public: $PROJECT_DIR/public"

if [ "$NGINX_ROOT" = "$PROJECT_DIR/public" ]; then
    echo "✅ Root path correct"
else
    echo "❌ ROOT PATH MISMATCH!"
    echo "Need to update Nginx config"
    
    # Offer to fix
    read -p "Fix Nginx config now? (y/n) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        echo "Updating Nginx config..."
        sed -i "s|root .*public;|root $PROJECT_DIR/public;|" /etc/nginx/sites-available/$SITE_NAME
        nginx -t && systemctl reload nginx
        echo "✅ Nginx config updated"
    fi
fi
echo ""

# Reload Nginx
echo "Reloading Nginx..."
systemctl reload nginx
echo "✅ Nginx reloaded"
echo ""

# Test
echo "============================="
echo "🧪 Testing website..."
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost)
echo "HTTP Status: $HTTP_CODE"

if [ "$HTTP_CODE" = "200" ]; then
    echo "✅ Website working!"
elif [ "$HTTP_CODE" = "404" ]; then
    echo "❌ Still 404!"
    echo ""
    echo "Common causes:"
    echo "1. try_files missing in Nginx config"
    echo "2. Wrong root path"
    echo "3. index.php not in fastcgi_pass config"
    echo ""
    echo "Check full Nginx config:"
    echo "cat /etc/nginx/sites-available/$SITE_NAME"
fi
echo ""
