<?php
include 'config.php';
session_start();

$date = date('Y-m-d H:i;s');
$nomor_pesanan = rand(1111, 9999);
$produksi = $_POST['produksi'];

?>