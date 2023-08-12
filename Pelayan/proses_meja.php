<?php
include "../koneksi.php";

$no_meja = $_POST['no_meja'];
$status = $_POST['status'];

if ($status == 'Kosong') {
  $query = "UPDATE meja SET status = 'Terisi' WHERE no_meja = '$no_meja'";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
  } else {
    echo "<script>alert('Meja Berhasil di Isi');window.location='pesan.php';</script>";
  }
} else {
  echo "<script>alert('Status tidak dapat diubah karena sudah Terisi.');window.location='meja.php';</script>";
}
