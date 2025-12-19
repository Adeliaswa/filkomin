
# 📜 **FILKOMIN — Aplikasi Undangan Online Khusus Filkom UB** (Laravel Web App)

**FILKOMIN** adalah aplikasi web berbasis Laravel yang dirancang khusus untuk mendukung pengelolaan acara di lingkungan Fakultas Ilmu Komputer Universitas Brawijaya. Aplikasi ini memungkinkan admin dan event organizer membuat undangan secara terstruktur, memilih template undangan, mengatur detail acara seperti waktu, lokasi, dan dresscode, serta mengelola daftar tamu dengan mudah.  

## **🔑 Demo Login Accounts**
Untuk memudahkan pengujian, gunakan akun berikut:

### **👤 Login sebagai Event Organizer**
#### 1. **Login sebagai Dosen**
* Email: dosen@filkom.ac.id
#### 2. **Login sebagai DPM**
* Email: dpm@filkom.ac.id
#### 3. **Login sebagai BEM**
* Email: bem@filkom.ac.id
#### 4. **Login sebagai POROS**
* Email: poros@filkom.ac.id
#### 5. **Login sebagai BCC**
* Email: bcc@filkom.ac.id
#### 6. **Login sebagai KEPANITIAAN**
* Email: kepanitiaan@filkom.ac.id

`Catatan: Seluruh akun Event Organizer menggunakan password yang sama, yaitu password, dan disediakan khusus untuk keperluan demo dan pengujian sistem.`
  
### **🛠️ Login sebagai Admin**
#### 1. **Login sebagai Phia**
* Email: admin@filkom.ac.id
#### 2. **Login sebagai Ael**
* Email: admin2@filkom.ac.id
#### 3. **Login sebagai Yupi**
* Email: admin3@filkom.ac.id

`Catatan: Seluruh akun Admin menggunakan password yang sama, yaitu password, dan disediakan khusus untuk keperluan demo dan pengujian sistem.`

---

## **Fitur Utama**

### 1. **Autentikasi Pengguna**

* Fitur **login** dan **registrasi** untuk pengguna dengan validasi form sebagai **admin** atau **event organizer**.
* Notifikasi sukses atau gagal untuk setiap operasi autentikasi.
* 🔒Tamu undangan tidak perlu login, cukup mengakses undangan melalui link yang terkirim di WhatsApp

### 2. **Manajemen Profile**

* **Admin** dan **event organizer** dapat mengelola data prodil masing-masing melalui menu **Profile**.

### 3. **Logout**

* Admin dan event organizer dapat **logout** dari sistem melalui menu logout di aplikasi.

---

## **Fitur Untuk Tamu Undangan**

### 1. **Akses Undangan Digital**

* Tamu dapat menerima undangan secara otomatis melalui WhatsApp dalam bentuk link atau file PDF.
* Informasi yang ditampilkan meliputi detail acara, lokasi, waktu, dan dresscode.

### 2. **RSVP (Konfirmasi Kehadiran)**

* Tamu dapat mengonfirmasi kehadiran **(hadir/ tidak hadir)** langsung dari halaman undangan.
* Data RSVP tersimpan otomatis dan dapat dipantau oleh admin/EO.

### 3. **QR Code Akses Undangan**

* Setiap tamu undangan memiliki **QR Code unik** yang terhubung langsung ke halaman undangan digital.
* QR Code berfungsi sebagai media akses cepat ke undangan tanpa memerlukan proses login.
* Melalui halaman undangan tersebut, tamu dapat melihat detail acara serta melakukan konfirmasi kehadiran (RSVP).
* Fitur ini mempermudah distribusi undangan dan meningkatkan aksesibilitas informasi acara.

---

## **Fitur Untuk Event Organizer (EO)**

### 1. **Pengelolaan Konten Event**

* EO bertanggung jawab untuk memastikan seluruh informasi event yang dikelola **akurat, lengkap, dan selalu diperbarui** sebelum dipublikasikan.

### 2. **Pengelolaan Data Event**

* EO dapat **membuat, mengedit, dan menghapus** data event yang mereka selenggarakan langsung melalui sistem.
* Data event yang dikelola meliputi judul acara, deskripsi, jadwal, lokasi, dresscode, dan informasi pendukung lainnya.
* Setiap event yang dibuat atau diperbarui oleh EO akan melalui proses validasi dan persetujuan admin sebelum dapat dipublikasikan di website.

---

## **Fitur Untuk Admin (Website Administrator)**

### 1. **Manajemen Dashboard Website**

* Admin mengelola seluruh konten website melalui dashboard, termasuk melakukan peninjauan, pengeditan, dan penghapusan data event.
* Konten event yang ditampilkan di website berasal dari data yang dikelola oleh EO melalui sistem dan telah melalui proses validasi admin.

### 2. **Manajemen Pengguna dan Akses**

* Admin mengelola akun pengguna, peran, dan hak akses dalam sistem.

### 3. **Publikasi & Monitoring Sistem**

* Admin melakukan proses publikasi event agar dapat diakses oleh tamu undangan.
* Admin memantau stabilitas sistem, bug, dan error pada website.
* Admin memastikan seluruh data undangan, RSVP, dan kehadiran tampil dengan benar dan berjalan sesuai fungsinya.

---

## **Teknologi & Arsitektur (ᵕ—ᴗ—)**

* **Laravel Framework** (MVC Architecture)
* **MySQL/MariaDB** (Relational Database)
* **Blade Template Engine** untuk tampilan antarmuka pengguna.
* **Tailwind CSS** untuk styling.
* **Vite** untuk build tools dan pengolahan aset frontend.

---

## **Instalasi & Setup ( ꩜ ᯅ ꩜;)⁭ ⁭**

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan aplikasi:

Untuk membuat database di **DBeaver** (MySQL), ikuti langkah-langkah berikut:

1. **Install DBeaver**:

   * Jika Anda belum menginstal **DBeaver**, unduh dan install dari [situs resmi DBeaver](https://dbeaver.io/download/).

2. **Buat Koneksi ke MySQL**:

   * Buka DBeaver dan klik pada ikon **New Database Connection** di toolbar.
   * Pilih **MySQL** (atau **MariaDB**, tergantung pada jenis database yang digunakan) dan klik **Next**.
   * Masukkan detail koneksi database Anda (hostname, port, username, password, dll.). Untuk lokal, biasanya pengaturan seperti berikut:

     * **Host**: `127.0.0.1`
     * **Port**: `3306` (default untuk MySQL)
     * **Username**: `root` (atau username lainnya)
     * **Password**: (password MySQL Anda)

3. **Buat Database**:

   * Setelah berhasil terkoneksi, klik kanan pada koneksi MySQL Anda di panel kiri dan pilih **SQL Editor**.
   * Jalankan query berikut untuk membuat database **filkomin**:

     ```sql
     CREATE DATABASE filkomin;
     ```

4. **Verifikasi Database**:

   * Pastikan database **filkomin** sudah muncul di panel kiri, di bawah koneksi yang telah dibuat.


Setelah database siap, konfigurasikan aplikasi Laravel agar dapat terhubung ke database **filkomin**:

5. **Duplikat File `.env.example` menjadi `.env`**:

   ```bash
   cp .env.example .env
   ```

6. **Edit File `.env`**:

   * Buka file `.env` dan sesuaikan pengaturan database sebagai berikut:

     ```env
     DB_CONNECTION=mysql
     DB_HOST=
     DB_PORT=
     DB_DATABASE=filkomin
     DB_USERNAME=
     DB_PASSWORD=
     ```
7. **Instalasi Dependencies:**:

   ```bash
   composer install
   npm install && npm run build
   ```
   
8. **Generate Application Key**:

   ```bash
   php artisan key:generate
   ```

9. **Migrasi Database**:

   * Jalankan migrasi untuk membuat struktur tabel yang diperlukan di database:

     ```bash
     php artisan migrate:fresh --seed
     ```

Setelah semua pengaturan selesai, jalankan aplikasi Laravel di server lokal Anda:

```bash
php artisan serve
```

Aplikasi dapat diakses melalui [http://127.0.0.1:8000/](http://127.0.0.1:8000/).

---

## **Fitur Pengembangan ᕙ(  •̀ ᗜ •́  )ᕗ**

* Penggunaan **pola MVC** untuk struktur kode yang rapi dan terorganisir.
* **Blade templating** untuk antarmuka pengguna yang modular.
* **Tailwind CSS** untuk desain responsif dan modern.
* Penggunaan **Vite** untuk pengelolaan aset frontend yang efisien.

## **Kontribusi ٩(ˊᗜˋ)و**

Kontribusi sangat terbuka! Silakan ikuti langkah-langkah berikut untuk berkontribusi dalam proyek ini:

1. **Fork repository**: Fork repositori ini ke akun GitHub Anda.
2. **Buat branch baru**:

   ```bash
   git checkout -b fitur-qr-undangan
   ```
3. **Buat perubahan**: Lakukan perubahan sesuai dengan fitur atau bug yang ingin Anda selesaikan.
4. **Commit perubahan**: Gunakan pesan commit yang sesuai dengan format **Conventional Commit**:

   ```bash
   git commit -m "feat(qr): tambah qr code akses undangan"
   ```
5. **Push ke repository**:

   ```bash
   git push origin fitur-qr-undangan
   ```
6. **Buat Pull Request**: Buat pull request di GitHub untuk menggabungkan perubahan ke branch utama.

### **Branching untuk Collaborative Work**

* Gunakan branch terpisah untuk setiap fitur atau perbaikan bug. Nama branch harus mengikuti konvensi:

  * `fitur/<nama-fitur>`
  * `bugfix/<nama-bug>`

### **Conventional Commit Message**

* Format pesan commit menggunakan format berikut:

  * `feat`: untuk penambahan fitur baru.
  * `fix`: untuk perbaikan bug.
  * `docs`: untuk perubahan dokumentasi.
  * `style`: untuk perubahan yang hanya mengubah styling (misal: format kode).
  * `refactor`: untuk perubahan kode yang tidak mempengaruhi fitur atau perbaikan bug.
  * `test`: untuk penambahan atau perubahan pengujian.

### **Pull Request & Merge**

* Setelah selesai membuat pull request, pastikan untuk memeriksa dan memastikan bahwa pull request memenuhi standar kualitas kode yang telah ditetapkan.
* Review pull request sebelum melakukan merge ke branch utama (`main`).

---

📩 **Kontak Developer**:

**ADELIA SWASTIKA DEWI**
* Instagram: [@d_do0lphin](https://instagram.com/d_do0lphin)
* Email: [adeliaswastikadewi@gmail.com](mailto:adeliaswastikadewi@gmail.com)
* LinkedIn: [linkedin.com/in/adeliaswastika](https://www.linkedin.com/in/adeliaswastika)
* GitHub: [github.com/Adeliaswa](https://github.com/Adeliaswa)

**DEVI ATIKA PUTRI**
* Instagram: [@de_phia02](https://instagram.com/de_phia02)
* Email: [viatika265@gmail.com](mailto:viatika265@gmail.com)
* LinkedIn: [linkedin.com/in/deviatika265](www.linkedin.com/in/deviatika265)
* GitHub: [github.com/viatika265](https://github.com/viatika265)

**NADHIFA FITRIYAH WADIATURABBI**
* Instagram: [@naadhfy](https://instagram.com/naadhfy)
* Email: [nadhifafitriyaah@gmail.com](mailto:nadhifafitriyaah@gmail.com)
* LinkedIn: [linkedin.com/in/nadhi-fa](www.linkedin.com/in/nadhi-fa)
* GiHub: [github.com/nadh-ifa](https://github.com/nadh-ifa)

📄 **Lisensi**:
Proyek ini dirilis dengan lisensi **Copyright © 2025 by Kelompok 5 PAW TI-A. (๑>؂•̀๑)**

---
