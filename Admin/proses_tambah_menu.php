<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include('../koneksi.php');

if (isset($_POST['submit'])) {
    $nama_menu = $_POST['nama_menu'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $query = "INSERT INTO menu (nama_menu, kategori_menu, harga, stok) VALUES ('$nama_menu', '$kategori', '$harga', '$stok')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Penambahan Data Menu Berhasil ');window.location='menu.php';</script>";
    } else {
        echo "<script>alert('Data gagal ditambahkan');</script>";
    }
}
?>
