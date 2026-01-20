# Portfolio

Website portfolio pribadi dengan CMS (Content Management System) berbasis Laravel dan Filament. Memungkinkan pemilik untuk mengelola seluruh konten website melalui panel admin yang user-friendly.

---

## 🇮🇩 Bahasa Indonesia

### 📋 Deskripsi

Portfolio adalah website personal yang menampilkan profil, keahlian, pengalaman, dan proyek. Dilengkapi dengan panel admin untuk mengelola semua konten tanpa perlu coding.

### 🛠️ Tech Stack

| Teknologi    | Versi | Keterangan          |
| ------------ | ----- | ------------------- |
| PHP          | 8.2+  | Bahasa pemrograman  |
| Laravel      | 12.x  | Framework PHP       |
| Filament     | 4.x   | Admin Panel         |
| Livewire     | 3.x   | Reactive Components |
| MySQL        | 8.0+  | Database            |
| Tailwind CSS | 3.x   | CSS Framework       |
| Vite         | 6.x   | Build Tool          |
| TimelineJS   | 3.x   | Timeline Experience |
| SweetAlert2  | 11.x  | Alert/Notification  |

### 📦 Requirements

-   PHP >= 8.2
-   Composer
-   Node.js >= 18
-   NPM
-   MySQL/MariaDB
-   Laragon/XAMPP (untuk lokal)

**PHP Extensions yang dibutuhkan:**

-   BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, cURL, GD/Imagick

### 📄 Halaman & Fitur

#### Frontend (Publik)

| Halaman          | Deskripsi                                                   |
| ---------------- | ----------------------------------------------------------- |
| **Hero**         | Section utama dengan foto, nama, deskripsi, dan tombol aksi |
| **About**        | Tentang saya dengan daftar item (pendidikan, hobi, dll)     |
| **Sekolah**      | Riwayat sekolah                                             |
| **Skills**       | Keahlian dengan icon/emoji dan animasi marquee              |
| **Experience**   | Pengalaman kerja/organisasi dengan timeline interaktif      |
| **Projects**     | Daftar proyek dengan detail, galeri, dan tags               |
| **Contact**      | Form kontak dengan notifikasi email                         |
| **Social Media** | Link sosial media di section hero                           |

#### Admin Panel (`/admin`)

| Menu              | Deskripsi                                |
| ----------------- | ---------------------------------------- |
| **Dashboard**     | Halaman utama admin                      |
| **Site Settings** | Pengaturan website (nama, favicon, meta) |
| **Hero**          | Kelola section hero                      |
| **About**         | Kelola about dan item-itemnya            |
| **Skills**        | Kelola keahlian (icon/gambar/emoji)      |
| **Experiences**   | Kelola pengalaman kerja                  |
| **Projects**      | Kelola proyek dengan galeri              |
| **Contacts**      | Lihat pesan dari pengunjung              |
| **Social Media**  | Kelola link sosial media                 |
| **Edit Profile**  | Ubah nama, email, dan password admin     |

### 🚀 Cara Setup (Lokal)

#### 1. Clone Repository

```bash
git clone <repository-url>
cd portfolio
```

#### 2. Install Dependencies

```bash
composer install
npm install
```

#### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

#### 4. Konfigurasi Database

Edit file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=root
DB_PASSWORD=
```

#### 5. Konfigurasi Email (Opsional)

Untuk fitur contact form, edit `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=email@gmail.com
MAIL_PASSWORD=app-password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
MAIL_TO_ADDRESS=email-tujuan@gmail.com
```

#### 6. Migrasi Database

```bash
php artisan migrate
```

#### 7. Buat Storage Link

```bash
php artisan storage:link
```

#### 8. Buat Akun Admin

```bash
php artisan make:filament-user
```

Masukkan nama, email, dan password untuk admin.

#### 9. Jalankan Server

```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

#### 10. Akses Website

-   **Frontend:** http://127.0.0.1:8000
-   **Admin Panel:** http://127.0.0.1:8000/admin

---

## 🇬🇧 English

### 📋 Description

Portfolio is a personal website showcasing profile, skills, experience, and projects. Equipped with an admin panel to manage all content without coding.

### 🛠️ Tech Stack

| Technology   | Version | Description          |
| ------------ | ------- | -------------------- |
| PHP          | 8.2+    | Programming Language |
| Laravel      | 12.x    | PHP Framework        |
| Filament     | 4.x     | Admin Panel          |
| Livewire     | 3.x     | Reactive Components  |
| MySQL        | 8.0+    | Database             |
| Tailwind CSS | 3.x     | CSS Framework        |
| Vite         | 6.x     | Build Tool           |
| TimelineJS   | 3.x     | Timeline Experience  |
| SweetAlert2  | 11.x    | Alert/Notification   |

### 📦 Requirements

-   PHP >= 8.2
-   Composer
-   Node.js >= 18
-   NPM
-   MySQL/MariaDB
-   Laragon/XAMPP (for local)

**Required PHP Extensions:**

-   BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, cURL, GD/Imagick

### 📄 Pages & Features

#### Frontend (Public)

| Page             | Description                                                    |
| ---------------- | -------------------------------------------------------------- |
| **Hero**         | Main section with photo, name, description, and action buttons |
| **About**        | About me with item list (education, hobbies, etc)              |
| **Skills**       | Skills with icon/emoji and marquee animation                   |
| **Experience**   | Work/organization experience with interactive timeline         |
| **Projects**     | Project list with details, gallery, and tags                   |
| **Contact**      | Contact form with email notification                           |
| **Social Media** | Social media links in hero section                             |

#### Admin Panel (`/admin`)

| Menu              | Description                            |
| ----------------- | -------------------------------------- |
| **Dashboard**     | Admin main page                        |
| **Site Settings** | Website settings (name, favicon, meta) |
| **Hero**          | Manage hero section                    |
| **About**         | Manage about and its items             |
| **Skills**        | Manage skills (icon/image/emoji)       |
| **Experiences**   | Manage work experiences                |
| **Projects**      | Manage projects with gallery           |
| **Contacts**      | View messages from visitors            |
| **Social Media**  | Manage social media links              |
| **Edit Profile**  | Change admin name, email, and password |

### 🚀 Setup Guide (Local)

#### 1. Clone Repository

```bash
git clone <repository-url>
cd portfolio
```

#### 2. Install Dependencies

```bash
composer install
npm install
```

#### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

#### 4. Configure Database

Edit `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=root
DB_PASSWORD=
```

#### 5. Configure Email (Optional)

For contact form feature, edit `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=email@gmail.com
MAIL_PASSWORD=app-password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
MAIL_TO_ADDRESS=destination-email@gmail.com
```

#### 6. Run Migrations

```bash
php artisan migrate
```

#### 7. Create Storage Link

```bash
php artisan storage:link
```

#### 8. Create Admin Account

```bash
php artisan make:filament-user
```

Enter name, email, and password for admin.

#### 9. Run Server

```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

#### 10. Access Website

-   **Frontend:** http://127.0.0.1:8000
-   **Admin Panel:** http://127.0.0.1:8000/admin

---

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🙏 Credits

-   [Laravel](https://laravel.com) - PHP Framework
-   [Filament](https://filamentphp.com) - Admin Panel
-   [Livewire](https://livewire.laravel.com) - Reactive Components
-   [Tailwind CSS](https://tailwindcss.com) - CSS Framework
-   [TimelineJS](https://timeline.knightlab.com) - Timeline Library
-   [SweetAlert2](https://sweetalert2.github.io) - Alert Library
-   [Heroicons](https://heroicons.com) - Icons
