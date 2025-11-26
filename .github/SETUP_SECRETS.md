# 🔐 GitHub Actions Secrets Setup

## Required Secrets

Untuk CI/CD berfungsi, Anda perlu menambahkan 3 secrets di GitHub repository:

### 1. Navigate to Repository Settings

1. Buka repository: `https://github.com/tubagus1108/website-pramuka`
2. Click **Settings** (tab di atas)
3. Sidebar kiri → **Secrets and variables** → **Actions**
4. Click **New repository secret**

### 2. Add Required Secrets

#### Secret 1: SERVER_HOST
```
Name: SERVER_HOST
Value: your-server-ip-or-domain
```
**Example:**
- `203.0.113.10` (IP address)
- `server.pramuka-uin.ac.id` (domain)

---

#### Secret 2: SERVER_USER
```
Name: SERVER_USER
Value: root
```
**Example:**
- `root` (if using root access)
- `ubuntu` (if using ubuntu user)
- `deploy` (if using custom deploy user)

---

#### Secret 3: SERVER_PASSWORD
```
Name: SERVER_PASSWORD
Value: your-ssh-password
```
**Example:**
- `YourStrongPassword123!`

**⚠️ Security Note:**
- Password akan di-encrypt oleh GitHub
- Tidak akan terlihat di logs
- Hanya bisa digunakan dalam workflows

---

## 🔑 Alternative: SSH Key (More Secure!)

Jika ingin lebih secure, gunakan SSH key instead of password:

### Setup SSH Key Authentication

#### On Your Local Machine:
```bash
# Generate SSH key pair
ssh-keygen -t ed25519 -C "github-actions-deploy"
# Save to: ~/.ssh/github_actions_deploy
# No passphrase (tekan Enter 2x)

# Copy private key content
cat ~/.ssh/github_actions_deploy
# Copy ALL content (including -----BEGIN ... -----END)
```

#### On Your Server:
```bash
# SSH to server
ssh root@your-server-ip

# Add public key to authorized_keys
cat >> ~/.ssh/authorized_keys << 'EOF'
[paste public key content dari github_actions_deploy.pub]
EOF

# Fix permissions
chmod 600 ~/.ssh/authorized_keys
chmod 700 ~/.ssh
```

#### In GitHub Secrets:
Add new secret:
```
Name: SERVER_SSH_KEY
Value: [paste private key content dari github_actions_deploy]
```

#### Update Workflow (deploy.yml):
Change from:
```yaml
with:
  host: ${{ secrets.SERVER_HOST }}
  username: ${{ secrets.SERVER_USER }}
  password: ${{ secrets.SERVER_PASSWORD }}
```

To:
```yaml
with:
  host: ${{ secrets.SERVER_HOST }}
  username: ${{ secrets.SERVER_USER }}
  key: ${{ secrets.SERVER_SSH_KEY }}
```

---

## 📋 Verification Checklist

After adding secrets, verify:

- [ ] `SERVER_HOST` added
- [ ] `SERVER_USER` added
- [ ] `SERVER_PASSWORD` or `SERVER_SSH_KEY` added
- [ ] Secrets visible in Settings → Secrets and variables → Actions
- [ ] Test connection: SSH to server manually with same credentials

---

## 🚀 Testing CI/CD

### Manual Test:
1. Go to **Actions** tab
2. Select **Deploy to Development** (or Production)
3. Click **Run workflow**
4. Select branch: `dev` (or `main`)
5. Click **Run workflow** button
6. Watch the deployment logs

### Automatic Test:
1. Make a small change to code
2. Commit and push to `dev` branch:
   ```bash
   git add .
   git commit -m "test: trigger CI/CD"
   git push origin dev
   ```
3. GitHub Actions will auto-trigger
4. Check **Actions** tab for deployment status

---

## 🐛 Troubleshooting

### Error: "Permission denied (publickey,password)"
**Solution:**
- Check `SERVER_USER` is correct
- Check `SERVER_PASSWORD` is correct
- Verify SSH access manually: `ssh user@host`

### Error: "sudo: no tty present and no askpass program specified"
**Solution:**
Add to server's sudoers file:
```bash
# On server
sudo visudo

# Add line (replace 'root' with your user):
root ALL=(ALL) NOPASSWD: /bin/chown, /bin/chmod, /usr/bin/systemctl
```

### Error: "git pull failed"
**Solution:**
On server, ensure git config is set:
```bash
cd /var/www/website-pramuka
git config pull.rebase false
git config user.email "deploy@example.com"
git config user.name "Deploy Bot"
```

### Error: "npm: command not found"
**Solution:**
Install Node.js on server:
```bash
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt-get install -y nodejs
```

---

## 📊 Current Workflows

### 1. Deploy to Production (deploy.yml)
- **Trigger:** Push to `main` or `master` branch
- **Manual:** Yes (workflow_dispatch)
- **Actions:**
  - Pull code
  - Install dependencies
  - Build assets
  - Optimize Laravel
  - Generate sitemap
  - Reload Nginx

### 2. Deploy to Development (deploy-dev.yml)
- **Trigger:** Push to `dev` or `develop` branch
- **Manual:** Yes (workflow_dispatch)
- **Actions:** Same as production + dev dependencies

### 3. Optimize Images (optimize-images.yml)
- **Trigger:** Manual only
- **Actions:** Run `php artisan images:optimize`

---

## ✅ Ready to Use!

After setting up secrets, CI/CD will:
- ✅ Auto-deploy on every push to main/dev
- ✅ Run all optimization steps
- ✅ Show deployment logs in Actions tab
- ✅ Notify on success/failure
- ✅ Support manual triggers

**Time to first deploy:** ~2-3 minutes
**Subsequent deploys:** ~1-2 minutes
