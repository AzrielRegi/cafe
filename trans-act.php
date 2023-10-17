<?php
include 'config.php';
session_start();
 // Untuk menghindari huruf Rp.
 $bayar = preg_replace('/\D/', '', $_POST['bayar']);

 $total = $_POST['total'];
 $kembalian = ($bayar - $total);
 $oid = $_POST['id'];


 $savedata = mysqli_query($dbconn, "UPDATE pesanan set bayar=$bayar, kembalian=$kembalian, status_order='Sudah Dibayar' where id_order='$oid'");

 $savedetail = mysqli_query($dbconn, "UPDATE order_detail set status_order='Sudah Bayar' WHERE id_order='$oid'");

 header('location: trans-success.php?id_trans='.$oid);
?>