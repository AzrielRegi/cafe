<?php
include'config.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $product = mysqli_query($dbconn, "SELECT image FROM product WHERE id_product='$id'");
    $p = mysqli_fetch_object($product);

    unlink('./menus/'.$p->image);

    $delete = mysqli_query($dbconn, "DELETE FROM product where id_product='$id'");
    header('location:ad-product.php');
}

?>