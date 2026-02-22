# Panduan Deployment MH As-Saodah

Dokumen ini berisi langkah-langkah untuk mendeploy aplikasi MH As-Saodah.

## 1. Frontend (Vercel)

Aplikasi Frontend menggunakan **Next.js** dan disarankan dideploy ke **Vercel**.

### Langkah-langkah:
1. Masuk ke [Dashboard Vercel](https://vercel.com/dashboard).
2. Klik **New Project** dan hubungkan ke repository GitHub Bapak.
3. Pada bagian **Root Directory**, klik Edit dan pilih folder `Profil MH As-Saodah`.
4. Pada **Framework Preset**, pastikan terpilih **Next.js**.
5. Masukkan **Environment Variables** (lihat file `web/.env.local` sebagai referensi):
   - `NEXT_PUBLIC_API_URL`: URL API Backend Bapak (contoh: `https://api.assaodah.com/api`).
6. Klik **Deploy**.

---

## 2. Backend (VPS)

Aplikasi Backend menggunakan **Laravel** dan dideploy menggunakan **Docker Compose** di VPS.

### Persiapan VPS:
Pastikan VPS Bapak sudah terinstall:
- Docker
- Docker Compose

### Langkah-langkah:
1. Clone repository ke VPS:
   ```bash
   git clone https://github.com/velora-1d/MH-As-Saodah-FE-BE.git
   cd MH-As-Saodah-FE-BE/dashboard-MH
   ```
2. Siapkan file `.env` di folder `dashboard-MH`:
   ```bash
   cp .env.example .env
   # Edit .env dan sesuaikan DB_HOST=pgsql, DB_USERNAME, DB_PASSWORD, dll.
   ```
3. Jalankan Docker Compose dari root project:
   ```bash
   cd ../infra
   docker-compose -f docker-compose.prod.yml up -d --build
   ```
4. Jalankan Migrasi di dalam container:
   ```bash
   docker exec -it mhas_app php artisan migrate --seed
   ```

---

## 3. Konfigurasi Domain (Opsional)
- Arahkan domain utama (misal: `assaodah.com`) ke Vercel.
- Arahkan subdomain (misal: `api.assaodah.com`) ke IP VPS Bapak.
- Gunakan Certbot di VPS jika ingin memasang SSL manual, atau biarkan Cloudflare menangani SSL-nya.
