# 🔧 Fix: GitHub Account Locked - Billing Issue

## ❌ Error Message

```
The job was not started because your account is locked due to a billing issue.
```

## 🎯 Root Cause

GitHub Actions requires billing setup, even for free tier usage. Your account needs a payment method configured.

---

## ✅ SOLUTION 1: Setup GitHub Billing (EASIEST)

### Step 1: Add Payment Method

1. **Go to Billing Settings:**
   - Direct link: https://github.com/settings/billing
   - Or: Profile (top-right) → Settings → Billing and plans

2. **Add Payment Method:**
   - Click "Add a payment method"
   - Enter credit/debit card details
   - Click "Save"

### Step 2: Set Spending Limit (Stay Free!)

1. **Go to Spending Limit:**
   - https://github.com/settings/billing/spending_limit
   
2. **Set Limit to $0:**
   - This ensures you **NEVER get charged**
   - You'll get 2000 minutes/month FREE
   - After limit, actions just stop (no charges)

3. **Or Set Custom Limit:**
   - If you want more than 2000 min/month
   - Set limit: $5, $10, etc.

### Step 3: Verify Account Unlocked

1. **Go to Actions:**
   - https://github.com/tubagus1108/website-pramuka/actions

2. **Run Workflow:**
   - Click "Deploy to Development"
   - Click "Run workflow"
   - Select branch: `dev`
   - Click "Run workflow" button

3. **Should Work Now!** ✅

---

## ✅ SOLUTION 2: Self-Hosted Runner (100% FREE Forever!)

**Benefits:**
- ✅ No billing required
- ✅ Unlimited minutes
- ✅ Faster (runs on your server)
- ✅ Direct access to files
- ✅ No SSH needed in workflow

**Drawback:**
- Needs setup on your server
- Server must stay online

### Step 1: Add Self-Hosted Runner

1. **Go to Repository Settings:**
   - https://github.com/tubagus1108/website-pramuka/settings/actions/runners/new

2. **Select Operating System:**
   - Linux
   - x64 architecture

3. **GitHub will show commands** - Copy them!

### Step 2: Install Runner on Server

```bash
# SSH to your server
ssh root@your-server-ip

# Create runner directory
mkdir -p ~/actions-runner && cd ~/actions-runner

# Download runner (GitHub will show latest version)
curl -o actions-runner-linux-x64-2.311.0.tar.gz -L https://github.com/actions/runner/releases/download/v2.311.0/actions-runner-linux-x64-2.311.0.tar.gz

# Extract
tar xzf ./actions-runner-linux-x64-2.311.0.tar.gz

# Configure (use token from GitHub settings page)
./config.sh --url https://github.com/tubagus1108/website-pramuka --token YOUR_RUNNER_TOKEN

# When prompted:
# - Enter name: website-pramuka-runner
# - Work folder: _work (default)
# - Labels: self-hosted,Linux,X64 (default)

# Install as service (auto-start on reboot)
sudo ./svc.sh install

# Start service
sudo ./svc.sh start

# Check status
sudo ./svc.sh status
# Should see: Active (running)
```

### Step 3: Verify Runner Active

1. **Go to Runners Page:**
   - https://github.com/tubagus1108/website-pramuka/settings/actions/runners

2. **Should See:**
   - ✅ Green dot "Idle"
   - Runner name: website-pramuka-runner

### Step 4: Set Runner Type Variable (Optional)

To use self-hosted runner by default:

1. **Go to Variables:**
   - https://github.com/tubagus1108/website-pramuka/settings/variables/actions

2. **Add Variable:**
   - Name: `RUNNER_TYPE`
   - Value: `self-hosted`
   - Click "Add variable"

**Result:**
- Workflows will use self-hosted runner automatically
- If not set, will use `ubuntu-latest` (requires billing)

### Step 5: Test Deployment

1. **Push code or trigger manually:**
   ```bash
   git push origin dev
   ```

2. **Check Actions tab:**
   - Should use self-hosted runner
   - No billing required!

---

## 📊 Comparison

| Feature | GitHub-Hosted | Self-Hosted |
|---------|---------------|-------------|
| **Cost** | Free tier: 2000 min/month | Unlimited FREE |
| **Billing Required** | ✅ Yes (even for free) | ❌ No |
| **Setup** | Easy (just add card) | Moderate (install runner) |
| **Speed** | Good | Faster (local) |
| **Maintenance** | None | Keep runner updated |
| **Security** | High (isolated) | Your responsibility |
| **Best For** | Simple projects | Production servers |

---

## 🎯 Recommended Approach

### For Personal/Learning Projects:
**✅ Use Solution 1 (GitHub Billing)**
- Add payment method
- Set spending limit $0
- Easy, no maintenance

### For Production Servers:
**✅ Use Solution 2 (Self-Hosted)**
- 100% free
- Faster deployments
- Direct server access

### For Organizations/Teams:
**✅ Use GitHub-Hosted with Paid Plan**
- More minutes included
- Better isolation
- Professional support

---

## 🔍 Verify Which Runner is Used

After workflow runs, check logs:

**GitHub-Hosted:**
```
Runner name: 'GitHub Actions 2'
Runner group name: 'GitHub Actions'
Machine name: 'fv-az123-456'
```

**Self-Hosted:**
```
Runner name: 'website-pramuka-runner'
Runner group name: 'Default'
Machine name: 'your-server-hostname'
```

---

## 🐛 Troubleshooting

### Error: "No runner found"

**Cause:** Self-hosted runner not running

**Solution:**
```bash
# SSH to server
ssh root@your-server-ip
cd ~/actions-runner

# Check status
sudo ./svc.sh status

# If stopped, start:
sudo ./svc.sh start

# Check logs
cat _diag/*.log
```

### Error: Runner offline

**Cause:** Server shut down or runner crashed

**Solution:**
```bash
# Restart runner service
sudo ./svc.sh stop
sudo ./svc.sh start

# Or reinstall service
sudo ./svc.sh uninstall
sudo ./svc.sh install
sudo ./svc.sh start
```

### Workflow still uses GitHub-hosted

**Cause:** RUNNER_TYPE variable not set

**Solution:**
1. Go to: https://github.com/tubagus1108/website-pramuka/settings/variables/actions
2. Add variable: `RUNNER_TYPE` = `self-hosted`
3. Re-run workflow

---

## 📈 Free Tier Limits (GitHub-Hosted)

### Free for Public Repos:
- ✅ Unlimited minutes
- ✅ No billing required for public repos!

### Free for Private Repos:
- 2000 minutes/month
- Billing required (can set $0 limit)
- After limit: actions stop

**Check your usage:**
- https://github.com/settings/billing

---

## ✅ Current Workflow Status

**Updated:** Workflows now support both runners!

**Code added:**
```yaml
runs-on: ${{ vars.RUNNER_TYPE || 'ubuntu-latest' }}
```

**Behavior:**
- If `RUNNER_TYPE` variable exists → use it (e.g., `self-hosted`)
- If not → use `ubuntu-latest` (requires billing)

**Latest Commit:** `61c7627` - "feat: add support for self-hosted runners"

---

## 🚀 Quick Start (Choose One)

### Option A: Setup Billing (5 minutes)
```
1. Add card: https://github.com/settings/billing
2. Set $0 limit: https://github.com/settings/billing/spending_limit
3. Run workflow: https://github.com/tubagus1108/website-pramuka/actions
✅ Done!
```

### Option B: Self-Hosted (15 minutes)
```
1. SSH to server
2. Run install commands (from GitHub runners page)
3. Set RUNNER_TYPE variable to 'self-hosted'
4. Run workflow
✅ Done!
```

---

**Recommendation:** Start with **Option A (Billing)** - quickest solution. Switch to **Option B (Self-Hosted)** later if needed.

**Status:** ✅ Workflows updated to support both options
**Next Action:** Choose solution and setup!
