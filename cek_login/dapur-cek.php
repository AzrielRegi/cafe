<?php
include 'config.php';
session_start();

if(isset($_SESSION['userid'])){
    if($_SESSION['role_id']==1){
        header("location:owner.php");
    } elseif ($_SESSION['role_id']==2){
        header("location:adminpage.php");
    } elseif($_SESSION['role_id']==3){
        header("location:index.php");
    } elseif($_SESSION['role_id']==4){
        header("location:cashier.php");
    }
} else {
    $_SESSION['error'] = "Anda harus login terlebih dahulu";

    header("location:login.php");
}

?>