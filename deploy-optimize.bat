@echo off
echo ===================================================
echo   Mengoptimalkan Aplikasi Bengkelin untuk Deploy
echo ===================================================
echo.

echo [1/6] Membersihkan Cache Lama...
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear

echo.
echo [2/6] Membuat Cache Konfigurasi Produksi...
php artisan config:cache

echo.
echo [3/6] Membuat Cache Routing Produksi...
php artisan route:cache

echo.
echo [4/6] Pre-compiling Blade Views...
php artisan view:cache

echo.
echo [5/6] Mengoptimalkan Autoloader Composer...
composer dump-autoload --optimize

echo.
echo [6/6] Build Asset Frontend (CSS & JS Minified)...
npm run build

echo.
echo ===================================================
echo   Optimasi Selesai! Proyek Siap Dideploy.
echo ===================================================
pause
