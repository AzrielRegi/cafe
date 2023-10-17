<?php
include 'config.php';
session_start();

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    
    $id = $_GET['id'];
    $qty = max($_POST['qty'],1);

    
    $data = mysqli_query($dbconn, "SELECT * FROM product WHERE id_product='$id'");
    $r = mysqli_fetch_assoc($data);

    $restoran = [
        'id' => $r['id_product'],
        'menu' => $r['product_name'],
        'harga' => $r['price'],
        'qty' => $qty
    ];

    $_SESSION['belanja'][] = $restoran;

    // if(isset($_SESSION['belanja'][$id])){
    //     $_SESSION['belanja'][$id] += $qty;
    // }else{
    //     $_SESSION['belanja'][$id] = $qty;
    // }


    ksort($_SESSION['belanja']);
    // print_r($_SESSION['belanja']);
    header('location:index.php');
}


// print_r($_SESSION['belanja']);
// header('location:cart.php');


// if(!isset($_GET['id']) || empty($_GET['id'])){
//     header('location:cart.php');
// }

// $qty = 1;

// if(isset($_POST['qty'])){
//     $qty = max($_POST['qty'],1);
// }

// if(!isset($_SESSION['cart'])){
//     $_SESSION['cart'] = [];
// }

// $id = $_GET['id'];

// if(!isset($_SESSION['cart'][$id])){
//     $_SESSION['cart'][$id] = $qty;
// }else{
//     $_SESSION['cart'][$id] += $qty;
// }



// header('location:cart.php');
?>