<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include('../koneksi.php');

if (isset($_POST['submit'])) {
    $nama_pegawai = $_POST['nama_pegawai'];
    $bagian = $_POST['bagian'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat_pegawai = $_POST['alamat_pegawai'];
    $telepon_pegawai = $_POST['telepon_pegawai'];
    $password = $_POST['password'];

    $query = "INSERT INTO pegawai (nama_pegawai, jenis_kelamin, alamat_pegawai, telepon_pegawai, bagian, password) VALUES ('$nama_pegawai', '$jenis_kelamin', '$alamat_pegawai', '$telepon_pegawai', '$bagian', '$password')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Penambahan Data Pegawai Berhasil ');window.location='pegawai.php';</script>";
    } else {
        echo "<script>alert('Data gagal ditambahkan');</script>";
    }
}
?>
