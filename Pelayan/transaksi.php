<?php
session_start();
$id_pegawai = $_SESSION['id_pegawai'];
require_once '../koneksi.php';

$conn = mysqli_connect('localhost', 'root', '', 'dresto');

if (!isset($_SESSION['cart'])) {
 header('Location: index.php');
}

$cart = unserialize(serialize($_SESSION['cart']));
$total_item = 0;
$total_bayar = 0;

for ($i=0; $i<count($cart); $i++) { 
 $total_item += $cart[$i]['jumlah'];
 $total_bayar += $cart[$i]['jumlah'] * $cart[$i]['harga'];
}


// check if transaction with same table number and status already exists
$no_meja = $_SESSION['nomeja'];
$check_query = mysqli_query($conn, "SELECT kode_transaksi FROM transaksi WHERE no_meja = '$no_meja' and status='Belum Beres'");
if (mysqli_num_rows($check_query) > 0) {
    // use existing transaction code
    $data = mysqli_fetch_array($check_query);
    $kodetransaksi = $data['kode_transaksi'];
} else {
    // generate new transaction code
    $huruf = "TS";
    $timestamp = date('YmdHis');
    $kodetransaksi = $huruf . sprintf("%03s", $no_meja) . $timestamp;
}



// check if transaction with same transaction code already exists
$check_query = mysqli_query($conn, "SELECT * FROM transaksi WHERE kode_transaksi = '$kodetransaksi'");
if (mysqli_num_rows($check_query) == 0) {
    // insert new record into transaksi table
    $query = mysqli_query($conn, "INSERT INTO transaksi (kode_transaksi, total_item, subtotal, tanggal_transaksi, no_meja, status) VALUES ('$kodetransaksi', '$total_item', '$total_bayar', '" . date('Y-m-d') . "', '{$_SESSION['nomeja']}', 'Belum Beres')");
    $id_order = mysqli_insert_id($conn);
}

for ($i=0; $i<count($cart); $i++) { 
    $kode_menu = $cart[$i]['kode_menu'];
    $jumlah = $cart[$i]['jumlah'];

    // check if record with same transaction code and menu code already exists
    $check_query = mysqli_query($conn, "SELECT * FROM detail_transaksi WHERE kode_transaksi = '$kodetransaksi' AND kode_menu = '$kode_menu'");
    if (mysqli_num_rows($check_query) > 0) {
        // update quantity value for existing record
        $query = mysqli_query($conn, "UPDATE detail_transaksi SET jumlah = jumlah + $jumlah WHERE kode_transaksi = '$kodetransaksi' AND kode_menu = '$kode_menu'");
    } else {
        // insert new record into detail_transaksi table
        $query = mysqli_query($conn, "INSERT INTO detail_transaksi (kode_transaksi, id_pegawai, kode_menu, jumlah, status) VALUES ('$kodetransaksi','$id_pegawai', '$kode_menu', '$jumlah','Baru')");
    }

    // update stock in menu table
    $query = mysqli_query($conn, "UPDATE menu SET stok = stok - $jumlah WHERE kode_menu = '$kode_menu'");
}

// update total_item and subtotal in transaksi table
$update_query = mysqli_query($conn, "UPDATE transaksi SET total_item = (SELECT SUM(jumlah) FROM detail_transaksi WHERE kode_transaksi = '$kodetransaksi'), subtotal = (SELECT SUM(jumlah * harga) FROM detail_transaksi JOIN menu ON detail_transaksi.kode_menu = menu.kode_menu WHERE kode_transaksi = '$kodetransaksi') WHERE kode_transaksi = '$kodetransaksi'");




// unset session
unset($_SESSION['cart']);
echo "<script>alert('Pesanan berhasil di pesan');window.location='meja.php';</script>";
?>
