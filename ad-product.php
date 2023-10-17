<?php
include 'config.php';
include 'cek_login/admin-cek.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>World Cafe Admin - Category</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">WORLD CAFE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="adminpage.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin-category.php">Category</a></li>
                        <li class="nav-item"><a class="nav-link active" href="ad-product.php">Product</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$_SESSION['name']?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <br>
        
        
        <div class="container">
            <div class="box">
                <a href="menus_add.php" class="btn btn-secondary">Add More Menus</a>
            </div>
            <div class="box">
            <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Picture</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php 
                        $no = 1;
                        $product = mysqli_query($dbconn, "SELECT * FROM product LEFT JOIN category USING (id_category) 
                        ORDER BY id_product ASC");
                        if(mysqli_num_rows($product) > 0){
                        while($row = mysqli_fetch_array($product)){
                    ?>
                    <tbody>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$row['category']?></td>
                            <td><?=$row['product_name']?></td>
                            <td>Rp. <?=number_format($row['price'])?></td>
                            <td><img src="menus/<?=$row['image']?>" width="50px"alt=""></td>
                            <td><?=$row['status'] == 0? 'Not Avaible':'Avaible';?></td>
                            <td>
                                <a href="edit_menus.php?id=<?=$row['id_product']?>">Edit</a> || 
                                <a href="delete_menus.php?id=<?=$row['id_product']?>">Delete</a>
                            </td>
                        </tr>
                        <?php }} else {?>
                            <tr>
                                <td colspan="8">There's no Product</td>
                            </tr>

                        <?php }?>
                    </tbody>
                    
                </table>
            </div>
        </div>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

       
    </body>
</html>
