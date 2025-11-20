# 📘 WokaClientCare -- Sistem Monitoring Klien & Maintenance Kontrak

WokaClientCare adalah sistem berbasis web yang dibangun menggunakan
**Laravel 12** untuk membantu perusahaan dalam mengelola **data klien**,
**kontrak maintenance**, **jadwal maintenance**, dan **invoice** secara
lebih terstruktur serta efisien.

------------------------------------------------------------------------

## 👥 Anggota Kelompok
  -----------------------------------------------------------------------
  1    Mutia Pegi Intanswari          Backend Developer / Repo Owner

  2    Fransiskus Farel Saputra       Developer

  3    Fadhil Bintang Pratama         Developer

  4    Khansa Bintari                 Developer

------------------------------------------------------------------------

## 🎯 Tujuan Sistem

-   Mempermudah pengelolaan data klien.
-   Memonitor status kontrak: aktif, hampir habis, expired.
-   Mengatur jadwal maintenance untuk teknisi.
-   Mengelola invoice: unpaid, paid, overdue.
-   Mempermudah kerja tim secara kolaboratif.

------------------------------------------------------------------------

## 🧩 Fitur Utama

### 1. **Manajemen Klien**

-   Tambah, edit, hapus data klien
-   Data kontak, alamat, PIC, dan lainnya

### 2. **Manajemen Kontrak Maintenance**

-   Tanggal mulai--berakhir kontrak
-   Status otomatis: aktif / warning / expired
-   Upload file kontrak

### 3. **Jadwal Maintenance**

-   Penjadwalan teknisi
-   Status: scheduled, on progress, completed
-   Catatan dan laporan maintenance

### 4. **Manajemen Invoice**

-   Membuat invoice otomatis/manual
-   Status pembayaran: unpaid, paid, overdue
-   Export ke PDF

### 5. **Dashboard**

-   Monitoring klien
-   Kontrak hampir habis
-   Invoice belum dibayar
-   Jadwal maintenance

------------------------------------------------------------------------

## 🔒 Role User

-   **Super Admin** -- akses penuh
-   **Admin** -- kelola klien, kontrak, invoice, maintenance
-   **Finance** -- fokus pada invoice dan pembayaran
-   **Teknisi** -- melihat jadwal maintenance & input laporan

------------------------------------------------------------------------

## 🚀 Teknologi yang Digunakan

-   Laravel 12
-   PHP 8+
-   MySQL / MariaDB
-   Spatie Laravel Permission
-   DomPDF / Snappy PDF

------------------------------------------------------------------------

## 🤝 Workflow Kolaborasi (GitHub)

### Branch Structure:

-   `main` → branch utama & stable
-   `develop` → branch kerja utama
-   `feature/...` → branch per fitur

### Cara Bekerja:

1.  Checkout branch develop

    ``` bash
    git checkout develop
    git pull origin develop
    ```

2.  Membuat branch fitur

    ``` bash
    git checkout -b feature/nama-fitur
    ```

3.  Commit & push

    ``` bash
    git add .
    git commit -m "Deskripsi perubahan"
    git push origin feature/nama-fitur
    ```

4.  Buat **Pull Request** ke `develop`\

5.  Merge dilakukan oleh repo owner

------------------------------------------------------------------------

## 📄 Lisensi

Project ini dibuat untuk keperluan pembelajaran dan pengembangan sistem.
Bebas digunakan selama mencantumkan kredit kepada pembuatnya.

------------------------------------------------------------------------
