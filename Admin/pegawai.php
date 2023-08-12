<?php
session_start();

include('../koneksi.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pegawai - Admin</title>
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
          <a class="nav-link active" href="pegawai.php">Pegawai</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="meja.php">Meja</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="riwayat_transaksi.php">Riwayat Transaksi</a>
        </li>
      </ul>
      <span class="navbar-text">
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
    $query = mysqli_query($conn, "SELECT * FROM pegawai");
  } else {
    $query = mysqli_query($conn, "SELECT * FROM pegawai WHERE nama_pegawai LIKE '%" . $_GET['cari'] . "%'");
  }
  if (isset($_GET['reset'])) {
    $query = mysqli_query($conn, "SELECT * FROM pegawai");


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
    <div class="position-relative">
      <div class="d-flex justify-content-between mt-2">
          <a href="tambah_pegawai.php" class="btn btn-primary mb-2">Tambah Pegawai</a>
          <button type="submit" class="btn btn-warning mb-2" name="reset">Reset Pencarian</button>
      </div>
    </div>
</form>


     <div class="card mt-3">
     <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            
            <th scope="col">ID Pegawai</th>
            <th scope="col">Nama Pegawai</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Alamat Pegawai</th>
            <th scope="col">No HP Pegawai</th>
            <th scope="col">Bagian</th>
            <th scope="col">Password</th>
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
    <td><?= $dt['id_pegawai']; ?></td>
    <td><?= $dt['nama_pegawai']; ?></td>
    <td><?= $dt['jenis_kelamin']; ?></td>
    <td><?= $dt['alamat_pegawai']; ?></td>
    <td><?= $dt['telepon_pegawai']; ?></td>
    <td><?= $dt['bagian']; ?></td>
    <td><?= $dt['password']; ?></td>

    <td class="text-center">
      <input type="hidden" name="id_pegawai" value="<?= $dt['id_pegawai']; ?>">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-success btn-sm btn-ubah" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ubah
</button>
<button data-id="<?= $dt['id_pegawai']; ?>" class="btn btn-danger btn-sm btn-hapus">Hapus</button>

<script>
  // Find all "Hapus" buttons
  var hapusButtons = document.querySelectorAll('.btn-hapus');

  // Add an event listener to each "Hapus" button
  hapusButtons.forEach(function (button) {
    button.addEventListener('click', function (event) {
      // Prevent the default action of the button
      event.preventDefault();

      // Get the ID of the data to be deleted from the button's data-id attribute
      var id = button.getAttribute('data-id');

      // Display a confirmation prompt
      var confirmed = confirm('Apakah Anda yakin ingin menghapus data dengan ID Pegawai ' + id + '?');

      // If the user confirms, delete the data
      if (confirmed) {
        // Redirect to the hapus_pegawai.php script with the id parameter
        window.location.href = 'hapus_pegawai.php?id_pegawai=' + id;
      }
    });
  });
</script>

            
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Pegawai</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="ubah_pegawai.php" method="post">
      <div class="modal-body">
        <table>
          <tr>
            <td>ID Pegawai </td>
            <td> </td>
            <td><input type="text" class="form-control" value="" readonly name="id_pegawai"></td>
          </tr>
          <tr>
            <td>Nama Pegawai </td>
            <td> </td>
            <td><input type="text" class="form-control" name="nama_pegawai"></td>
          </tr>
          <tr>
            <td>Jenis Kelamin </td>
            <td> </td>
            <td><input type="text" class="form-control" value="" readonly></td>
          </tr>
            <tr>
              <td>Alamat Pegawai </td>
              <td> </td>
              <td><input type="text" class="form-control" name="alamat_pegawai"></td>
            </tr>
            <tr>
              <td>No HP Pegawai </td>
              <td> </td>
              <td><input type="number" class="form-control" name="telepon_pegawai"></td>
            </tr>
            <tr>
              <td>Bagian </td>
              <td> </td>
              <td><input type="text" class="form-control" readonly></td>
            </tr>
            <tr>
              <td>Password </td>
              <td> </td>
              <td><input type="text" class="form-control" name="password"></td>
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
    var idPegawaiInput = document.querySelector('#exampleModal tr:nth-child(1) input[type="text"]');
    var namaPegawaiInput = document.querySelector('#exampleModal tr:nth-child(2) input[type="text"]');
    var jenisKelaminInput = document.querySelector('#exampleModal tr:nth-child(3) input[type="text"]');
    var alamatPegawaiInput = document.querySelector('#exampleModal tr:nth-child(4) input[type="text"]');
    var noHpPegawaiInput = document.querySelector('#exampleModal tr:nth-child(5) input[type="number"]');
    var bagianInput = document.querySelector('#exampleModal tr:nth-child(6) input[type="text"]');
    var passwordInput = document.querySelector('#exampleModal tr:nth-child(7) input[type="text"]');

    // Find the values from the corresponding data row
    var row = button.closest('tr');
    var idPegawai = row.querySelector('td:nth-child(1)').textContent;
    var namaPegawai = row.querySelector('td:nth-child(2)').textContent;
    var jenisKelamin = row.querySelector('td:nth-child(3)').textContent;
    var alamatPegawai = row.querySelector('td:nth-child(4)').textContent;
    var noHpPegawai = row.querySelector('td:nth-child(5)').textContent;
    var bagian = row.querySelector('td:nth-child(6)').textContent;
    var password = row.querySelector('td:nth-child(7)').textContent;

    // Set the values of the input elements in the modal
    idPegawaiInput.value = idPegawai;
    namaPegawaiInput.value = namaPegawai;
    jenisKelaminInput.value = jenisKelamin;
    alamatPegawaiInput.value = alamatPegawai;
    noHpPegawaiInput.value = noHpPegawai;
    bagianInput.value = bagian;
    passwordInput.value = password;
  });
});





</script>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>