# Deployment Rollback Procedures

## When to Rollback

Rollback when:
- Site is inaccessible after deployment
- Critical functionality is broken
- Data integrity issues detected
- Config import failed and site is unstable

## Automatic Rollback

The deployment script automatically rolls back when:
- `drush deploy` fails
- Smoke tests fail (staging/production)
- Any critical step exits with error

## Manual Rollback Methods

### Method 1: DevPanel Database Restoration (Recommended)

Use this when database changes caused issues:

1. **Access DevPanel Dashboard**
   - Navigate to your application
   - Go to "Backups" section

2. **Select Backup**
   - Find the backup taken before failed deployment
   - Backups are automatic before each deployment

3. **Restore Database**
   - Click "Restore" on the backup
   - Confirm restoration
   - Wait for completion

4. **Revert Code (if needed)**
   ```bash
   cd /home/devpanel/applications/bonnici-digital/public_html
   git reset --hard PREVIOUS_COMMIT_SHA
   composer install --no-dev
   drush cr
   ```

### Method 2: Redeploy Previous Version

Use this for a clean redeployment:

1. **Find Last Good Commit**
   ```bash
   git log --oneline -10
   ```

2. **Revert Locally**
   ```bash
   git revert HEAD
   # Or for multiple commits:
   git revert HEAD~3..HEAD
   ```

3. **Push to Trigger Redeployment**
   ```bash
   git push origin BRANCH
   ```

4. **Monitor Deployment**
   - Check GitHub Actions
   - Monitor DevPanel logs

### Method 3: Fast Rollback (Emergency)

Use this for immediate rollback without full redeployment:

1. **SSH to Server**
   ```bash
   ssh devpanel@your-server.com
   ```

2. **Navigate to Webroot**
   ```bash
   cd /home/devpanel/applications/bonnici-digital/public_html
   ```

3. **Check Deployed Version**
   ```bash
   cat .deployed-version
   ```

4. **Git Reset to Previous**
   ```bash
   # Find previous commit
   git log --oneline -5

   # Reset to previous commit
   git reset --hard PREVIOUS_SHA
   ```

5. **Restore Dependencies**
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

6. **Restore Database from Backup**
   - Use DevPanel dashboard (Method 1)
   - Or use database backup files if available

7. **Clear Caches**
   ```bash
   vendor/bin/drush cr
   ```

8. **Verify Site**
   ```bash
   vendor/bin/drush status
   curl -I http://localhost/
   ```

## Post-Rollback Steps

1. **Verify Site Functionality**
   - Check critical pages
   - Test user workflows
   - Review error logs

2. **Document the Issue**
   - What went wrong?
   - What caused the rollback?
   - How to prevent in future?

3. **Fix the Issue**
   - Create hotfix branch if needed
   - Test thoroughly
   - Deploy fix carefully

4. **Update Team**
   - Notify team of rollback
   - Share incident details
   - Update deployment procedures if needed

## Rollback Checklist

- [ ] Identify the issue clearly
- [ ] Choose appropriate rollback method
- [ ] Take note of current state (for debugging)
- [ ] Execute rollback procedure
- [ ] Verify database is restored
- [ ] Verify code is reverted
- [ ] Clear all caches
- [ ] Test site functionality
- [ ] Check error logs
- [ ] Document incident
- [ ] Plan fix deployment

## Prevention Strategies

To minimize need for rollbacks:

1. **Always test on Dev first**
   - Never push directly to main
   - Test on develop branch

2. **Use Staging for validation**
   - Deploy to staging before production
   - Run full QA on staging

3. **Monitor deployments**
   - Watch deployment logs
   - Check site immediately after deployment

4. **Maintain good backups**
   - Verify backups are running
   - Test restoration periodically

5. **Use feature flags**
   - For risky features
   - Allows disabling without rollback

## Emergency Contacts

- **DevPanel Support**: support@devpanel.com
- **On-call Developer**: [Add contact]
- **Project Manager**: [Add contact]

## Related Documentation

- [Deployment Setup Guide](deployment-setup.md)
- [CI/CD Pipeline Design](plans/2026-02-27-drupal-cicd-design.md)
