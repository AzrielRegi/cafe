<?php
include 'config.php';
session_start();

$id = $_POST['ido'];

$save = mysqli_query($dbconn, "UPDATE pesanan set status_order='Sudah Dimasak' where id_order='$id'");

$update = mysqli_query($dbconn, "UPDATE order_detail set status_order='Sudah Masak' where id_order='$id'");

header('location:kitchen.php');
?>