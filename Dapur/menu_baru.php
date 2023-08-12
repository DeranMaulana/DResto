<?php
session_start();

include('../koneksi.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu Baru</title>
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
          <a class="nav-link active" href="menu_baru.php">Baru</a>
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
<script>
    function checkForNewOrders() {
    // Send an AJAX request to the server to check for new orders
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Parse the response as a JSON object
            var orders = JSON.parse(this.responseText);

            // Check if there are any new orders
            if (orders.length > 0) {
                // Display a notification to the kitchen staff
                alert('Ada Pesanan yang harus harus dibuat');

                // Reload the page to display the new order
                location.reload();
            }
        }
    };
    xhr.open("GET", "cek_pesanan.php", true);
    xhr.send();
}

// Check for new orders every 5 seconds
setInterval(checkForNewOrders, 5000);


</script>
    <div class="container mt-5">
  <?php

$conn = mysqli_connect('localhost', 'root', '', 'dresto');

if (!$conn) {
    die ("Koneksi gagal. " . mysqli_connect_error()); // close koneksi
  }

  if (!isset($_GET['cari'])) {
    $query = mysqli_query($conn, "SELECT DISTINCT transaksi.* FROM transaksi JOIN meja ON transaksi.no_meja = meja.no_meja JOIN detail_transaksi ON transaksi.kode_transaksi = detail_transaksi.kode_transaksi WHERE meja.status='Terisi' AND transaksi.id_pegawai IS NULL AND detail_transaksi.status = 'Baru'");



  } else {
    if ($_GET['cari'] == '2 Orang') {
        $query = mysqli_query($conn, "SELECT * FROM meja where kapasitas = '2 Orang'");
    }elseif ($_GET['cari'] == '3 - 4 Orang') {
        $query = mysqli_query($conn, "SELECT * FROM meja where kapasitas = '3 - 4 Orang'");
    }else {
        $query = mysqli_query($conn, "SELECT * FROM meja where kapasitas = '5 - 6 Orang'");
    }
    
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

<form method="POST" action="proses.php">
  <tr>
    <td><?= $dt['kode_transaksi']; ?></td>
    <td><?= $dt['total_item']; ?></td>
    <td><?= $dt['subtotal']; ?></td>
    <td><?= $dt['no_meja']; ?></td>

    <td class="text-center">
      <input type="hidden" name="no_meja" value="<?= $dt['no_meja']; ?>">
      <!-- Button trigger modal -->

      <a href="detail_pesanan_baru.php?kode_transaksi=<?= $dt['kode_transaksi']; ?>" class="btn btn-warning btn-sm">Detail Pesanan</a>
            
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses_bayar.php" method="post">
      <div class="modal-body">
        <table>
          <tr>
            <td>Kode Transaksi </td>
            <td> </td>
            <td><input type="text" class="form-control" value="" readonly name="kode_transaksi"></td>
          </tr>
          <tr>
            <td>No Meja </td>
            <td> </td>
            <td><input type="text" class="form-control" value="" readonly></td>
          </tr>
          <tr>
            <td>Subtotal </td>
            <td> </td>
            <td><input type="text" class="form-control" value="" readonly></td>
          </tr>
            <tr>
              <td>Bayar </td>
              <td> </td>
              <td><input type="text" class="form-control" name="bayar"></td>
            </tr>
            <tr>
              <td>Kembalian </td>
              <td> </td>
              <td><input type="text" class="form-control" readonly name="kembalian"></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-success btn-sm" type="submit" name="submit">
          Bayar
        </button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  // Menemukan elemen-elemen input di dalam modal
var bayarInput = document.querySelector('#exampleModal tr:nth-child(4) input[type="text"]');
var subtotalInput = document.querySelector('#exampleModal tr:nth-child(3) input[type="text"]');
var kembalianInput = document.querySelector('#exampleModal tr:nth-child(5) input[type="text"]');

// Menambahkan event listener untuk input Bayar
bayarInput.addEventListener('input', function () {
  // Menghitung nilai kembalian
  var bayar = parseInt(bayarInput.value);
  var subtotal = parseInt(subtotalInput.value);
  var kembalian = bayar - subtotal;

  // Menampilkan nilai kembalian di dalam input Kembalian
  kembalianInput.value = kembalian;
});

</script>
<script>
// Find all "Bayar" buttons
var bayarButtons = document.querySelectorAll('.btn-success');

// Add an event listener to each "Bayar" button
bayarButtons.forEach(function (button) {
  button.addEventListener('click', function () {
    // Find the input elements in the modal
    var kodetransaksi = document.querySelector('#exampleModal tr:nth-child(1) input[type="text"]');
    var noMejaInput = document.querySelector('#exampleModal tr:nth-child(2) input[type="text"]');
    var subtotalInput = document.querySelector('#exampleModal tr:nth-child(3) input[type="text"]');

    // Find the values from the corresponding data row
    var row = button.closest('tr');
    var kode_transaksi = row.querySelector('td:nth-child(1)').textContent;
    var noMeja = row.querySelector('td:nth-child(4)').textContent;
    var subtotal = row.querySelector('td:nth-child(3)').textContent;

    // Set the values of the input elements in the modal
    kodetransaksi.value = kode_transaksi;
    noMejaInput.value = noMeja;
    subtotalInput.value = subtotal;
  });
});

</script>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>