<?php
// Connect to the database
include('../koneksi.php');

// Get the transaction code from the form data
$no_meja = $_POST['no_meja'];

// Set the new status to 'proses'
$kapasitas = $_POST['kapasitas'];
$status = $_POST['status'];

// Update the status of the transaction in the database
$query = mysqli_query($conn, "UPDATE meja SET kapasitas = '$kapasitas',status = '$status' WHERE no_meja = '$no_meja'");

// Check if the query was successful
if ($query) {
    echo "<script>alert('Data Meja Berhasil Di Ubah ');window.location='meja.php';</script>";
    
} else {
    echo "Error updating status: " . mysqli_error($conn);
}
