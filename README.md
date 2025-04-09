langkah penginstallan :
1. Clone repositori ini:
   git clone https://github.com/krisnalavendrairawan/LaravelTest.git
   cd LaravelTest
2. Instal dependensi PHP:
   composer install
   npm install
3. Salin file .env.example menjadi .env:
   cp .env.example .env
4. Generate kunci aplikasi:
   php artisan key:generate

6. Konfigurasi database Anda di file .env:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel_product
    DB_USERNAME=root
    DB_PASSWORD=
7. Jalankan server lokal:
   php artisan serve

jika ada Error pada Bootstrap atau Yajra DataTables
Pastikan Anda telah menginstal dan mengkompilasi dependensi dengan benar. Jika mengalami masalah, coba:

npm install bootstrap@5
npm run dev

Dan untuk Yajra DataTables:

composer require yajra/laravel-datatables-oracle
php artisan vendor:publish --provider="Yajra\DataTables\DataTablesServiceProvider"


