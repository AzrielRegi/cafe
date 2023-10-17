<?php
include 'config.php';
session_start();

$tanggal_waktu = date('Y-m-d H:i;s');
$total = $_POST['total_harga'];
$meja = $_POST['nomor_meja'];
$bayar = '';
$kembalian = '';
$status = 'Belum Bayar';

    mysqli_query($dbconn, "INSERT INTO pesanan (id_order,tanggal_waktu,no_meja,total,bayar,kembalian,status_order)
    VALUES (NULL,'$tanggal_waktu','$meja','$total',''$bayar'','$kembalian','$status')");

$id_pesanan = mysqli_insert_id($dbconn);

foreach($_SESSION['belanja'] as $key => $values){
    $id_menu = $values['id'];
    $menu = $values['menu'];
    $harga = $values['harga']*$values['qty'];
    $qty = $values['qty'];

    mysqli_query($dbconn, "INSERT INTO order_detail (id_detail,id_order,id_product,product_name,qty,price,status_order)
    VALUES (NULL,'$id_pesanan','$id_menu','$menu','$qty','$harga','$status')");
}

$_SESSION['belanja'] = [];

header('location:index.php');


?>