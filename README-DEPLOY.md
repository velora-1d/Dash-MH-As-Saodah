# Panduan Deployment MH As-Saodah

Aplikasi ini menggunakan **Laravel + Blade** dan dideploy langsung ke VPS.

## Stack Produksi

- **Web Server**: Nginx
- **PHP**: 8.4-FPM
- **Database**: PostgreSQL (peer auth via unix socket)
- **Domain**: `assaodah.santrix.my.id` (HTTPS via Certbot)
- **Root**: `/var/www/dashboard-mh/public`

---

## Langkah Deploy (Update)

### 1. Rsync Kode Terbaru ke VPS

```bash
rsync -avz --delete \
  --exclude='.env' \
  --exclude='storage/' \
  --exclude='vendor/' \
  --exclude='node_modules/' \
  --exclude='.git/' \
  --exclude='bootstrap/cache/' \
  /path/lokal/dashboard-MH/ \
  ubuntu@43.156.132.218:/home/ubuntu/dashboard-mh/
```

### 2. Copy ke Directory Produksi (via sudo)

```bash
ssh ubuntu@43.156.132.218
sudo rsync -a \
  --exclude='.env' \
  --exclude='storage/' \
  --exclude='vendor/' \
  --exclude='node_modules/' \
  --exclude='.git/' \
  --exclude='bootstrap/cache/' \
  /home/ubuntu/dashboard-mh/ /var/www/dashboard-mh/
```

### 3. Jalankan Migrasi & Cache

```bash
cd /var/www/dashboard-mh
sudo -u www-data php artisan migrate --force
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
```

### 4. (Jika ada perubahan dependency)

```bash
cd /var/www/dashboard-mh
sudo composer install --no-dev --optimize-autoloader
sudo npm install && sudo npm run build
sudo chown -R www-data:www-data storage bootstrap/cache
```

---

## Catatan Penting

- **Database**: PostgreSQL menggunakan peer authentication (unix socket). Semua perintah `artisan` harus dijalankan sebagai user `www-data`: `sudo -u www-data php artisan ...`
- **File `.env`**: Tidak pernah di-sync. Konfigurasi produksi dikelola langsung di VPS.
- **Storage**: Folder `storage/` tidak di-deploy ulang untuk menjaga data upload yang ada.
