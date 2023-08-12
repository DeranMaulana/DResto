<?php
session_start();
include('../koneksi.php');
if (!isset($_GET['kode_transaksi'])) {
    header('Location: index.php');
  }
  
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Transaksi - Admin</title>
    <link href="../Aset/Gambar/DR4.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">
      <img src="../Aset/Gambar/DR4.png" alt="Logo" width="35" height="35" class="d-inline-block align-text-top">
      DResto
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="menu.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pegawai.php">Pegawai</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="meja.php">Meja</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="riwayat_transaksi.php">Riwayat Transaksi</a>
        </li>
      </ul>
      <span class="navbar-text">
        <a href="../logout.php" class="btn btn-danger text-white">Logout</a>
      </span>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h4>Detail Pemesanan</h4>
  <br>
  
  <a href="riwayat_transaksi.php">
    <button class="btn btn-success btn-sm">
      <i class="fa fa-arrow-left"></i> Kembali
    </button>
  </a>

  <div class="card mt-4">
  <table class="table table-bordered">
    <thead align="center">
      <tr>
        <th>No</th>
        <th>Nama Menu</th>
        <th>Harga</th>
        <th>Jumlah Pembelian</th>
      </tr>
    </thead>
    <tbody>

    <?php
    $kode_transaksi = $_GET['kode_transaksi'];
    $query = mysqli_query($conn, "SELECT detail_transaksi.*, menu.nama_menu, menu.harga
    FROM detail_transaksi
    JOIN menu
    ON detail_transaksi.kode_menu = menu.kode_menu
    WHERE detail_transaksi.kode_transaksi = '$kode_transaksi'
    ");

    $no = 1;

    while($detail = $query->fetch_assoc()) :
    ?>

      <tr>
        <td align="center"><?= $no++; ?></td>
        <td><?= $detail['nama_menu']; ?></td>
        <td><?= $detail['harga']; ?></td>
        <td align="center"><?= $detail['jumlah']; ?></td>
      </tr>

    <?php endwhile; ?>

    </tbody>
  </table>
  </div>
</div>