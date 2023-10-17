<?php
include 'config.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    mysqli_query($dbconn, "DELETE FROM category WHERE id_category='$id'");

    header('location:admin-cate.php');
}

?>