<?php


include('../koneksi.php');
// Destroy the cart session variable
unset($_SESSION['cart']);
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meja</title>
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
          <a class="nav-link active" aria-current="page" href="meja.php">Meja</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pesan.php">Pesan</a>
        </li>
      </ul>
      <span class="navbar-text">
        <?php echo $_SESSION['nama_pegawai']; ?> - <?php echo $_SESSION['bagian']; ?>
        <a href="../logout.php" class="btn btn-danger text-white">Logout</a>
      </span>
    </div>
  </div>
</nav>
    <?php


$conn = mysqli_connect('localhost', 'root', '', 'dresto');

if (!$conn) {
    die ("Koneksi gagal. " . mysqli_connect_error()); // close koneksi
  }

  if (!isset($_GET['cari'])) {
    $query = mysqli_query($conn, "SELECT * FROM meja");
  } else {
    if ($_GET['cari'] == '2 Orang') {
        $query = mysqli_query($conn, "SELECT * FROM meja where kapasitas = '2 Orang'");
    }elseif ($_GET['cari'] == '3 - 4 Orang') {
        $query = mysqli_query($conn, "SELECT * FROM meja where kapasitas = '3 - 4 Orang'");
    }else {
        $query = mysqli_query($conn, "SELECT * FROM meja where kapasitas = '5 - 6 Orang'");
    }
    
  }
  if (isset($_GET['reset'])) {
    $query = mysqli_query($conn, "SELECT * FROM meja");
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

    <div class="container mt-5">
    <div class="card position-relative">
    <div class="row mt-2 justify-content-between">
        <div class="col">
          <h4>Daftar Meja</h4>
        </div>
        <div class="col">
            <form class="form-inline pull-right" action="" method="GET">
            <div class="form-group">
                <select class="form-select" name="cari" id="">
                    <option value="" disabled selected hidden>kapasitas</option>
                    <option value="2 Orang">2 Orang</option>
                    <option value="3 - 4 Orang">3 - 4 Orang</option>
                    <option value="5 - 6 Orang">5 - 6 Orang</option>
                </select>
            </div>
        </div>
        <div class="col-1">
        <button type="submit" class="btn btn-success mb-2">Cari</button>
            </form>
        </div>
    </div>
    </div>
    <form class="" action="" method="GET">
    <div class="row mt-2">
        <div class="col">
        <button type="submit" class="btn btn-warning mb-2" name="reset">Reset</button>
        </div>
  </div>
</form>


     <div class="card mt-3">
     <table class="table">
        <thead class="thead-light">
          <tr>
            
            <th scope="col">Nomor Meja</th>
            <th scope="col">kapasitas</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $no = 1;
          while ($dt = $query->fetch_assoc()) :
            ?>

<form method="POST" action="proses_meja.php">
  <tr>
    <td><?= $dt['no_meja']; ?></td>
    <td><?= $dt['kapasitas']; ?></td>
    <?php
    if ($dt['status'] == "Kosong") {
      echo '<td style="background-color:#42F560;">' . $dt['status'] . '</td>';
    } else {
      echo '<td style="background-color:#F55142;">' . $dt['status'] . '</td>';
    }
    ?>
    <td>
      <input type="hidden" name="no_meja" value="<?= $dt['no_meja']; ?>">
      <input type="hidden" name="status" value="<?= $dt['status']; ?>">
      <button class="btn btn-primary btn-sm" type="submit" name="submit">
        Pilih
      </button>
  </form>

            <?php endwhile; ?>

          </tbody>
        </table>
     </div>
        
      </div>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>