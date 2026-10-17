# MVC PHP Native - Data Buku

Aplikasi CRUD sederhana untuk mempelajari pola Model-View-Controller pada PHP Native.
Entitas utama: buku (isbn, judul, penulis, penerbit, tahun_terbit, stok).

## Kebutuhan
PHP 8.0 atau lebih baru
MySQL/MariaDB
Web server lokal seperti XAMPP atau Laragon
Git

## Instalasi
Clone atau salin project ke folder web server (htdocs untuk XAMPP).
Import `database/perpustakaan.sql`.
Sesuaikan koneksi pada `config/database.php`.
Buka `http://localhost/mvc-buku/public/index.php`.

## Struktur MVC
`app/models/` : akses dan operasi data.
`app/controllers/` : alur request dan pemanggilan Model/View.
`app/views/buku/` : tampilan HTML.
`config/` : konfigurasi koneksi database.
`database/` : skema dan data awal SQL.
`public/` : entry point aplikasi.

## Fitur
Menampilkan, menambah, mengubah, dan menghapus data buku
Validasi input, prepared statement, escaping output, pesan berhasil/gagal

## Histori Git
0069ba2 (HEAD -> main) feat: add complete CRUD routing
c047468 feat: add complete book CRUD views
7f6fc9f feat: add complete book CRUD controller
6583420 feat: add PDO database connection
963d7bb feat: add book database schema and seed data
e0ee61c feat: add book database schema and seed data
105f5c3 chore: initialize mvc php native project