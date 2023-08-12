<?php
include ("../koneksi.php");

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil nilai kondisi dari parameter GET
$condition = $_GET["condition"];

// Menjalankan query untuk mengambil data dari tabel 'myTable'
$sql = "SELECT kode_menu,nama_menu from menu WHERE kategori_menu = '$condition'"; // asumsikan kolom 'type' menyimpan informasi apakah itu makanan atau minuman
$result = $conn->query($sql);

// Menyimpan hasil query ke dalam array
$data = array();
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Mengirimkan data sebagai JSON ke client
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
