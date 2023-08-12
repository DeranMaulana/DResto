<?php


// menghubungkan dengan koneksi
include '../koneksi.php';

$query = "DELETE FROM pegawai WHERE id_pegawai = '". $_GET['id_pegawai'] . "'";
$result = mysqli_query($conn, $query);

if (!$result) {
  die("Hapus Gagal!: " . mysqli_errno($conn) .
    " - " . mysqli_error($conn));
} else {
  //tampil alert dan akan redirect ke halaman index.php
  //silahkan ganti index.php sesuai halaman yang akan dituju
  echo "<script>alert('Data Berhasil di Hapus.');window.location='pegawai.php';</script>";
}

?>