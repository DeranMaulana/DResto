<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include('../koneksi.php');

if (isset($_POST['submit'])) {
    $no_meja = $_POST['no_meja'];
    $kapasitas = $_POST['kapasitas'];
    $status = 'Kosong';

    // Check if a row with the same no_meja already exists
    $query = "SELECT * FROM meja WHERE no_meja = '$no_meja'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        // A row with the same no_meja already exists
        echo "<script>alert('Nomor Meja sudah ada. Silahkan coba lagi.');window.location='tambah_meja.php';</script>";
    } else {
        // No row with the same no_meja exists, so we can insert the new row
        $query = "INSERT INTO meja (no_meja, kapasitas, status) VALUES ('$no_meja', '$kapasitas', '$status')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>alert('Penambahan Data Meja Berhasil ');window.location='meja.php';</script>";
        } else {
            echo "<script>alert('Data gagal ditambahkan');</script>";
        }
    }
}
?>
