<?php
// Include file koneksi.php
include 'koneksi.php';

// Query untuk mengambil data pengguna dari tabel 'user'
$sql = "SELECT * FROM user";
$result = mysqli_query($connection, $sql);

// Array kosong untuk menampung data pengguna
$users = array();

// Periksa apakah ada data yang dikembalikan
if (mysqli_num_rows($result) > 0) {
    // Loop untuk menambahkan setiap pengguna ke dalam array
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}

// Mengonversi array data pengguna ke dalam format JSON
echo json_encode($users);

// Tutup koneksi database
mysqli_close($connection);
?>
