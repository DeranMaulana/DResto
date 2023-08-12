<?php
// Connect to the database
include('../koneksi.php');

// Get the transaction code from the form data
$kodemenu = $_POST['kode_menu'];

// Set the new status to 'proses'
$stok = $_POST['stok'];
$nama_menu = $_POST['nama_menu'];
$harga = $_POST['harga'];

// Update the status of the transaction in the database
$query = mysqli_query($conn, "UPDATE menu SET stok = '$stok',nama_menu = '$nama_menu',harga = '$harga' WHERE kode_menu = '$kodemenu'");

// Check if the query was successful
if ($query) {
    echo "<script>alert('Data Menu Berhasil Di Ubah ');window.location='menu.php';</script>";
    
} else {
    echo "Error updating status: " . mysqli_error($conn);
}
