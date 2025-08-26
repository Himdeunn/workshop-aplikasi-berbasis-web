# Workshop Aplikasi Berbasis Web

Repository ini dibuat untuk mendokumentasikan atau menulis mengenai **Workshop Aplikasi Berbasis Web**—sesuatu yang saya (Himdeunn) buat tanpa alasan khusus, namun digunakan sebagai tempat tulisan dan praktik selama workshop ini.

## Struktur Proyek

> **Catatan:** Sesuaikan struktur di bawah ini dengan isi aktual repo kamu.

```
├── app/                 # Kode aplikasi Laravel
├── bootstrap/          
├── config/             
├── database/           
│   └── database.sqlite  # SQLite DB untuk mode development
├── resources/          
│   ├── views/          # Blade views
│   └── js/             # JavaScript / Vue / React components (jika ada)
├── routes/
│   └── web.php         # Definisi rute aplikasi
├── .env.example         # Contoh environment config
├── composer.json       
└── README.md           # Dokumentasi ini
```

## Instalasi & Setup

Ikuti langkah-langkah berikut untuk menjalankan aplikasi secara lokal:

1. **Clone repository**

   ```bash
   git clone https://github.com/Himdeunn/workshop-aplikasi-berbasis-web.git
   cd workshop-aplikasi-berbasis-web
   ```

2. **Install dependencies**

   ```bash
   composer install
   ```

3. **Salin file environment**

   ```bash
   cp .env.example .env
   ```

4. **Generate aplikasi key**

   ```bash
   php artisan key:generate
   ```

5. **Konfigurasi SQLite (jika menggunakan SQLite)**

   * Buat file SQLite:

     ```bash
     touch database/database.sqlite
     ```
   * Pastikan konfigurasi `.env` mengarah ke SQLite:

     ```
     DB_CONNECTION=sqlite
     DB_DATABASE=/absolute-path-ke/database/database.sqlite
     ```

6. **Migrasi database**

   ```bash
   php artisan migrate
   ```

7. **Jalankan aplikasi**

   ```bash
   php artisan serve
   ```

   Akses di `http://127.0.0.1:8000`.

---

## Catatan Penting

* **Singkatan tujuan repositori**: Repository ini digunakan untuk menuliskan materi dan praktik dari workshop aplikasi berbasis web (Laravel), tanpa tujuan spesifik lainnya.
* **SQLite**: Jika menggunakan SQLite, jangan lupa aktifkan ekstensi `pdo_sqlite` dan `sqlite3` di konfigurasi PHP kamu—terutama jika menggunakan Laragon atau stack lain (lihat instruksi di file lainnya jika sudah diatur).

---

## Kontribusi

Silakan kontribusikan jika kamu menambahkan materi workshop, modul, catatan, atau contoh kode lain di repositori ini. Mulai dengan:

1. Fork repo ini.
2. Buat cabang (branch) baru: `git checkout -b fitur-baru`.
3. Lakukan perubahan dan commit: `git commit -m "Menambahkan modul baru"`.
4. Push ke cabang kamu: `git push origin fitur-baru`.
5. Buka Pull Request di GitHub.

---

## Lisensi

Tuliskan lisensi yang berlaku, misalnya:

```
MIT License
```

---

## Penulis

**Himdeunn** — Tempat dokumentasi workshop Aplikasi Berbasis Web.
