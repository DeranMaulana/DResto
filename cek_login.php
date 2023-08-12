<?php
// Start session
session_start();

// Include database connection
include 'koneksi.php';

// Check if form was submitted
if (isset($_POST['submit'])) {
  // Get id_pegawai and password from form submission
  $id_pegawai = $_POST['id_pegawai'];
  $password = $_POST['password'];
  if ($id_pegawai == 'Admin' && $password == 'solidsolidsolid') {
    header("Location: Admin/menu.php");
  }else {
    // Check if id_pegawai and password are correct
  $query = "SELECT * FROM pegawai WHERE id_pegawai='$id_pegawai' AND password='$password'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    // Login successful
    $row = mysqli_fetch_assoc($result);
    $_SESSION['id_pegawai'] = $row['id_pegawai'];
    $_SESSION['nama_pegawai'] = $row['nama_pegawai'];
    $_SESSION['bagian'] = $row['bagian'];

    // Redirect user based on bagian
    if ($row['bagian'] == 'Kasir') {
      header("Location: Kasir/index.php");
    } elseif ($row['bagian'] == 'Pelayan') {
      header("Location: Pelayan/meja.php");
    } elseif ($row['bagian'] == 'Dapur') {
      header("Location: Dapur/menu_baru.php");
    } else {
      header("Location: index.php");
    }
  } else {
    // Login failed
    header("Location: index.php?pesan=gagal");
  }
  }
}
?>
