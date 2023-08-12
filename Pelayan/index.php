<?php
session_start();

include('../koneksi.php');

$conn = mysqli_connect('localhost', 'root', '', 'dresto');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemesanan</title>
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
          <a class="nav-link" aria-current="page" href="meja.php">Meja</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="pesan.php">Pesan</a>
        </li>
      </ul>
      <span class="navbar-text">
        <?php echo $_SESSION['nama_pegawai']; ?> - <?php echo $_SESSION['bagian']; ?>
        <a href="../logout.php" class="btn btn-danger text-white">Logout</a>
      </span>
    </div>
  </div>
</nav>
<div class="container">
    <div class="card p-4 position-relative mt-3">
        <div class="d-flex justify-content-between">
            <h5>Informasi Meja</h5>
            <a href="pesan.php" class="btn btn-warning text-white">Ubah</a>
        </div>
        <!-- The HTML form (form2.php) -->
        <div class="row">
  <div class="col mt-2">
    <label for="">No Meja</label>
    <input readonly type="text" name="no_meja" class="form-control" value="<?= isset($_SESSION["nomeja"]) ? $_SESSION["nomeja"] : ""; ?>">
  </div>
</div>
<div class="row">
  <div class="col mt-2">
    <label for="">kapasitas</label>
    <?php
      $query = "select kapasitas from meja where no_meja = {$_SESSION['nomeja']}";
      $data = mysqli_query($conn,$query);
      while($row = mysqli_fetch_assoc($data)) {
        echo "<input readonly type='text' name='kapasitas' class='form-control' value='" . $row['kapasitas'] . "'>";
      }
    ?>
  </div>
</div>
    </div>



    <?php
    if (!$conn) {
      die ("Koneksi gagal. " . mysqli_connect_error()); // close koneksi
    }
  
    if (!isset($_GET['cari'])) {
      $query = mysqli_query($conn, "SELECT * FROM menu");
    } else {
      if ($_GET['cari'] == 'Makanan') {
          $query = mysqli_query($conn, "SELECT * FROM menu where kategori_menu = 'Makanan'");
      }else {
          $query = mysqli_query($conn, "SELECT * FROM menu where kategori_menu = 'Minuman'");
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
    
<div class="card mt-2">
<div class="container mt-5" name="daftar-menu" id="daftar-menu">
    <?php require_once 'keranjang.php'; ?>
    <div class="row mb-2">
        <div class="col">
          <h4>Daftar Menu</h4>
        </div>
        <div class="col">
            <form class="form-inline pull-right" action="" method="GET">
            <div class="form-group">
                <select class="form-select" name="cari" id="">
                    <option value="" disabled selected hidden>Kategori</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success mb-2">Cari</button>
            </form>
        </div>
    </div>


      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Menu</th>
            <th scope="col">Harga</th>
            <th scope="col">Kategori</th>
            <th scope="col">Stok</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $no = 1;
          while ($dt = $query->fetch_assoc()) :
            ?>

            <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
              <input type="hidden" name="kode_menu" value="<?= $dt['kode_menu']; ?>"></input>
              <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $dt['nama_menu']; ?></td>
                <td><?= $dt['harga']; ?></td>
                <td><?= $dt['kategori_menu']; ?></td>
                <td><?= $dt['stok']; ?></td>
                <td width="106">
                <input class="form-control form-control-sm" type="number" name="jumlah" value="1" min="1" max="<?= $dt['stok']; ?>"></td>
                  <td>
                    <button class="btn btn-primary btn-sm" type="submit" name="submit">
                      Pilih
                    </button>
                  </td>
                </tr>
          </form>

            <?php endwhile; ?>

          </tbody>
        </table>
        
      </div>
</div>
      
    <!-- Add jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Add the JavaScript code -->
<script>
    $(document).ready(function() {
        // Initially hide the "Daftar Produk" content
        $('daftar-menu').hide();

        // Add an event listener to the "Daftar Meja" dropdown menu
        $('meja').on('change', function() {
            // Check if a valid option has been selected
            if ($(this).val()) {
                // Show the "Daftar Produk" content
                $('daftar-menu').show();
            } else {
                // Hide the "Daftar Produk" content
                $('daftar-menu').hide();
            }
        });
    });
</script>

  </body>
</html>