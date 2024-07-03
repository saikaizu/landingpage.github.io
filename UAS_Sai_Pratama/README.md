# UEFA 2024 PHP Application

Aplikasi PHP sederhana untuk menangani klasemen Eropa UEFA 2024.

## Fitur

- Login menggunakan NIM dan password
- Menambah data group
- Menambah data negara UEFA
- Mengubah data klasemen negara yang sudah diinput
- Menghapus data klasemen negara yang sudah diinput
- Mencetak data klasemen negara dengan format PDF
- Logout sistem

## Struktur Proyek

project/
├── index.php
├── login.php
├── logout.php
├── add_group.php
├── add_country.php
├── update_country.php
├── delete_country.php
├── report.php
├── config.php
├── styles.css
└── README.md


## Cara Menggunakan

1. Clone repository ini
2. Buat database `uefa` dan import file SQL
3. Edit file `config.php` untuk mengatur koneksi database
4. Jalankan aplikasi dengan membuka `index.php` di browser

## Penggunaan di Hosting Gratis

Unggahlah aplikasi ini ke hosting gratis seperti di 000webhost.com dan push source code dan database ke repositori UAS GitHub masing-masing. Tambahkan keterangan fungsi PHP pada tiap fiturnya di file readme.md (sertakan link domain dan username dan password untuk login ke sistem). Kirim link domain dan repositori GitHubnya di e-learning.unpam.ac.id dalam bentuk PDF.
