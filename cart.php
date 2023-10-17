<?php
include 'config.php';
include 'cek_login/pelayan-cek.php';


$cart = mysqli_query($dbconn, 'SELECT * FROM product');

$sum = 0;

if(isset($_SESSION['belanja'])){
    foreach($_SESSION['belanja'] as $key => $value){
        $sum += $value['qty']*$value['harga'];
        $menu = $value['menu'];
    }
}

// print_r($_SESSION['belanja']);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Item - Word Cafe Menus</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">World Cafe</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="produk-disewa.php">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <?php
                                    $kategori = mysqli_query($dbconn, "SELECT * FROM category ORDER BY id_category ASC");

                                    if(mysqli_num_rows($kategori) > 0){
                                        while($k = mysqli_fetch_array($kategori)){
                                ?>
                                <li><a class="dropdown-item" href="items-cate.php?kat=<?=$k['id_category']?>"><?=$k['category']?></a></li>
                               <?php }}else{?>
                                <p>Kategori tidak ada</p>
                                <?php }?>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a href="cart.php" class="btn btn-outline-dark">
                            <i class="bi-cart-fill me-1"></i>
                                Cart
                                <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </a>
                        <!-- <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button> -->
                    </form>
                </div>
            </div>
        </nav>
        <!-- Product section-->
<br>
        <div class="container">
            <a href="reset_cart.php">Reset Cart</a>
            <br>
                    <form action="update_cart.php" method="POST">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Menus</td>
                                <td>Quantity</td>
                                <td>Price</td>
                                <td>Total</td>
                                <td>Action</td>
                        
                            </tr>
                        </thead>
                        <?php
                        foreach($_SESSION['belanja'] as $key => $value) {
                        ?>
                        <tbody>
                            <tr>
                                <td><?=$value['menu']?></td>
                                <td class="col-md-2"><input type="number" name="qty[]" value="<?=$value['qty']?>" class="form-control"></td>
                                <td><?=number_format($value['harga'])?></td>
                                <td><?=number_format($value['harga']*$value['qty'])?></td>
                                <td>
                                    <a href="cart-delete.php?id=<?=$value['id']?>" class="btn btn-danger"><i class="bi-trash"></i></a>
                                </td>
                                <tr class="odd gradeX">
                            </tr>        
                            <?php } ?>  
                        </tbody>
                        </table>  
                        <button type='submit' class="btn btn-info">Update</button>
                    </form>
                    
                </div>
                <br>
                    <div class="container" styles="margin-">
                        <form action="cart-act.php" method="POST">
                        <table class="table table-bordered">
                            <td>No. Meja</td>
                            <td>
                                <center>
                                <input type="number" name="nomor_meja" class="form-control">
                                </center>
                            </td>
                                <tr class="odd gradeX">
                                    <td>Total Harga</td>
                                    <td>
                                        <center>
                                        <span class="label label-success">&nbsp;Rp. <span><?=number_format($sum)?></span>,-&nbsp;</span>
                                        </center>
                                    </td>
                            </table>
                            <input type="hidden" name="total_harga" value="<?=$sum?>">
                            <button class="btn btn-success" type="submit">Selesai</button>
                        </form> 
                    </div>
                      
        <br>

        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
