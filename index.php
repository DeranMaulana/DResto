<?php
session_start();
include "koneksi.php";
?>


<!doctype html>
<html lang="en">

<head>
	<title>Login - DResto</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="Aset/Gambar/DR4.png" rel="icon">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style.css">

</head>

<body>
	<!-- Button trigger modal -->


<!-- Modal -->

	<section class="ftco-section">
		<div class="container mx-auto">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex align-middle mt-5">
						<div class="img" style="background-image: url(Aset/Gambar/DR4.png);">
						</div>
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100">
								<?php
							if (isset($_GET['pesan'])) {
								if ($_GET['pesan'] == "gagal") {
									echo "<div class='alert alert-danger' role='alert'>
									Username atau Password salah !
								  </div>";
								} else if ($_GET['pesan'] == "logout") {
									echo "Anda telah berhasil logout";
								} else if ($_GET['pesan'] == "belum_login") {
									echo "Anda harus login untuk mengakses halaman admin";
								}
							}
						?>
									<h3 class="mb-4">Login DResto</h3>
								</div>
							</div>
							<form action="cek_login.php" method="POST">
								<div class="form-group mb-3">
									<label class="label" for="username">ID Pegawai</label>
									<input type="text" name="id_pegawai" class="form-control" placeholder="ID Pegawai" required>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="password">Password</label>
									<input type="password" name="password" class="form-control" placeholder="Password" required>
								</div>
								<div class="form-group">
									<button type="submit" name="submit" class="form-control btn btn-primary rounded submit px-3"
										value="LOGIN" data-bs-toggle="modal" data-bs-target="#exampleModal">Login</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>