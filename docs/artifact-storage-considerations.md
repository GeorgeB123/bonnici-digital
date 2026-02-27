# Artifact Storage Considerations

This document outlines the considerations for using pre-built deployment artifacts vs. git pull deployments.

## Current Status

**Deployment Method:** Git Pull (simple, working)
**Decision:** Keep it simple for now, consider artifacts later when needed

## Artifact vs. Git Pull: Comparison

### With Artifacts (Pre-built Deployment Package)

**Pros:**
- **Faster deployments** - No `composer install` on production (saves 30-60 seconds)
- **Consistency** - Exact same built code across all environments
- **Optimized build** - Can strip tests, docs, `.git` folders (smaller, cleaner)
- **No composer on production** - Server doesn't need composer or build tools
- **Immutable deployments** - Same artifact = reproducible deploys
- **Better rollbacks** - Can redeploy exact previous artifact
- **Production-only dependencies** - `--no-dev` optimizations baked in

**Cons:**
- **Storage required** - Need S3/Spaces/similar (~100-300MB per artifact)
- **More complexity** - Upload, storage, download, cleanup pipeline
- **GitHub Actions artifacts are private** - Require API token to download (not a simple URL)
- **Upload/download time** - Network transfer adds 20-40 seconds
- **Retention costs** - Need to manage artifact cleanup
- **Build time** - CI needs to run full `composer install --no-dev`

### With Git Pull (Current Method)

**Pros:**
- **Simple** - Just `git pull` - no storage, no URLs, no downloads
- **Zero storage costs** - Git is already there
- **Less CI complexity** - No artifact creation/upload steps
- **Fast for small changes** - Git only transfers diffs
- **Works immediately** - No setup needed (already working)

**Cons:**
- **Composer runs on production** - Server does `composer install` (slower)
- **Server needs composer** - Production needs build tools
- **Non-deterministic** - Composer might resolve differently on production
- **Larger repository** - Includes dev files, tests, etc.
- **Git history on production** - `.git` folder exposed (security consideration)
- **Slower for large deploys** - Full `composer install` every time

## When to Switch to Artifacts

Consider switching when you experience:

1. **Slow deployments** - Composer taking 5+ minutes on production
2. **Reproducibility requirements** - Compliance/audit needs exact builds
3. **Security policy changes** - Production shouldn't have build tools
4. **Multiple environment deploys** - Deploying same build to dev/staging/prod
5. **Frequent rollbacks needed** - Artifacts make rollback instant

## Recommended Artifact Storage Platforms

### 1. DigitalOcean Spaces ⭐ (Recommended)

**Best for:** Current infrastructure (already on DigitalOcean)

**Pricing:**
- $5/month flat rate
- Includes 250GB storage + 1TB transfer
- Additional storage: $0.02/GB/month
- Additional transfer: $0.01/GB

**Features:**
- S3-compatible API (works with standard tools)
- Same datacenter as DevPanel = fast transfers
- CDN included
- Easy lifecycle rules (auto-delete old artifacts)
- Simple public or signed URL access

**Setup time:** 5-10 minutes

**Estimated monthly cost for 10 artifacts @ 200MB:** $5 (flat rate)

### 2. Cloudflare R2 ⭐⭐ (Best price/performance)

**Best for:** High-download scenarios, cost optimization

**Pricing:**
- Storage: $0.015/GB/month
- Egress: **$0** (unlimited free)
- Operations: $0.36/million requests

**Features:**
- Zero egress fees (huge savings)
- S3-compatible API
- Fast global distribution
- Simple pricing model

**Setup time:** 10-15 minutes

**Estimated monthly cost for 10 artifacts @ 200MB:** ~$0.03/month

### 3. AWS S3

**Best for:** Large teams, complex compliance needs

**Pricing:**
- Storage: $0.023/GB/month
- Egress: First 100GB free, then $0.09/GB
- Operations: $0.005/1000 requests

**Features:**
- Industry standard, battle-tested
- Massive ecosystem of tools
- Granular IAM permissions
- Glacier for long-term archive

**Setup time:** 15-20 minutes

**Estimated monthly cost for 10 artifacts @ 200MB:** ~$0.05/month + egress

### 4. Backblaze B2

**Best for:** Long-term storage, cost-sensitive projects

**Pricing:**
- Storage: $0.006/GB/month (cheapest)
- Egress: First 3x storage free, then $0.01/GB
- First 10GB free

**Features:**
- 1/4 the cost of S3
- S3-compatible API
- Good egress allowance

**Setup time:** 10 minutes

**Estimated monthly cost for 10 artifacts @ 200MB:** ~$0.01/month

### 5. GitHub Releases

**Best for:** Actual releases (not CI artifacts)

**Pricing:**
- FREE (part of GitHub)

**Features:**
- Simple to use
- Direct integration with Actions
- Permanent links
- No separate service needed

**Limitations:**
- 2GB file size limit per release
- Not designed for frequent artifacts
- Clutters releases page

**Setup time:** 5 minutes

## Comparison Table

| Platform | Storage Cost | Egress Cost | Speed | Setup | Monthly Cost (10 artifacts) |
|----------|--------------|-------------|-------|-------|----------------------------|
| **DO Spaces** | $5/mo flat | Included (1TB) | ⚡⚡⚡ Fast | ⭐⭐⭐ Easy | $5.00 |
| **Cloudflare R2** | $0.015/GB | FREE ⭐ | ⚡⚡⚡ Fast | ⭐⭐ Medium | $0.03 |
| **AWS S3** | $0.023/GB | $0.09/GB | ⚡⚡⚡ Fast | ⭐⭐ Medium | $0.05 + egress |
| **Backblaze B2** | $0.006/GB | $0.01/GB* | ⚡⚡ Moderate | ⭐⭐ Medium | $0.01 |
| **GitHub Releases** | FREE | FREE | ⚡⚡⚡ Fast | ⭐⭐⭐ Easy | $0.00 |

*After 3x storage allowance

## Implementation Approach (When Ready)

### Phase 1: Setup Storage (1 hour)

1. Create DigitalOcean Space (or chosen platform)
2. Generate API keys
3. Add secrets to GitHub Actions
4. Test upload/download manually

### Phase 2: Update CI/CD (2 hours)

1. Modify build job to upload to storage
2. Generate signed/public URL
3. Pass URL to deployment webhook
4. Test on develop branch first

### Phase 3: Update Deployment Script (1 hour)

1. Add artifact download logic
2. Keep git pull as fallback
3. Add checksum verification
4. Test rollback procedure

### Phase 4: Monitoring & Cleanup (ongoing)

1. Set lifecycle rules (delete after 30 days)
2. Monitor storage usage
3. Track deployment times
4. Document rollback procedure

## Recommendation

**For now:** Continue with git pull method
- ✅ Already working
- ✅ Simple to maintain
- ✅ Zero setup required
- ✅ Zero additional costs

**Switch to artifacts when:**
- Deployments take >3 minutes
- You need strict reproducibility
- Production security policy changes
- You're setting up multiple environments

**Recommended platform when ready:** DigitalOcean Spaces
- Same infrastructure provider
- Predictable $5/month cost
- Fast same-datacenter transfers
- Easy S3-compatible setup

## See Also

- [Deployment Setup Guide](./deployment-setup.md)
- [Deployment Rollback Guide](./deployment-rollback.md)
- [CI/CD Pipeline Documentation](../.github/workflows/ci-cd.yml)
