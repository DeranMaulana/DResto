<?php
session_start();
include('../koneksi.php');
// Destroy the cart session variable
unset($_SESSION['cart']);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesan</title>
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
    <div class="container mt-5">
          <div class="row mb-2">
        <div class="col">
          <h4>Daftar Meja</h4>
          <!-- The HTML form (form1.php) -->
<!-- your HTML form code goes here -->

  <div class="form-group">
    <form method="post" action="">
    <select class="form-select mb-1" name="meja" id="meja">
      <option value="" disabled selected hidden>No Meja</option>
      <?php
      $query = "SELECT * FROM meja WHERE status = 'Terisi'";
      $result = mysqli_query($conn, $query);
      $_SESSION['nomeja'] = $data['no_meja'];
      while ($data = mysqli_fetch_array($result)) {
        echo '<option value="' . $data['no_meja'] . '">' . $data['no_meja'] . '</option>';
      }
      ?>
    </select>
    <button type="submit" class="btn btn-success mb-2" name="input">Pilih</button>
    </form>
  </div>

  <?php
  
// include your database connection and other necessary code here

if (isset($_POST['input'])) {
  if (!empty($_POST['meja'])) {
    $meja = $_POST['meja'];
    $_SESSION['nomeja'] = $meja;
    header('Location: index.php?meja=' . $_SESSION['nomeja']);
  } else {
    echo "<script>alert('Tidak ada NO Meja yang dipilih ');</script>";
  }
  exit;
}


?>
        </div>
    </div>
  </body>
</html>