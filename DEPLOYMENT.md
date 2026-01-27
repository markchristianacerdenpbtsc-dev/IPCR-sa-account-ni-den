# Deployment Guide

## Current Status
- Branch: `temp-deployment`
- Repository: https://github.com/jarlokenpaghubasan/IPCR.git

## Deployment Platforms

### Heroku (Recommended)

1. **Install Heroku CLI**
   ```bash
   # Download from https://devcenter.heroku.com/articles/heroku-cli
   ```

2. **Login and Create App**
   ```bash
   heroku login
   heroku create ipcr-system
   ```

3. **Add MySQL Database**
   ```bash
   heroku addons:create cleardb:ignite
   ```

4. **Get Database URL**
   ```bash
   heroku config:get CLEARDB_DATABASE_URL
   # Parse this URL to get DB credentials
   ```

5. **Set Environment Variables**
   ```bash
   heroku config:set APP_NAME="IPCR System"
   heroku config:set APP_ENV=production
   heroku config:set APP_DEBUG=false
   heroku config:set APP_KEY=base64:YOUR_KEY_HERE
   heroku config:set APP_URL=https://your-app.herokuapp.com
   heroku config:set LOG_CHANNEL=errorlog
   ```

6. **Deploy**
   ```bash
   git push heroku temp-deployment:main
   ```

7. **Run Migrations**
   ```bash
   heroku run php artisan migrate --force
   heroku run php artisan db:seed --force
   ```

8. **Create Storage Link**
   ```bash
   heroku run php artisan storage:link
   ```

### Railway.app

1. Visit https://railway.app
2. Sign in with GitHub
3. New Project → Deploy from GitHub repo
4. Select repository and `temp-deployment` branch
5. Add MySQL database service
6. Set environment variables in dashboard
7. Deploy automatically on push

### Environment Variables Required

```
APP_NAME="IPCR System"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_GENERATED_KEY
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

## Post-Deployment Steps

1. Generate app key: `php artisan key:generate`
2. Run migrations: `php artisan migrate --force`
3. Seed database: `php artisan db:seed --force`
4. Create storage link: `php artisan storage:link`
5. Clear caches: `php artisan config:cache && php artisan route:cache`

## Security Checklist

- ✓ `.env` is in `.gitignore`
- ✓ `APP_DEBUG=false` in production
- ✓ `APP_ENV=production`
- ✓ Strong `APP_KEY` generated
- ✓ Database credentials secured
- ✓ HTTPS enabled on domain

## Troubleshooting

### 500 Error
- Check logs: `heroku logs --tail`
- Ensure `APP_KEY` is set
- Verify database connection

### Missing Assets
- Run: `npm run build`
- Ensure `public/build` exists

### Permission Issues
- Check storage permissions
- Run: `chmod -R 775 storage bootstrap/cache`
