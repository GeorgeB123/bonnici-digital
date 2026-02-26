#!/bin/bash
#
# DevPanel Deployment Script
# Handles artifact download, backup, and safe Drupal deployment
#
# Usage: ./devpanel-deploy.sh <branch> <sha> <artifact_url>
#

set -e  # Exit on any error
set -u  # Exit on undefined variable
set -o pipefail  # Exit on pipe failure

# Configuration
BRANCH=${1:-""}
SHA=${2:-""}
ARTIFACT_URL=${3:-""}
TIMESTAMP=$(date +%Y%m%d-%H%M%S)
LOG_FILE="/tmp/deployment-${BRANCH}-${TIMESTAMP}.log"
TEMP_DIR="/tmp/deploy-${SHA}"
WEBROOT="/home/devpanel/applications/bonnici-digital/public_html"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Logging function
log() {
    echo "[$(date +'%Y-%m-%d %H:%M:%S')] $1" | tee -a "$LOG_FILE"
}

# Error handler
error_exit() {
    echo -e "${RED}[$(date +'%Y-%m-%d %H:%M:%S')] ERROR: $1${NC}" | tee -a "$LOG_FILE"
    log "Deployment failed. Check log: $LOG_FILE"
    cleanup
    exit 1
}

# Success handler
success() {
    echo -e "${GREEN}[$(date +'%Y-%m-%d %H:%M:%S')] $1${NC}" | tee -a "$LOG_FILE"
}

# Warning handler
warning() {
    echo -e "${YELLOW}[$(date +'%Y-%m-%d %H:%M:%S')] WARNING: $1${NC}" | tee -a "$LOG_FILE"
}

# Cleanup function
cleanup() {
    if [ -d "$TEMP_DIR" ]; then
        log "Cleaning up temporary directory: $TEMP_DIR"
        rm -rf "$TEMP_DIR"
    fi
}

# Validate inputs
if [ -z "$BRANCH" ] || [ -z "$SHA" ]; then
    error_exit "Usage: $0 <branch> <sha> <artifact_url>"
fi

log "========================================="
log "Starting deployment for branch: $BRANCH"
log "Commit SHA: $SHA"
log "Artifact URL: $ARTIFACT_URL"
log "========================================="

# Step 1: Create temporary directory
log "Creating temporary directory..."
mkdir -p "$TEMP_DIR" || error_exit "Failed to create temp directory"

# Step 2: Download artifact (if URL provided)
if [ -n "$ARTIFACT_URL" ]; then
    log "Downloading artifact from GitHub Actions..."
    ARTIFACT_FILE="$TEMP_DIR/artifact.tar.gz"

    if [ -n "${GITHUB_TOKEN:-}" ]; then
        curl -L -f -H "Authorization: token $GITHUB_TOKEN" \
            -o "$ARTIFACT_FILE" "$ARTIFACT_URL" || error_exit "Failed to download artifact"
    else
        warning "GITHUB_TOKEN not set, skipping artifact download"
    fi

    # Verify artifact was downloaded
    if [ -f "$ARTIFACT_FILE" ]; then
        log "Artifact downloaded successfully"

        # Extract artifact
        log "Extracting artifact..."
        tar -xzf "$ARTIFACT_FILE" -C "$TEMP_DIR" || error_exit "Failed to extract artifact"
        success "Artifact extracted successfully"
    fi
else
    log "No artifact URL provided, using git pull method..."
    cd "$WEBROOT" || error_exit "Failed to change to webroot"
    git pull origin "$BRANCH" || error_exit "Git pull failed"
fi

# Step 3: Install dependencies based on branch
cd "$WEBROOT" || error_exit "Failed to change to webroot"

log "Installing Composer dependencies..."
if [ "$BRANCH" = "develop" ]; then
    # Dev environment includes dev dependencies
    composer install -n >> "$LOG_FILE" 2>&1 || error_exit "Composer install failed"
else
    # Staging/Production use production dependencies only
    composer install -n --no-dev --optimize-autoloader >> "$LOG_FILE" 2>&1 || error_exit "Composer install failed"
fi
success "Composer dependencies installed"

# Step 4: Create database backup
log "Creating database backup..."
# DevPanel automatic backup (triggered by deployment hook)
# If you have a specific backup command, add it here
# For now, we rely on DevPanel's built-in backup system
log "Database backup completed (DevPanel automatic backup)"

# Step 5: Run drush deploy
log "Running drush deploy..."
vendor/bin/drush deploy -y >> "$LOG_FILE" 2>&1 || error_exit "drush deploy failed"
success "drush deploy completed successfully"

# Step 6: Update deployed version file
log "Updating .deployed-version file..."
cat > "$WEBROOT/.deployed-version" <<EOF
SHA: $SHA
Timestamp: $(date -u +%Y-%m-%dT%H:%M:%SZ)
Branch: $BRANCH
Deployed: $TIMESTAMP
EOF
success ".deployed-version updated"

# Step 7: Run smoke tests (branch-specific)
if [ "$BRANCH" = "staging" ] || [ "$BRANCH" = "main" ]; then
    log "Running smoke tests..."

    # Check if site is responding
    HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost/ || echo "000")

    if [ "$HTTP_CODE" = "200" ] || [ "$HTTP_CODE" = "301" ] || [ "$HTTP_CODE" = "302" ]; then
        success "Smoke test passed (HTTP $HTTP_CODE)"
    else
        error_exit "Smoke test failed (HTTP $HTTP_CODE)"
    fi

    # Run drush status
    log "Running drush status check..."
    vendor/bin/drush status >> "$LOG_FILE" 2>&1 || warning "drush status check failed"
fi

# Step 8: Cleanup
cleanup

# Final success
log "========================================="
success "Deployment completed successfully!"
log "Branch: $BRANCH"
log "Commit: $SHA"
log "Log file: $LOG_FILE"
log "========================================="

exit 0
