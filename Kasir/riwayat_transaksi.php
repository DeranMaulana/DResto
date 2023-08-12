<?php
session_start();

include('../koneksi.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Transaksi</title>
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
            <a class="nav-link active" aria-current="page" href="index.php">Transaksi</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="riwayat_transaksi.php">Riwayat Transaksi</a>
            </li>
        </ul>
      <span class="navbar-text">
      <?php echo $_SESSION['nama_pegawai']; ?> - <?php echo $_SESSION['bagian']; ?>
        <a href="../logout.php" class="btn btn-danger text-white">Logout</a>
      </span>
    </div>
  </div>
</nav>
    <div class="container mt-5">
          <div class="row mb-2">
        <div class="col">
          <h4>Daftar Riwayat Transaksi</h4>
          <!-- The HTML form (form1.php) -->
<!-- your HTML form code goes here -->

  <?php

$conn = mysqli_connect('localhost', 'root', '', 'dresto');

if (!$conn) {
    die ("Koneksi gagal. " . mysqli_connect_error()); // close koneksi
  }

  if (!isset($_GET['cari'])) {
    $query = mysqli_query($conn, "SELECT *from transaksi where id_pegawai is not null");
  }
    if (isset($_SESSION['pesan'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              ' . $_SESSION['pesan'] . '
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>';

      unset($_SESSION['pesan']);
    }
    ?>


     <div class="card mt-3">
     <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            
            <th scope="col">Kode Transaksi</th>
            <th scope="col">Total Item</th>
            <th scope="col">Subtotal</th>
            <th scope="col">No Meja</th>
            <th class="text-center" scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $no = 1;
          while ($dt = $query->fetch_assoc()) :
            ?>

<form method="POST" action="proses_meja.php">
  <tr>
    <td><?= $dt['kode_transaksi']; ?></td>
    <td><?= $dt['total_item']; ?></td>
    <td><?= $dt['subtotal']; ?></td>
    <td><?= $dt['no_meja']; ?></td>

    <td class="text-center">
      <input type="hidden" name="no_meja" value="<?= $dt['no_meja']; ?>">
      <a href="detail_transaksi.php?kode_transaksi=<?= $dt['kode_transaksi']; ?>" class="btn btn-warning btn-sm">Detail Pesanan</a>
            
          </td>
  </form>

            <?php endwhile; ?>

          </tbody>
        </table>
     </div>
        
      </div>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>