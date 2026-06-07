<h1 align="center">🍞 MyBread - Aplikasi E-Commerce Toko Roti</h1>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  <img src="https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript" />
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5" />
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3" />
</p>

---

## 📖 Tentang Proyek

**MyBread** adalah sebuah aplikasi web e-commerce sederhana yang dirancang untuk melayani pemesanan produk roti (bakery) secara *online*. Proyek ini dibangun menggunakan **PHP Native** dan **MySQL**, dengan antarmuka yang modern, responsif, dan interaktif menggunakan Vanilla JavaScript dan CSS3.

Sistem ini mencakup alur belanja lengkap, mulai dari pendaftaran akun, pemilihan produk ke keranjang belanja yang dikelola menggunakan *PHP Sessions*, hingga proses *checkout* dan pelacakan riwayat pesanan.

## ✨ Fitur Utama

Aplikasi ini dilengkapi dengan berbagai fitur esensial e-commerce:

* 🔐 **Autentikasi Aman:** Sistem Login dan Registrasi menggunakan enkripsi *password* standar industri (BCRYPT).
* 🛍️ **Katalog Produk Dinamis:** Menampilkan produk dalam dua kategori (Reguler dan Custom) menggunakan antarmuka sistem *Tab* yang rapi.
* 🛒 **Keranjang Belanja (*Cart*):** Memungkinkan pengguna menambah, mengurangi, atau menghapus item. Data keranjang dikelola secara efisien menggunakan *Session*.
* 📦 **Manajemen Pesanan:** Pengguna dapat melihat daftar riwayat pemesanan beserta status dan rincian struk pembelian.
* 👤 **Profil Pengguna:** Halaman khusus untuk melihat data diri pengguna seperti NIK, email, telepon, dan alamat pengiriman.
* 🖼️ **UI/UX Interaktif:** Dilengkapi dengan *Slider/Carousel* produk unggulan, *dropdown menu*, dan notifikasi (alert) otomatis berbasis JavaScript.

## 🛠️ Tech Stack

* **Frontend:** HTML5, CSS3, Vanilla JavaScript
* **Backend:** PHP (Native)
* **Database:** MySQL
* **Tools:** XAMPP, VS Code / Sublime Text

## 🚀 Panduan Instalasi & Konfigurasi (Lokal)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di perangkat lokal Anda:

1. **Persiapan Environtment:**
   Pastikan Anda sudah menginstal web server lokal seperti [XAMPP](https://www.apachefriends.org/index.html) atau MAMP.
   
2. **Kloning Repositori:**
   Buka terminal/Command Prompt dan jalankan perintah berikut di dalam folder `htdocs` (untuk XAMPP):
   ```bash
   git clone [https://github.com/username-anda/mybread-ecommerce.git](https://github.com/username-anda/mybread-ecommerce.git)

Konfigurasi Database:

Buka XAMPP Control Panel dan jalankan modul Apache serta MySQL.

Buka browser dan akses http://localhost/phpmyadmin.

Buat database baru dengan nama mybread_db.

Import file database (.sql) yang telah disediakan ke dalam database tersebut. (Catatan: Pastikan tabel users, products, dll. sudah terbuat).

Konfigurasi Koneksi (Opsional):
Cek file koneksi.php. Pastikan kredensial sesuai dengan server lokal Anda:

PHP
$host = "localhost";
$user = "root";       
$pass = "";           
$db   = "mybread_db"; 
Jalankan Aplikasi:
Buka browser web Anda dan ketikkan URL berikut:

Plaintext
http://localhost/mybread-ecommerce/index.php
📂 Struktur Direktori Utama
Plaintext
📁 mybread-ecommerce
├── 📄 index.php             # Halaman beranda (Hero section & Slider)
├── 📄 login.php             # Halaman masuk pengguna
├── 📄 register.php          # Halaman pendaftaran akun baru
├── 📄 produk.php            # Halaman katalog produk dengan Tab navigasi
├── 📄 keranjang.php         # Halaman keranjang (PHP Session)
├── 📄 checkout.php          # Proses pembayaran pesanan
├── 📄 pesanan.php           # Daftar riwayat pesanan
├── 📄 detail_pesanan.php    # Rincian struk/invoice pesanan
├── 📄 profil.php            # Halaman informasi pengguna
├── 📄 koneksi.php           # Modul koneksi ke database MySQL
├── 📄 style.css             # Styling UI/UX (terpisah/inline)
└── 📄 script.js             # Logika client-side (Alert, Slider, Tabs, dll)
👨‍💻 Pengembang
Dikembangkan oleh Zefanya Raditya Pratama.

Seorang pembelajar yang membumi; berkomitmen pada pertumbuhan berkelanjutan dan adaptasi tiada henti.

LinkedIn

Medium

⭐️ Jika proyek ini bermanfaat untuk referensi belajar PHP Anda, jangan lupa berikan bintang (Star) pada repositori ini!
   
