<?php
session_start();

$_SESSION['belanja'] = [];

header('location:cart.php');
?>