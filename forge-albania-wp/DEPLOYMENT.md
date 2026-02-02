# Deployment Guide

## Local Development Setup

### Option 1: Using Docker (Recommended)

```bash
# Navigate to project directory
cd forge-albania-wp

# Start containers
docker-compose up -d

# Access WordPress at http://localhost
```

**Default Login:**
- Username: `wordpress`
- Password: `wordpress`
- Database: `wordpress`

### Option 2: Using Local by Flywheel

1. Download **Local by Flywheel** from localwp.com
2. Create new site:
   - Name: "Forge Albania"
   - Admin User: admin
   - Password: your choice
3. Copy theme and plugin to appropriate folders
4. Activate through WordPress admin

### Option 3: Manual Setup with XAMPP/WAMP

1. Download WordPress from wordpress.org
2. Create database in phpMyAdmin
3. Configure wp-config.php
4. Copy theme and plugin folders
5. Complete WordPress installation
6. Activate theme and plugin

## Deployment to Production

### Step 1: Prepare Database

```bash
# Export database locally
# In WordPress Admin → Tools → Export → Download

# Or via command line:
mysqldump -u wordpress -p wordpress > backup.sql
```

### Step 2: Prepare Files

```bash
# Create deployment package
zip -r forge-albania.zip . -x "*.git/*" "node_modules/*" ".env" "wp-config.php"
```

### Step 3: Upload to Hosting

**Using FTP:**
1. Connect to hosting via FTP client
2. Upload all files to public_html folder
3. Create database on hosting
4. Upload wp-config.php (updated with host DB credentials)

**Using SSH:**
```bash
# Transfer files
scp -r forge-albania-wp/ user@host:/public_html/

# Or via git
git clone <repo> /path/to/public_html
```

### Step 4: Configure WordPress

1. Create `.htaccess` file in root:
```apache
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.html$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
# END WordPress
```

2. Set proper permissions:
```bash
chmod 755 wp-content
chmod 755 wp-content/uploads
chmod 755 wp-content/themes
chmod 755 wp-content/plugins
chmod 644 wp-config.php
```

3. Update database credentials in wp-config.php

### Step 5: Finalize Installation

1. Run WordPress installer or import existing database
2. Update WordPress URL:
   - In database: `wp_options` table
   - siteurl: `https://yourdomain.com`
   - home: `https://yourdomain.com`

3. Or via PHP (in wp-admin/):
```php
<?php
// Update WordPress URL
wp_initialize_site();
update_option('siteurl', 'https://yourdomain.com');
update_option('home', 'https://yourdomain.com');
echo "URLs updated!";
?>
```

## SSL Certificate Setup

### With Let's Encrypt (Free)

```bash
# Using Certbot
sudo certbot certonly --webroot -w /var/www/html -d yourdomain.com

# Configure web server
# Update .htaccess to force HTTPS
```

### .htaccess for HTTPS

```apache
# Force HTTPS
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</IfModule>
```

## Performance Optimization

### 1. Enable Caching

Install **WP Super Cache** or **W3 Total Cache**:

```bash
# Via WordPress Admin
Plugins → Search → Install and Activate
```

### 2. Optimize Database

```bash
# Via WordPress Admin
Tools → WP-Optimize → Optimize
```

### 3. Optimize Images

```bash
# Before uploading, compress images:
# - Use TinyPNG.com
# - Use ImageOptim (Mac)
# - Use FileOptimizer (Windows)
```

### 4. Configure CDN

Install **Cloudflare** (Free tier):
1. Sign up at cloudflare.com
2. Add your domain
3. Update nameservers
4. Enable caching

## Monitoring & Maintenance

### Daily
- Check error logs
- Monitor site performance

### Weekly
- Backup database
- Update security

### Monthly
- Update WordPress core
- Update plugins & theme
- Review analytics

### Backup Strategy

```bash
# Automated daily backups
# Install: UpdraftPlus or BackWPup

# Manual backup
mysqldump -u user -p dbname > backup-$(date +%Y%m%d).sql
tar czf wordpress-backup-$(date +%Y%m%d).tar.gz /var/www/html
```

## Security Hardening

### 1. Remove WordPress Version

Add to functions.php:
```php
remove_action('wp_head', 'wp_generator');
```

### 2. Disable File Editing

Add to wp-config.php:
```php
define('DISALLOW_FILE_EDIT', true);
```

### 3. Secure wp-admin

Create `.htaccess` in `/wp-admin/`:
```apache
<Files wp-login.php>
Order Deny,Allow
Deny from all
Allow from YOUR.IP.ADDRESS
</Files>
```

### 4. Install Security Plugin

Install **Wordfence** or **iThemes Security**:
- Enable 2FA
- Enable firewall
- Scan for malware

## Troubleshooting Deployment

### Issue: Blank White Page

**Solution:**
```php
// Add to wp-config.php for debugging
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

### Issue: Images Not Loading

**Solution:**
1. Check file permissions
2. Verify wp-content/uploads folder
3. Check URL configuration

### Issue: 404 Errors

**Solution:**
```bash
# Reset permalinks via WordPress Admin
Settings → Permalinks → Save Changes
```

### Issue: Database Connection Error

**Solution:**
1. Verify database credentials in wp-config.php
2. Check database exists
3. Verify user has privileges
4. Check database host (localhost vs remote)

## Domain Configuration

### Change WordPress Domain

**Method 1: Via WordPress Admin**
1. Settings → General
2. Update WordPress Address and Site Address
3. Save Changes

**Method 2: Via Database**
```sql
UPDATE wp_options SET option_value = 'https://newdomain.com' WHERE option_name IN ('siteurl', 'home');
```

**Method 3: Via wp-config.php**
```php
define('WP_HOME', 'https://yourdomain.com');
define('WP_SITEURL', 'https://yourdomain.com');
```

## Subdomain Setup

For subdomain (e.g., portfolio.example.com):

1. Create DNS A record pointing to server IP
2. Create folder: `/public_html/portfolio/`
3. Upload WordPress files to that folder
4. Follow standard installation steps

## Content Delivery

### Using CDN for Theme Assets

Update `functions.php`:
```php
if (is_ssl()) {
    $cdn_url = 'https://cdn.yourdomain.com';
} else {
    $cdn_url = 'http://cdn.yourdomain.com';
}

wp_enqueue_style('forge-albania-style', $cdn_url . '/wp-content/themes/forge-albania/style.css');
wp_enqueue_script('forge-albania-script', $cdn_url . '/wp-content/themes/forge-albania/assets/js/main.js');
```

## Rollback Plan

If something goes wrong:

```bash
# Restore from backup
mysql -u user -p dbname < backup-20240202.sql

# Restore files
tar xzf wordpress-backup-20240202.tar.gz
```

---

**Your site is now live!** Monitor regularly and keep all software updated.
