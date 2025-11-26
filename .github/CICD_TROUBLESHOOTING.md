# 🔧 CI/CD Troubleshooting Guide

## ❌ Common Errors & Solutions

### Error 1: "Error: Process completed with exit code 1"

**Screenshot:** All workflows red ❌ in Actions tab

**Possible Causes:**

#### 1.1 Secrets Not Configured

**Symptoms:**
- Workflow fails immediately
- Error message: "Permission denied" or "Host key verification failed"

**Solution:**
```
1. Go to: https://github.com/tubagus1108/website-pramuka/settings/secrets/actions
2. Click "New repository secret"
3. Add these secrets:
   - SERVER_HOST (e.g., 203.0.113.10)
   - SERVER_USER (e.g., root)
   - SERVER_PASSWORD (your SSH password)
```

**Verify Secrets:**
- Go to Settings → Secrets and variables → Actions
- Should see 3 secrets listed (values hidden)

---

#### 1.2 Wrong Server Path

**Symptoms:**
- Error: "cd: /var/www/website-pramuka: No such file or directory"

**Solution:**

**Option A: Create directory on server**
```bash
# SSH to server
ssh root@your-server-ip

# Create directory
sudo mkdir -p /var/www/website-pramuka
cd /var/www

# Clone repository
sudo git clone https://github.com/tubagus1108/website-pramuka.git
cd website-pramuka

# Setup Laravel
cp .env.example .env
composer install
php artisan key:generate
```

**Option B: Use different path**

If your project is in different location (e.g., `/home/deploy/website-pramuka`):

1. Edit workflow files (`.github/workflows/deploy-dev.yml` and `deploy.yml`)
2. Change line:
   ```yaml
   PROJECT_DIR="${PROJECT_DIR:-/var/www/website-pramuka}"
   ```
   To:
   ```yaml
   PROJECT_DIR="${PROJECT_DIR:-/home/deploy/website-pramuka}"
   ```

---

#### 1.3 Git Not Configured

**Symptoms:**
- Error: "Please tell me who you are" or "fatal: unable to auto-detect email address"

**Solution:**
```bash
# SSH to server
ssh root@your-server-ip
cd /var/www/website-pramuka

# Configure git
git config user.email "deploy@example.com"
git config user.name "Deploy Bot"
git config pull.rebase false
```

---

#### 1.4 Composer Not Installed

**Symptoms:**
- Error: "composer: command not found"
- Warning: "⚠️ Composer not found, skipping..."

**Solution:**
```bash
# SSH to server
ssh root@your-server-ip

# Install Composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
php -r "unlink('composer-setup.php');"

# Verify
composer --version
```

---

#### 1.5 NPM/Node.js Not Installed

**Symptoms:**
- Error: "npm: command not found"
- Warning: "⚠️ NPM not found, skipping build..."

**Solution:**
```bash
# SSH to server
ssh root@your-server-ip

# Install Node.js 20 (LTS)
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt-get install -y nodejs

# Verify
node --version
npm --version
```

---

#### 1.6 Sudo Permission Issues

**Symptoms:**
- Error: "sudo: no tty present and no askpass program specified"
- Error: "sudo: a password is required"

**Solution:**

**Configure sudoers (RECOMMENDED):**
```bash
# SSH to server
ssh root@your-server-ip

# Edit sudoers
sudo visudo

# Add line (replace 'root' with your username):
root ALL=(ALL) NOPASSWD: /bin/chown, /bin/chmod, /usr/bin/systemctl, /usr/sbin/service

# Save: Ctrl+X, Y, Enter
```

**Alternative: Use user with permissions:**
If you can't configure sudo, the workflow now has fallback logic that will skip sudo commands gracefully.

---

### Error 2: "Host key verification failed"

**Symptoms:**
- First deployment fails
- Error: "The authenticity of host 'x.x.x.x' can't be established"

**Solution:**

**Option A: Accept host key manually (ONE TIME)**
```bash
# From your local machine
ssh root@your-server-ip
# Type "yes" when asked
# Exit
```

**Option B: Use SSH key instead of password**

See `.github/SETUP_SECRETS.md` for SSH key setup instructions.

---

### Error 3: Workflow succeeds but website not updated

**Symptoms:**
- ✅ Green checkmark in Actions
- But changes not visible on website

**Possible Causes:**

#### 3.1 Browser Cache

**Solution:**
```
Hard refresh: Ctrl + Shift + R (Windows/Linux)
Or: Cmd + Shift + R (Mac)
```

#### 3.2 Nginx Cache

**Solution:**
```bash
# SSH to server
ssh root@your-server-ip

# Clear Nginx cache (if configured)
sudo rm -rf /var/cache/nginx/*
sudo systemctl reload nginx
```

#### 3.3 CDN Cache (Cloudflare, etc.)

**Solution:**
- Go to Cloudflare dashboard
- Caching → Purge Everything
- Wait 30 seconds

#### 3.4 Laravel Cache

**Solution:**
```bash
# SSH to server
ssh root@your-server-ip
cd /var/www/website-pramuka

# Clear all caches
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 📊 Debugging Workflow Runs

### View Detailed Logs:

1. Go to: https://github.com/tubagus1108/website-pramuka/actions
2. Click on failed workflow run
3. Click "Deploy to Dev Server" (or "Deploy to Server")
4. Expand each step to see output
5. Look for red ❌ icons

### Common Log Messages:

**❌ Fatal Errors (Stop deployment):**
- `❌ Project directory not found!`
- `❌ Git pull failed!`
- `❌ Composer install failed!`
- `❌ NPM install failed!`
- `❌ NPM build failed!`

**⚠️ Warnings (Continue deployment):**
- `⚠️ Git fetch failed, continuing...`
- `⚠️ Composer not found, skipping...`
- `⚠️ NPM not found, skipping build...`
- `⚠️ Cache clear failed, continuing...`
- `⚠️ Permission change failed`
- `⚠️ Nginx reload failed (needs manual reload)`

---

## 🔍 Pre-Deployment Checklist

Before running workflow, ensure:

- [ ] **Secrets configured** in GitHub (SERVER_HOST, SERVER_USER, SERVER_PASSWORD)
- [ ] **Server accessible** via SSH: `ssh user@host`
- [ ] **Project directory exists** on server: `/var/www/website-pramuka`
- [ ] **Git configured** on server (user.email, user.name)
- [ ] **Composer installed** on server
- [ ] **Node.js/NPM installed** on server (v18+)
- [ ] **Sudoers configured** (if using sudo)
- [ ] **.env file exists** on server with correct values
- [ ] **Database accessible** from server

---

## 🧪 Test Deployment Manually

Before using CI/CD, test manually:

```bash
# SSH to server
ssh root@your-server-ip

# Navigate
cd /var/www/website-pramuka

# Pull code
git pull origin dev

# Install dependencies
composer install --no-dev --no-interaction
npm install --production

# Build
npm run build

# Optimize
php artisan optimize:clear
php artisan optimize

# Check if site works
curl -I http://localhost
# Should see: HTTP/1.1 200 OK
```

If manual deployment works, CI/CD should work too!

---

## 🔐 Security Best Practices

### Use SSH Keys (Recommended)

Instead of password, use SSH key authentication:

1. **Generate key pair** (on your local machine):
   ```bash
   ssh-keygen -t ed25519 -C "github-actions"
   # Save to: ~/.ssh/github_actions
   ```

2. **Add public key to server:**
   ```bash
   ssh root@server-ip
   cat >> ~/.ssh/authorized_keys << 'EOF'
   [paste public key content]
   EOF
   chmod 600 ~/.ssh/authorized_keys
   ```

3. **Add private key to GitHub secrets:**
   - Name: `SERVER_SSH_KEY`
   - Value: [paste private key content]

4. **Update workflow:**
   Change from:
   ```yaml
   password: ${{ secrets.SERVER_PASSWORD }}
   ```
   To:
   ```yaml
   key: ${{ secrets.SERVER_SSH_KEY }}
   ```

### Create Dedicated Deploy User

Don't use root! Create deploy user:

```bash
# On server
sudo adduser deploy
sudo usermod -aG www-data deploy
echo "deploy ALL=(ALL) NOPASSWD: /bin/chown, /bin/chmod, /usr/bin/systemctl" | sudo tee /etc/sudoers.d/deploy

# Update GitHub secrets
SERVER_USER=deploy
```

---

## 📞 Quick Diagnostic Commands

```bash
# Check if server is reachable
ping your-server-ip

# Check SSH access
ssh root@your-server-ip "echo 'SSH OK'"

# Check project exists
ssh root@your-server-ip "ls -la /var/www/website-pramuka"

# Check PHP version
ssh root@your-server-ip "php -v"

# Check Composer
ssh root@your-server-ip "composer --version"

# Check Node/NPM
ssh root@your-server-ip "node -v && npm -v"

# Check Git config
ssh root@your-server-ip "cd /var/www/website-pramuka && git config --list"

# Check permissions
ssh root@your-server-ip "ls -la /var/www/website-pramuka/storage"

# Check Nginx status
ssh root@your-server-ip "sudo systemctl status nginx"
```

---

## ✅ Workflow Improvements Applied

### ✨ New Features (Latest Fix):

1. **Error Handling:** `set -e` stops on critical errors
2. **Conditional Checks:** Verify commands exist before using
3. **Graceful Fallbacks:** Continue if non-critical steps fail
4. **Sudo Detection:** Auto-detect sudo availability
5. **Better Logging:** Clear emoji indicators for each step
6. **Script Validation:** `script_stop: true` for better error reporting

### 🛡️ Safety Features:

- Won't fail if sudo not available
- Won't fail if nginx reload not possible
- Won't fail if optional optimizations fail
- Clear error messages for debugging
- Continues deployment even if warnings occur

---

## 📈 Expected Behavior

### ✅ Successful Deployment:

```
🔄 Starting DEV deployment...
📂 Project directory: /var/www/website-pramuka
📦 Pulling latest code from dev branch...
📚 Installing Composer dependencies...
📦 Installing NPM dependencies...
🔨 Building optimized assets...
🧹 Clearing caches...
⚡ Optimizing Laravel...
🗺️ Generating sitemap...
🔐 Fixing permissions...
🔄 Reloading Nginx...
✅ DEV deployment completed successfully!
```

### ⚠️ Deployment with Warnings (Still OK):

```
🔄 Starting DEV deployment...
📂 Project directory: /var/www/website-pramuka
📦 Pulling latest code from dev branch...
📚 Installing Composer dependencies...
📦 Installing NPM dependencies...
🔨 Building optimized assets...
🧹 Clearing caches...
⚡ Optimizing Laravel...
🗺️ Generating sitemap...
⚠️ Sitemap generation failed, continuing...
🔐 Fixing permissions...
⚠️ Permission change failed (no sudo)
🔄 Reloading Nginx...
⚠️ Nginx reload failed (needs manual reload)
✅ DEV deployment completed successfully!
```

Even with warnings, deployment is successful if core steps (git pull, install, build) succeed!

---

**Last Updated:** November 26, 2025
**Workflow Version:** 2.0 (with error handling improvements)
**Status:** ✅ Ready for deployment
