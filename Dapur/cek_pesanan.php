<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'dresto');

// Query the database for the latest orders
$result = mysqli_query($conn, "SELECT * FROM detail_transaksi WHERE status = 'Baru'");

// Fetch the results as an associative array
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Return the results as a JSON object
echo json_encode($orders);
