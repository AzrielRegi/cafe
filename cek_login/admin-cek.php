<?php
include 'config.php';
session_start();

if(isset($_SESSION['userid'])){
    if($_SESSION['role_id']==1){
        header("location:owner.php");
    } elseif ($_SESSION['role_id']==3){
        header("location:index.php");
    } elseif($_SESSION['role_id']==4){
        header("location:cashier.php");
    } elseif($_SESSION['role_id']==5){
        header("location:kitchen.php");
    }
} else {
    $_SESSION['error'] = "Anda harus login terlebih dahulu";

    header("location:login.php");
}

?>