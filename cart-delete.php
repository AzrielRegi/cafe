<?php
include 'config.php';
session_start();

$id = $_GET['id'];

$belanja = $_SESSION['belanja'];

// Berfungsi untuk mengambil data secara spesifik
$b = array_filter($belanja, function ($var) use ($id){
    return($var['id'] == $id);
});

foreach($b as $key => $value){
    unset($_SESSION['belanja'][$key]);
}

$_SESSION['belanja'] = array_values($_SESSION['belanja']);

header('location:cart.php');
?>