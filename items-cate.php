<?php
error_reporting(0);
include 'config.php';
include 'cek_login/pelayan-cek.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - RFL CosplayRent</title>
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
                <a class="navbar-brand" href="about.php">World Cafe</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="index.php">All Products</a></li>
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
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Welcome to World Restaurant</h1>
                    <p class="lead fw-normal text-white-50 mb-0"> Where is Any Food are Avaible </p>
                </div>
            </div>
        </header>

        <br>

        <!-- Search -->
        <div class="search">
            <div class="container" style="padding: 0 10vh 0 25vh;">
                <form action="produk-disewa.php">
                    <input type="text" name="search" placeholder="Search" value="<?= $_GET['search'] ?>" class="col-md-8">
                    <input type="hidden" name="kat" value="<?= $_GET['kat'] ?>">
                    <input type="submit" name="cari" value="Search" class="btn btn-primary">
                </form>
            </div>
        </div>

        <!-- Category -->
        

        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                                if($_GET['search'] != '' || $_GET['kat'] != ''){
                                    $where = "AND product_name LIKE '%".$_GET['search']."%' AND id_category LIKE '%".$_GET['kat']."%' ";
                                }

                                $getdata = mysqli_query($dbconn, "SELECT * FROM product WHERE status = 1 $where ORDER BY id_product ASC");
                                if(mysqli_num_rows($getdata) > 0){
                                    while($data = mysqli_fetch_array($getdata)){
                            ?>
                        
                    <div class="col mb-5">
                    
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="menus/<?=$data['image']?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?= $data['product_name']?></h5>
                                    <!-- Product price-->
                                    Rp. <?= number_format ($data['price'])?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="item.php?id=<?=$data['id_product']?>">View Product</a></div>
                            </div>
                        </div>
                        
                    </div>
                        
                    <?php } }else{?>
                            <p>Produk tidak ada</p>
                        <?php } ?>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; WORLD CAFE 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
