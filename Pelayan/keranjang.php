<?php

include ('../koneksi.php');
if (isset($_POST['kode_menu'], $_POST['jumlah'])) {
 
 $id = $_POST['kode_menu'];
 $jumlah = $_POST['jumlah'];

 $produk = mysqli_query($conn, "SELECT * FROM menu WHERE kode_menu = '$id'");
 $dt_produk = $produk->fetch_assoc();

 if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

 $index = -1;
 $cart = unserialize(serialize($_SESSION['cart']));

 // jika produk sudah ada dalam cart maka jumlah akan diupdate
 for ($i=0; $i<count($cart); $i++) {
  if ($cart[$i]['kode_menu'] == $id) {
   $index = $i;
   $_SESSION['cart'][$i]['jumlah'] = $jumlah;
   break;
  }
 }

 // jika produk belum ada dalam cart
 if ($index == -1) {
  $_SESSION['cart'][] = [
   'kode_menu' => $id,
   'nama_menu' => $dt_produk['nama_menu'],
   'harga' => $dt_produk['harga'],
   'jumlah' => $jumlah
  ];
 }
}

if (!empty($_SESSION['cart'])) { 
 ?>

  <h4>Daftar Menu Yang Dipilih</h4>
  <br>
  <table class="table table-bordered">
   <tr align="center">
    <th>No</th>
    <th>Nama Produk</th>
    <th>Jumlah</th>
    <th>Harga</th>
    <th>Total</th>
    <th>Aksi</th>
   </tr>

   <?php
   if(isset($_SESSION['cart'])) {
    $cart = unserialize(serialize($_SESSION['cart']));
    $index = 0;
    $no = 1;
    $total = 0;
    $total_bayar = 0;

    for ($i=0; $i<count($cart); $i++) {
     $total = $_SESSION['cart'][$i]['harga'] * $_SESSION['cart'][$i]['jumlah'];
     $total_bayar += $total;
     ?>

     <tr>
      <td align="center"><?= $no++; ?></td>
      <td><?= $cart[$i]['nama_menu']; ?></td>
      <td align="center"><?= $cart[$i]['jumlah']; ?></td>
      <td><?= $cart[$i]['harga']; ?></td>
      <td><?= $total; ?></td>
      <td align="center">
       <a href="?index=<?= $index; ?>">
        <button class="btn btn-danger btn-sm">Hapus</button>
       </a>  
      </td>
     </tr>

     <?php
     $index++;
    }

  // hapus produk dalam cart
    if(isset($_GET['index'])) {
     $cart = unserialize(serialize($_SESSION['cart']));
     unset($cart[$_GET['index']]);
     $cart = array_values($cart);
     $_SESSION['cart'] = $cart;
    }
   }
   ?>

   <tr>
    <td colspan="4" align="right"><strong>Total Bayar</strong></td>
    <td><strong><?= $total_bayar; ?></strong></td>
    <td align="center">
     <a href="transaksi.php">
      <button class="btn btn-success btn-sm">Checkout</button>
     </a>
    </td>
   </tr>

  </table>
  <br><hr>
  
<?php
}
if (isset($_GET['index'])) {
  header('Location: index.php');
}


?>
