<?php
// Connect to the database
$db = mysqli_connect("hostname", "username", "password", "database_name");

// Check if the connection was successful
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create a query to reset the data
$query = "UPDATE menu SET stok = 0";

// Execute the query
if (mysqli_query($db, $query)) {
  // Redirect back to the original page
  header("Location: original_page.php");
