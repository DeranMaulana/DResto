<?php
include "../koneksi.php";

$kode_transaksi = $_POST['kode_transaksi'];
$kode_menu = $_POST['kode_menu'];
$kode_pegawai ="PGW001";
// Menjalankan query untuk mengambil data detail pesanan dari tabel 'order_details'
$sql = "SELECT * FROM menu WHERE kode_menu = '$kode_menu'";// contoh id pesanan
$result = $conn->query($sql);

// Menampilkan data detail pesanan
while($row = $result->fetch_assoc()) {
    echo '<h3>Detail Pesanan</h3>';
    echo '<form>';
    echo "Product ID: " . $row["kode_menu"] . "<br>";
    echo "Quantity: " . $row["nama_menu"] . "<br>";
    echo "Price: " . $row["harga"] . "<br>";
    echo "<hr>";
    echo '</form>';
}

$conn->close();
?>