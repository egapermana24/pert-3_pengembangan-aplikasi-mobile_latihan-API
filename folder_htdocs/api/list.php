<?php
// Mengizinkan permintaan lintas sumber dari domain mana pun
header('Access-Control-Allow-Origin: *');

// Membuat koneksi ke database MySQL
$connection = new mysqli("localhost", "root", "", "produk");

// Mengirimkan permintaan SQL untuk mengambil data dari tabel 'tbl_produk'
$data = mysqli_query($connection, "SELECT * FROM tbl_produk");

// Membuat array kosong untuk menyimpan data yang akan dikirim sebagai respons JSON
$response = array();

// Memeriksa apakah permintaan ke database berhasil
if ($data) {
  // Melakukan loop untuk mengambil setiap baris data dari hasil permintaan
  while ($row = mysqli_fetch_assoc($data)) {
    // Tidak ada perubahan yang sebenarnya pada nilai 'foto'
    $row['foto'] = $row['foto'];

    // Menambahkan data (dalam bentuk array asosiatif) ke dalam array respons
    $response[] = $row;
  }
}

// Mengatur header HTTP untuk menunjukkan bahwa respons akan dalam format JSON
header('Content-Type: application/json');

// Mengonversi data dalam bentuk array menjadi format JSON dan mengirimkannya sebagai respons
echo json_encode(['data' => $response]);
