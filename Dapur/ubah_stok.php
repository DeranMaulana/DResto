<?php
// Connect to the database
include('../koneksi.php');

// Get the transaction code from the form data
$kodemenu = $_POST['kode_menu'];

// Set the new status to 'proses'
$stok = $_POST['stok'];

// Update the status of the transaction in the database
$query = mysqli_query($conn, "UPDATE menu SET stok = '$stok' WHERE kode_menu = '$kodemenu'");

// Check if the query was successful
if ($query) {
    echo "<script>alert('Stok Berhasil di ubah ');window.location='menu.php';</script>";
    
} else {
    echo "Error updating status: " . mysqli_error($conn);
}
