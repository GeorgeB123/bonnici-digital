# Deployment Setup Guide

## Required Environment Variables

### DevPanel Environment Variables

These must be configured in the DevPanel dashboard for each environment:

1. **GITHUB_TOKEN** (optional, for downloading artifacts)
   - Description: GitHub Personal Access Token for downloading build artifacts
   - Scope: `repo` (read access to private repositories)
   - Setup: GitHub Settings → Developer Settings → Personal Access Tokens → Generate new token
   - Value: `ghp_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx`
   - Note: Only needed if you want to download artifacts from GitHub Actions

### GitHub Repository Secrets

These are already configured in your repository:

1. **DP_USERNAME**
   - Description: DevPanel username
   - Status: ✅ Already configured

2. **DP_ACCESS_TOKEN**
   - Description: DevPanel API access token
   - Status: ✅ Already configured

## DevPanel Configuration

### Script Path Configuration

The deployment script must be accessible at:
```
/home/devpanel/applications/bonnici-digital/public_html/scripts/devpanel-deploy.sh
```

This is configured in `.devpanel/config.yml` and will be automatically available after deployment.

### Webhook Configuration

DevPanel webhook is triggered by GitHub Actions after successful builds:

- **URL**: `https://console.devpanel.com/webhooks/applications/69883ed8b6432f91abfabe43/git`
- **Method**: PUT
- **Payload**:
  ```json
  {
    "username": "DP_USERNAME",
    "token": "DP_ACCESS_TOKEN",
    "branch": "develop|staging|main",
    "sha": "abc1234",
    "artifact_url": "https://github.com/..."
  }
  ```

## Branch to Environment Mapping

| Branch | Environment | Auto-Deploy | Composer Mode |
|--------|-------------|-------------|---------------|
| develop | Dev | ✅ Yes | With dev dependencies |
| staging | Staging | ✅ Yes | Production only |
| main | Production | ✅ Yes | Production only |

## First Time Setup

### 1. Push Code to Repository

```bash
git push origin main
```

### 2. Verify GitHub Actions

1. Go to: https://github.com/YOUR_REPO/actions
2. Check that the workflow runs successfully
3. Verify artifact is created

### 3. Configure DevPanel (Optional)

If you want to use GitHub artifact downloads:

1. Create GitHub Personal Access Token
2. Add to DevPanel environment variables as `GITHUB_TOKEN`

### 4. Test Deployment

Push a commit to `develop` branch:

```bash
git checkout -b develop
git push origin develop
```

Monitor:
- GitHub Actions: Workflow should complete
- DevPanel logs: Check `/tmp/deployment-develop-*.log`

## Troubleshooting

### Deployment Fails

Check the deployment log on DevPanel server:
```bash
ls -lt /tmp/deployment-*.log | head -1
tail -f /tmp/deployment-develop-TIMESTAMP.log
```

### Drush Deploy Fails

1. SSH into DevPanel server
2. Navigate to webroot
3. Run manually: `vendor/bin/drush deploy -y -v`
4. Check output for specific errors

### Rollback

If deployment fails and you need to rollback:

1. Use DevPanel's backup restoration
2. Or redeploy previous commit:
   ```bash
   git revert HEAD
   git push origin BRANCH
   ```

## Deployment Logs

Logs are stored on the server at:
```
/tmp/deployment-{branch}-{timestamp}.log
```

Each deployment creates a new log file with timestamp.

## Post-Deployment Verification

After successful deployment, verify:

1. **Site is accessible**: Visit the site URL
2. **Drush status**: `vendor/bin/drush status`
3. **Configuration**: `vendor/bin/drush config:status`
4. **Deployment version**: `cat .deployed-version`

## Monitoring

Consider setting up monitoring for:
- Failed deployments (check exit codes in DevPanel logs)
- Site uptime after deployment
- Error logs after deployment

## Security Notes

- Never commit `.env` files
- Keep GitHub tokens secure
- Use separate DevPanel accounts for each environment
- Rotate tokens regularly
- Audit deployment logs for sensitive data
