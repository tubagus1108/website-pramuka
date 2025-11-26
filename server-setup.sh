#!/bin/bash

# Server Setup Script - Run ONCE on fresh server
# This ensures all server configurations are correct

echo "🚀 Laravel Production Server Setup"
echo "===================================="
echo ""

# Check if running as root
if [ "$EUID" -ne 0 ]; then
    echo "❌ Please run as root: sudo bash server-setup.sh"
    exit 1
fi

PROJECT_DIR="/var/www/website-pramuka"
DOMAIN="pramukauinsuna.com"

echo "[1/15] Updating system packages..."
apt update -qq
echo "✅ System updated"
echo ""

echo "[2/15] Installing PHP 8.2 and extensions..."
apt install -y php8.2-fpm php8.2-cli php8.2-mysql php8.2-xml php8.2-mbstring \
    php8.2-curl php8.2-zip php8.2-gd php8.2-intl php8.2-bcmath \
    php8.2-soap php8.2-redis php8.2-imagick php8.2-opcache
echo "✅ PHP installed"
echo ""

echo "[3/15] Configuring PHP-FPM..."
# Increase memory limit
sed -i 's/memory_limit = .*/memory_limit = 256M/' /etc/php/8.2/fpm/php.ini
sed -i 's/upload_max_filesize = .*/upload_max_filesize = 100M/' /etc/php/8.2/fpm/php.ini
sed -i 's/post_max_size = .*/post_max_size = 100M/' /etc/php/8.2/fpm/php.ini

# Enable OPcache
cat >> /etc/php/8.2/fpm/conf.d/99-opcache.ini << 'EOF'
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000
opcache.revalidate_freq=2
EOF

systemctl restart php8.2-fpm
echo "✅ PHP-FPM configured"
echo ""

echo "[4/15] Installing Nginx..."
apt install -y nginx
echo "✅ Nginx installed"
echo ""

echo "[5/15] Installing MySQL..."
apt install -y mysql-server
echo "✅ MySQL installed"
echo ""

echo "[6/15] Installing Composer..."
if ! command -v composer &> /dev/null; then
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer
    php -r "unlink('composer-setup.php');"
    echo "✅ Composer installed"
else
    echo "✅ Composer already installed"
fi
echo ""

echo "[7/15] Installing Node.js 20..."
if ! command -v node &> /dev/null; then
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
    apt install -y nodejs
    echo "✅ Node.js installed"
else
    echo "✅ Node.js already installed"
fi
echo ""

echo "[8/15] Creating project directory..."
mkdir -p "$PROJECT_DIR"
chown -R www-data:www-data "$PROJECT_DIR"
echo "✅ Project directory created"
echo ""

echo "[9/15] Configuring Nginx..."
cat > /etc/nginx/sites-available/website-pramuka << 'NGINXEOF'
server {
    listen 80;
    listen [::]:80;
    server_name pramukauinsuna.com www.pramukauinsuna.com;

    root /var/www/website-pramuka/public;
    index index.php index.html;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;

    # Gzip
    gzip on;
    gzip_vary on;
    gzip_min_length 1024;
    gzip_comp_level 6;
    gzip_types text/plain text/css application/json application/javascript text/xml application/xml;

    # Static assets caching
    location ~* \.(jpg|jpeg|png|gif|ico|svg|webp|css|js|woff|woff2|ttf|otf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        access_log off;
    }

    location /build/ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        access_log off;
    }

    # Deny sensitive files
    location ~ /\. {
        deny all;
    }

    location ~ /(composer\.json|composer\.lock|\.env|\.git) {
        deny all;
    }

    # Laravel
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # PHP-FPM
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
        fastcgi_read_timeout 300;
        fastcgi_buffer_size 128k;
        fastcgi_buffers 4 256k;
    }

    # Deny PHP in storage
    location ~* /(?:storage|bootstrap/cache)/.*\.php$ {
        deny all;
    }

    client_max_body_size 100M;

    access_log /var/log/nginx/website-pramuka-access.log;
    error_log /var/log/nginx/website-pramuka-error.log;
}
NGINXEOF

# Enable site
ln -sf /etc/nginx/sites-available/website-pramuka /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default

# Test config
nginx -t
systemctl reload nginx
echo "✅ Nginx configured"
echo ""

echo "[10/15] Setting up firewall..."
apt install -y ufw
ufw --force enable
ufw allow 22/tcp
ufw allow 80/tcp
ufw allow 443/tcp
echo "✅ Firewall configured"
echo ""

echo "[11/15] Configuring Git..."
if [ -d "$PROJECT_DIR/.git" ]; then
    cd "$PROJECT_DIR"
    git config --global --add safe.directory "$PROJECT_DIR"
    git config user.email "deploy@pramukauinsuna.com"
    git config user.name "Deploy Bot"
    git config pull.rebase false
    echo "✅ Git configured"
else
    echo "⚠️  Git repository not found in $PROJECT_DIR"
    echo "Clone manually: git clone https://github.com/tubagus1108/website-pramuka.git $PROJECT_DIR"
fi
echo ""

echo "[12/15] Creating database..."
DB_NAME="pramuka_db"
DB_USER="pramuka_user"
DB_PASS=$(openssl rand -base64 16)

mysql -e "CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -e "CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASS';"
mysql -e "GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';"
mysql -e "FLUSH PRIVILEGES;"

echo "✅ Database created"
echo "   Database: $DB_NAME"
echo "   User: $DB_USER"
echo "   Password: $DB_PASS"
echo "   ⚠️  SAVE THIS PASSWORD!"
echo ""

echo "[13/15] Setting up Laravel..."
if [ -f "$PROJECT_DIR/artisan" ]; then
    cd "$PROJECT_DIR"
    
    # Create .env if not exists
    if [ ! -f ".env" ]; then
        cp .env.example .env
        sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" .env
        sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USER/" .env
        sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASS/" .env
        php artisan key:generate
    fi
    
    # Install dependencies
    composer install --optimize-autoloader --no-dev --no-interaction
    npm install --production
    npm run build
    
    # Run migrations
    php artisan migrate --force
    
    # Optimize
    php artisan optimize
    
    # Fix permissions
    chown -R www-data:www-data .
    chmod -R 775 storage bootstrap/cache
    
    echo "✅ Laravel setup complete"
else
    echo "⚠️  Laravel not found. Clone repository first!"
fi
echo ""

echo "[14/15] Setting up automatic updates (optional)..."
cat > /usr/local/bin/deploy-website << 'DEPLOYEOF'
#!/bin/bash
cd /var/www/website-pramuka
git pull origin main
composer install --optimize-autoloader --no-dev --no-interaction
npm install --production
npm run build
php artisan migrate --force
php artisan optimize:clear
php artisan optimize
chown -R www-data:www-data .
chmod -R 775 storage bootstrap/cache
systemctl reload nginx
systemctl restart php8.2-fpm
DEPLOYEOF

chmod +x /usr/local/bin/deploy-website
echo "✅ Deploy script created: /usr/local/bin/deploy-website"
echo ""

echo "[15/15] Setting up SSL with Let's Encrypt (recommended)..."
read -p "Setup SSL now? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    apt install -y certbot python3-certbot-nginx
    certbot --nginx -d $DOMAIN -d www.$DOMAIN --non-interactive --agree-tos --email admin@$DOMAIN
    echo "✅ SSL configured"
else
    echo "⚠️  SSL skipped. Run later: sudo certbot --nginx -d $DOMAIN"
fi
echo ""

echo "===================================="
echo "🎉 Server setup complete!"
echo "===================================="
echo ""
echo "📋 Next steps:"
echo "1. If repository not cloned:"
echo "   git clone https://github.com/tubagus1108/website-pramuka.git $PROJECT_DIR"
echo ""
echo "2. Edit .env file:"
echo "   nano $PROJECT_DIR/.env"
echo ""
echo "3. Run Laravel setup:"
echo "   cd $PROJECT_DIR"
echo "   composer install"
echo "   php artisan key:generate"
echo "   php artisan migrate --seed"
echo ""
echo "4. Deploy updates:"
echo "   /usr/local/bin/deploy-website"
echo ""
echo "5. Test website:"
echo "   https://$DOMAIN"
echo ""
echo "📊 Database Credentials:"
echo "   Database: $DB_NAME"
echo "   User: $DB_USER"
echo "   Password: $DB_PASS"
echo ""
echo "✅ All services running:"
echo "   - PHP 8.2-FPM: $(systemctl is-active php8.2-fpm)"
echo "   - Nginx: $(systemctl is-active nginx)"
echo "   - MySQL: $(systemctl is-active mysql)"
echo ""
