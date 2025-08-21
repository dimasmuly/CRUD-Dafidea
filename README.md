````markdown
# 📌 Dokumentasi Proyek CRUD-Dafidea

Proyek ini adalah aplikasi **CRUD sederhana** untuk mengelola postingan dan komentar, dengan **backend Laravel** dan **frontend Vue.js**.  
Dokumentasi ini mencakup setup, fitur, serta dokumentasi API.

---

## 🚀 Persyaratan
- PHP >= 8.0
- Composer
- Node.js & npm
- Database MySQL atau SQLite

---

## ⚙️ Instalasi

### 🔹 Backend (Laravel)
1. Masuk ke direktori `api/`:
   ```bash
   cd api
````

2. Instal dependensi:

   ```bash
   composer install
   ```
3. Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database.
4. Generate app key:

   ```bash
   php artisan key:generate
   ```
5. Jalankan migrasi:

   ```bash
   php artisan migrate
   ```
6. Jalankan server:

   ```bash
   php artisan serve
   ```

### 🔹 Frontend (Vue.js)

1. Masuk ke direktori `frontend/`:

   ```bash
   cd frontend
   ```
2. Instal dependensi:

   ```bash
   npm install
   ```
3. Jalankan server development:

   ```bash
   npm run dev
   ```

---

## ✨ Fitur

* **Admin Dashboard**

  * Login admin
  * Counter post & komentar
  * CRUD post
* **Halaman Publik**

  * Daftar post
  * Detail post + komentar
  * Form tambah komentar
* **Otentikasi**

  * Login admin menggunakan **Laravel Sanctum**
* **Komentar**

  * Tambah komentar (publik)
  * Tampilkan komentar
  * Edit/hapus komentar (admin)

---


## 🧪 Pengujian

Backend:

```bash
php artisan test
```

Frontend (misalnya dengan Cypress/Vitest):

```bash
npm run test
```

---

## 🚀 Deployment

* **Frontend**: Vercel, Netlify, atau server VPS
* **Backend**: Heroku, Render, Railway, atau server VPS

---

## 📂 Struktur Direktori (Opsional)

```
.
├── api/         # Backend Laravel
│   ├── app/
│   ├── routes/
│   ├── database/
│   └── ...
├── frontend/    # Frontend Vue.js
│   ├── src/
│   ├── public/
│   └── ...
└── README.md
```

---

✍️ CRUD fullstack Laravel + Vue.js

```

