<?php
include 'config.php';
session_start();

$qty = max($_POST['qty'],1);

foreach ($_SESSION['belanja'] as $key => $value){
    $_SESSION['belanja'][$key]['qty'] = $qty[$key];
} 

header('location:cart.php')
?>