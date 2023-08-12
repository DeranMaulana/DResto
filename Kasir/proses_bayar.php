<?php
include "../koneksi.php";
session_start();
$id_pegawai = $_SESSION['id_pegawai'];
$kode_transaksi = $_POST['kode_transaksi'];
$bayar = $_POST['bayar'];
$kembalian = $_POST['kembalian'];



$query = "UPDATE transaksi SET bayar = $bayar, kembalian = $kembalian, id_pegawai='$id_pegawai', status='Beres' WHERE kode_transaksi = '$kode_transaksi'";
$result = mysqli_query($conn, $query);
// periska query apakah ada error
if (!$result) {
  die("Query gagal dijalankan: " . mysqli_errno($conn) .
  " - " . mysqli_error($conn));
} else {
  $query = "UPDATE meja JOIN transaksi ON meja.no_meja = transaksi.no_meja SET meja.status = 'Kosong' WHERE transaksi.kode_transaksi = '$kode_transaksi'";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($conn) .
    " - " . mysqli_error($conn));
}
  echo "<script>alert('Pembayaran Berhasil ');window.location='index.php';</script>";
}