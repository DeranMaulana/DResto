<?php
// Connect to the database
include('../koneksi.php');

// Get the transaction code from the form data
$kodetransaksi = $_POST['kodetransaksi'];

// Set the new status to 'proses'
$status = 'Proses';

// Update the status of the transaction in the database
$query = mysqli_query($conn, "UPDATE detail_transaksi SET status = '$status' WHERE kode_transaksi = '$kodetransaksi'");

// Check if the query was successful
if ($query) {
    echo "<script>alert('Selamat Bekerja ');window.location='menu_baru.php';</script>";
    
} else {
    echo "Error updating status: " . mysqli_error($conn);
}
