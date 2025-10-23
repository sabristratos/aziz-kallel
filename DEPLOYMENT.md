# Coolify Deployment Guide for Abdelaziz Kallel Website

This Laravel 12 application is configured for deployment on Coolify using Nixpacks.

## Pre-Deployment Checklist

### 1. Coolify Resource Settings

**Build Configuration:**
- Build Pack: `nixpacks`
- Ports Exposes: `80`

### 2. Required Environment Variables

Set these in Coolify's Environment Variables section:

```env
# Application
APP_NAME="Abdelaziz Kallel"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://yourdomain.com
APP_TIMEZONE=UTC
APP_LOCALE=de
APP_FALLBACK_LOCALE=de

# Database (if using Coolify's database service)
DB_CONNECTION=mysql
DB_HOST=<DB_HOST_FROM_COOLIFY>
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=<DB_PASSWORD_FROM_COOLIFY>

# Redis (if using Coolify's Redis service)
REDIS_HOST=<REDIS_HOST_FROM_COOLIFY>
REDIS_PASSWORD=null
REDIS_PORT=6379

# Mail Configuration (will be overridden by database settings)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="${APP_NAME}"

# Cache & Sessions
CACHE_STORE=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

# Filesystem
FILESYSTEM_DISK=public
```

### 3. Post-Deployment Commands

Add this to Coolify's **Post-deployment** script section:

```bash
php artisan migrate --force && \
php artisan db:seed --class=SettingsSeeder --force && \
php artisan optimize:clear && \
php artisan config:cache && \
php artisan route:cache && \
php artisan view:cache && \
php artisan optimize
```

**Important:** These caching commands run **after** deployment, not during build. This ensures:
- Database connection is available for config caching
- All environment variables are properly loaded
- Migrations have completed before caching
- No build failures due to missing dependencies

## Nixpacks Configuration

The `nixpacks.toml` file in this repository is pre-configured with:

### ✅ Features Included

1. **Supervisor Process Management**
   - NGINX web server
   - PHP-FPM (FastCGI Process Manager)
   - Laravel Queue Workers (4 processes with 512MB memory limit)
   - Laravel Task Scheduler (cron jobs)

2. **PHP Extensions**
   - Redis, PDO, BCMath (database & math)
   - GD (image processing for Media Library)
   - Zip (file compression)
   - Intl (internationalization for German/Arabic)
   - Exif (image metadata for uploads)

3. **File Upload Support**
   - Max upload size: 30MB
   - Max post size: 35MB
   - Configured in both PHP-FPM and NGINX

4. **Livewire Compatibility**
   - FastCGI buffer size: 16k
   - FastCGI buffers: 16x16k
   - Busy buffers: 32k
   - Prevents "upstream sent too big header" errors

5. **Production-Ready Settings**
   - Proper file permissions for storage/cache
   - Correct document root: `/app/public`
   - Asset compilation (Vite)
   - Storage linking automated

## Worker Processes

The following processes run automatically via Supervisor:

| Worker | Purpose | Count |
|--------|---------|-------|
| `worker-nginx` | Web server | 1 |
| `worker-phpfpm` | PHP FastCGI | 1 |
| `worker-laravel` | Queue processing | 4 |
| `worker-scheduler` | Cron jobs (every minute) | 1 |

### Adjusting Queue Workers

**Current Configuration:**
- 4 queue worker processes
- 512MB memory limit per process
- Redis connection
- 3600s (1 hour) max execution time

**To reduce resource usage,** edit `nixpacks.toml`:

```toml
"worker-laravel.conf" = '''
...
command=bash -c 'exec php /app/artisan queue:work redis --memory=256 --sleep=3 --tries=3 --max-time=3600'
...
numprocs=2  # Change from 4 to 2 for lower memory usage
...
'''
```

This reduces memory usage from **2GB → 512MB** (2 workers × 256MB each).

## Email Configuration

This application uses **database-driven email configuration**:

1. After deployment, navigate to: `/admin/settings`
2. Select the "Email Configuration" category
3. Configure your SMTP settings:
   - Mail Host
   - Mail Port
   - Mail Username
   - Mail Password
   - Mail Encryption (tls/ssl)
   - From Address
   - From Name
4. Click "Send Test Email" to verify configuration

**Note:** Database settings override `.env` values automatically via `MailConfigServiceProvider`.

## Troubleshooting

### Build Fails or Slow

**Note:** Caching commands have been moved to **post-deployment** to prevent build failures.

If builds are still slow:
- Check if all npm dependencies are installing correctly
- Verify Vite is building assets successfully
- Ensure storage and cache directories have proper permissions

### Queue Jobs Not Processing

Check supervisor logs in Coolify:
```bash
tail -f /var/log/worker-laravel.log
```

### Scheduled Tasks Not Running

Check scheduler logs:
```bash
tail -f /var/log/worker-scheduler.log
```

### File Upload Errors

Ensure storage permissions are correct:
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Performance Tuning

### For Low-Traffic Sites (< 1000 visitors/day)

Reduce PHP-FPM pool size in `nixpacks.toml`:

```toml
"php-fpm.conf" = '''
...
pm.max_children = 20
pm.start_servers = 5
pm.min_spare_servers = 2
pm.max_spare_servers = 10
...
'''
```

### For High-Traffic Sites (> 10,000 visitors/day)

Increase queue workers and PHP-FPM pool:

```toml
# Queue workers
numprocs=8

# PHP-FPM
pm.max_children = 100
pm.start_servers = 25
```

## Additional Resources

- [Coolify Documentation](https://coolify.io/docs)
- [Nixpacks Documentation](https://nixpacks.com)
- [Laravel Deployment Documentation](https://laravel.com/docs/deployment)
- [Supervisor Documentation](http://supervisord.org)

## Support

For issues specific to this application, check:
- Coolify deployment logs
- Supervisor process status: `supervisorctl status`
- Laravel logs: `storage/logs/laravel.log`
