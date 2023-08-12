<?php
session_start();

include('../koneksi.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu</title>
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
          <a class="nav-link active" aria-current="page" href="menu.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="menu_baru.php">Baru</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu_proses.php">Proses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu_selesai.php">Selesai</a>
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
    <div class="card position-relative">
    <div class="row mt-2 justify-content-between">
        <div class="col">
          <h4>Daftar Menu</h4>
        </div>
        <div class="col">
            <form class="form-inline pull-right" action="" method="GET">
            <div class="form-group">
                <input type="text" name="cari" id="" class="form-control" placeholder="Cari Nama Menu">
            </div>
        </div>
        <div class="col-1">
        <button type="submit" class="btn btn-success mb-2">Cari</button>
            </form>
        </div>
    </div>
    </div>
  <?php

$conn = mysqli_connect('localhost', 'root', '', 'dresto');

if (!$conn) {
    die ("Koneksi gagal. " . mysqli_connect_error()); // close koneksi
  }

  if (!isset($_GET['cari'])) {
    $query = mysqli_query($conn, "SELECT * FROM menu");
  } else {
    $query = mysqli_query($conn, "SELECT * FROM menu WHERE nama_menu LIKE '%" . $_GET['cari'] . "%'");
  }
  if (isset($_GET['reset'])) {
    $query = mysqli_query($conn, "SELECT * FROM menu");


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
<form class="" action="" method="GET">
    <div class="row mt-2">
        <div class="col">
        <button type="submit" class="btn btn-warning mb-2" name="reset">Reset</button>
        </div>
  </div>
</form>


     <div class="card mt-3">
     <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            
            <th scope="col">Kode Menu</th>
            <th scope="col">Nama Menu</th>
            <th scope="col">Kategori Menu</th>
            <th scope="col">Harga</th>
            <th scope="col">Stok</th>
            <th class="text-center" scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $no = 1;
          while ($dt = $query->fetch_assoc()) :
            ?>

<form method="POST" action="">
  <tr>
    <td><?= $dt['kode_menu']; ?></td>
    <td><?= $dt['nama_menu']; ?></td>
    <td><?= $dt['kategori_menu']; ?></td>
    <td><?= $dt['harga']; ?></td>
    <td><?= $dt['stok']; ?></td>

    <td class="text-center">
      <input type="hidden" name="kode_menu" value="<?= $dt['kode_menu']; ?>">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-success btn-sm btn-ubah" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ubah
</button>
            
          </td>
  </form>

            <?php endwhile; ?>

          </tbody>
        </table>
     </div>
        
      </div>
      <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Stok Menu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="ubah_stok.php" method="post">
      <div class="modal-body">
        <table>
          <tr>
            <td>Kode Menu </td>
            <td> </td>
            <td><input type="text" class="form-control" value="" readonly name="kode_menu"></td>
          </tr>
          <tr>
            <td>Nama Menu </td>
            <td> </td>
            <td><input type="text" class="form-control" value="" readonly></td>
          </tr>
          <tr>
            <td>Kategori </td>
            <td> </td>
            <td><input type="text" class="form-control" value="" readonly></td>
          </tr>
            <tr>
              <td>Harga </td>
              <td> </td>
              <td><input type="text" class="form-control" readonly></td>
            </tr>
            <tr>
              <td>Stok </td>
              <td> </td>
              <td><input type="number" class="form-control" name="stok"></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-success btn-sm" type="submit" name="submit">
            Simpan
        </button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
 // Find all "Ubah" buttons
var ubahButtons = document.querySelectorAll('.btn-ubah');

// Add an event listener to each "Ubah" button
ubahButtons.forEach(function (button) {
  button.addEventListener('click', function () {
    // Find the input elements in the modal
    var kodeMenuInput = document.querySelector('#exampleModal tr:nth-child(1) input[type="text"]');
    var namaMenuInput = document.querySelector('#exampleModal tr:nth-child(2) input[type="text"]');
    var kategoriInput = document.querySelector('#exampleModal tr:nth-child(3) input[type="text"]');
    var hargaInput = document.querySelector('#exampleModal tr:nth-child(4) input[type="text"]');
    var stokInput = document.querySelector('#exampleModal tr:nth-child(5) input[type="number"]');

    // Find the values from the corresponding data row
    var row = button.closest('tr');
    var kodeMenu = row.querySelector('td:nth-child(1)').textContent;
    var namaMenu = row.querySelector('td:nth-child(2)').textContent;
    var kategori = row.querySelector('td:nth-child(3)').textContent;
    var harga = row.querySelector('td:nth-child(4)').textContent;
    var stok = row.querySelector('td:nth-child(5)').textContent;

    // Set the values of the input elements in the modal
    kodeMenuInput.value = kodeMenu;
    namaMenuInput.value = namaMenu;
    kategoriInput.value = kategori;
    hargaInput.value = harga;
    stokInput.value = stok;
  });
});




</script>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>