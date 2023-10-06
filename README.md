Assalamualaikum wr.wb 
E-kasir merupakan aplikasi untuk memudahkan manajemen penjualan anda. E-kasir terdapat beberapa menu yaitu: manajemen pengeluaran, manajamen produk, kasir, serta laporan penjualan harian dan bulanan. Saya menggunakan framework codeigniter 4 untuk membuat aplikasi tersebut. Semoga dengan adanya aplikasi ini dapat memudahkan pekerjaan anda. Saya juga menggunakan database mysql untuk penyimpanan datanya. Berikut cara untuk mengimplementasikan aplikasi E-kasir ke laptop/pc anda:

Buat database dengan nama db_kasir
Import database yang ada ada di source project yang namanya db_kasir.sql
Copy folder project ke htdoc
Masuk ke folder app/Config/App.php Ubah port di $base_url sesuai port web service anda(karena saya menggunakan 8888 maka $base_url saya : http://localhost:8888/e-kasir, apabila anda menggunakan xampp dan port default maka ubah dengan: http://localhost:/e-kasir)
Masuk ke folder app/Config/Database.php Cari public $default dan sesuaikan username, password, port dengan database anda
Apabila sudah selesai semua tinggal jalankan aplikasi di browser anda
User admin: 
username: admin 
password: admin 
User kasir: 
username: user 
password: admin
