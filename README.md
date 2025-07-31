# Google n' GitHub OAuth Login dengan Jetstream

Login menggunakan akun **GitHub** di Laravel 12, terintegrasi dengan **Jetstream**, **Tailwind CSS**, dan **Livewire**, menggunakan **Laravel Socialite**.

---

## ⚙️ Setup & Konfigurasi

### 1. Database
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=oauth_test
DB_USERNAME=root  
DB_PASSWORD=
```

### 2. Google OAuth
```env
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/oauth/google/callback
```

### 3. Github OAuth
```env
GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_REDIRECT_URI="http://127.0.0.1:8000/auth/github/callback"
```

### 4. Instalasi Jetstream
```bash
composer require laravel/jetstream
php artisan jetstream:install livewire
php artisan migrate
```

### 5. Instalasi Socialite
```bash
composer require laravel/socialite
```

### 6. Run
```bash
php artisan serve
npm i && npm run dev
```

