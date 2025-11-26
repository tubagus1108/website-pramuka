# 🚀 CI/CD Deployment Guide

## ✅ What's Included

3 GitHub Actions workflows telah dibuat:

1. **deploy.yml** - Auto-deploy to Production
2. **deploy-dev.yml** - Auto-deploy to Development  
3. **optimize-images.yml** - Manual image optimization

---

## 📋 Setup Steps (REQUIRED!)

### Step 1: Add Secrets to GitHub

1. Buka repository: https://github.com/tubagus1108/website-pramuka
2. Click **Settings** tab
3. Sidebar → **Secrets and variables** → **Actions**
4. Click **New repository secret**

Add these 3 secrets:

| Secret Name | Value | Example |
|------------|-------|---------|
| `SERVER_HOST` | IP atau domain server | `203.0.113.10` atau `server.domain.com` |
| `SERVER_USER` | SSH username | `root` atau `ubuntu` |
| `SERVER_PASSWORD` | SSH password | `YourPassword123!` |

### Step 2: Configure Server Sudoers

SSH ke server dan jalankan:

```bash
# Edit sudoers
sudo visudo

# Add line ini (ganti 'root' dengan username Anda):
root ALL=(ALL) NOPASSWD: /bin/chown, /bin/chmod, /usr/bin/systemctl

# Save: Ctrl+X, Y, Enter
```

**Why?** Supaya GitHub Actions bisa run sudo commands tanpa password.

### Step 3: Test SSH Connection

Pastikan server bisa diakses via SSH:

```bash
# From your local machine
ssh root@your-server-ip

# Should login successfully without errors
```

---

## 🎯 How It Works

### Auto-Deploy to Development (dev branch)

```bash
# Di local machine
git add .
git commit -m "feat: new feature"
git push origin dev
```

**What happens:**
1. ✅ GitHub detects push to `dev` branch
2. ✅ Workflow `deploy-dev.yml` auto-triggers
3. ✅ SSH to server
4. ✅ Git pull latest code
5. ✅ Composer install
6. ✅ NPM install & build (with PurgeCSS!)
7. ✅ Laravel optimize
8. ✅ Generate sitemap
9. ✅ Fix permissions
10. ✅ Reload Nginx
11. ✅ Done! (~2 minutes)

### Auto-Deploy to Production (main branch)

```bash
# Merge dev to main
git checkout main
git merge dev
git push origin main
```

**What happens:**
- Same as dev deployment
- Uses production dependencies (no dev packages)

### Manual Image Optimization

1. Go to **Actions** tab on GitHub
2. Select **Optimize Images (Manual)**
3. Click **Run workflow**
4. Select branch
5. Click **Run workflow** button
6. Wait ~1-2 minutes
7. Images optimized!

---

## 📊 Monitoring Deployments

### View Deployment Status

1. Go to repository: https://github.com/tubagus1108/website-pramuka
2. Click **Actions** tab
3. See all deployments:
   - ✅ Green checkmark = Success
   - ❌ Red X = Failed
   - 🟡 Yellow dot = In progress

### View Deployment Logs

1. Click on any workflow run
2. Click **Deploy to Server** (or **Deploy to Dev Server**)
3. Expand steps to see detailed logs
4. See exactly what happened during deployment

---

## 🔄 Deployment Flow

```
Local Changes
    ↓
git push origin dev
    ↓
GitHub Actions Triggered
    ↓
SSH to Server
    ↓
Pull Latest Code
    ↓
Install Dependencies
    ↓
Build Assets (PurgeCSS, minify)
    ↓
Optimize Laravel (cache routes, config, views)
    ↓
Generate Sitemap
    ↓
Fix Permissions
    ↓
Reload Nginx
    ↓
✅ LIVE!
```

**Total Time:** 1-3 minutes per deployment

---

## 🎯 Benefits

### Before CI/CD:
- ❌ Manual SSH to server
- ❌ Manual git pull
- ❌ Manual npm run build
- ❌ Manual cache clear
- ❌ Manual nginx reload
- ❌ Takes 5-10 minutes
- ❌ Easy to forget steps
- ❌ Human errors

### After CI/CD:
- ✅ Just `git push`
- ✅ Everything automated
- ✅ Takes 1-3 minutes
- ✅ Consistent every time
- ✅ No forgotten steps
- ✅ Logged & traceable
- ✅ Can rollback easily

---

## 🐛 Troubleshooting

### Issue: "Permission denied"

**Cause:** Wrong credentials

**Fix:**
1. Check secrets in GitHub Settings → Secrets
2. Verify username/password are correct
3. Test SSH manually: `ssh user@host`

### Issue: "sudo: no tty present"

**Cause:** Sudoers not configured

**Fix:**
```bash
sudo visudo
# Add: root ALL=(ALL) NOPASSWD: /bin/chown, /bin/chmod, /usr/bin/systemctl
```

### Issue: "npm: command not found"

**Cause:** Node.js not installed on server

**Fix:**
```bash
# On server
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt-get install -y nodejs
```

### Issue: "composer: command not found"

**Cause:** Composer not installed on server

**Fix:**
```bash
# On server
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
php -r "unlink('composer-setup.php');"
```

### Issue: Deployment succeeded but changes not visible

**Cause:** Browser cache or CDN cache

**Fix:**
1. Hard refresh: Ctrl+Shift+R
2. Clear browser cache
3. If using Cloudflare: Purge cache
4. Wait 2 minutes (Nginx cache)

---

## 🔐 Security Best Practices

### 1. Use SSH Keys Instead of Password

More secure than password! See `.github/SETUP_SECRETS.md` for instructions.

### 2. Create Dedicated Deploy User

Instead of using `root`:

```bash
# On server
sudo adduser deploy
sudo usermod -aG www-data deploy
sudo usermod -aG sudo deploy

# Configure sudoers for deploy user
sudo visudo
# Add: deploy ALL=(ALL) NOPASSWD: /bin/chown, /bin/chmod, /usr/bin/systemctl
```

Then use `deploy` as `SERVER_USER`.

### 3. Limit SSH Access

Edit `/etc/ssh/sshd_config`:
```bash
PermitRootLogin no
PasswordAuthentication no  # After setting up SSH keys
PubkeyAuthentication yes
```

---

## 📈 Next Steps

1. ✅ **Add secrets** to GitHub (REQUIRED!)
2. ✅ **Configure sudoers** on server (REQUIRED!)
3. ✅ **Test deployment** - push to dev branch
4. ✅ **Monitor** in Actions tab
5. ✅ **Verify** website updated
6. 🎉 **Enjoy** automated deployments!

---

## 📞 Quick Reference

**Repository:** https://github.com/tubagus1108/website-pramuka

**Workflows Location:** `.github/workflows/`

**Secrets Location:** Settings → Secrets and variables → Actions

**View Deployments:** Actions tab

**Manual Trigger:** Actions → Select workflow → Run workflow

**Deployment Time:** 1-3 minutes

**Frequency:** Every push to main/dev

---

**Status:** ✅ CI/CD Ready to Use (after adding secrets!)
