<?php
// Connect to the database
include('../koneksi.php');

// Get the transaction code from the form data
$id_pegawai = $_POST['id_pegawai'];

// Set the new status to 'proses'
$nama_pegawai = $_POST['nama_pegawai'];
$alamat_pegawai = $_POST['alamat_pegawai'];
$telepon_pegawai = $_POST['telepon_pegawai'];
$password = $_POST['password'];

// Update the status of the transaction in the database
$query = mysqli_query($conn, "UPDATE pegawai SET nama_pegawai = '$nama_pegawai',alamat_pegawai = '$alamat_pegawai',telepon_pegawai = '$telepon_pegawai',password='$password' WHERE id_pegawai = '$id_pegawai'");

// Check if the query was successful
if ($query) {
    echo "<script>alert('Data Pegawai Berhasil Di Ubah ');window.location='pegawai.php';</script>";
    
} else {
    echo "Error updating status: " . mysqli_error($conn);
}
