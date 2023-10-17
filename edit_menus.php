<?php
include 'config.php';
include 'cek_login/admin-cek.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $product = mysqli_query($dbconn, "SELECT * FROM product WHERE id_product='$id'");
    if(mysqli_num_rows($product) == 0){
        header('location:ad-product.php');
    }
    $p = mysqli_fetch_object($product);
}

if(isset($_POST['submit'])){
    // Menampung data dari form
    $id = $_GET['id'];
    $category = $_POST['category'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $foto = $_POST['foto'];

    // data gambar yang baru
    $filename = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];


    // jika admin ganti gambar
    if($filename != ''){
        $type1 = explode('.', $filename);
        $type2 = $type1[1];
    
        $newname = 'menus'.time().'.'.$type2;
    
        // Menampung data format yang telah diizinkan
        $type_allowed = array('jpg', 'jpeg', 'png');
        // Validasi format file
        if(!in_array($type2, $type_allowed)){
            echo '<script>alert("Format is not allowed")</script>';
        } else{
            unlink('./menus/'.$foto);
            move_uploaded_file($tmp_name, './menus/'.$newname);
            $picture_name = $newname;
        }
    }else {
        // jika admin tidak ganti gambar
        $picture_name = $foto;
    }
    // update data menu
    $update = mysqli_query($dbconn, "UPDATE product SET 
                                    id_category = '".$category."',
                                    product_name = '".$name."',
                                    price = '".$price."',
                                    description = '".$description."',
                                    image = '".$picture_name."',
                                    status = '".$status."' WHERE id_product = '".$p->id_product."'");

    if($update){
        echo '<script>alert("Data was Updated")</script>';
        header('location:ad-product.php');
    } else {
        echo 'Failed '.mysqli_error($dbconn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>World Cafe Admin - Add Menus</title>
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
                        <li class="nav-item"><a class="nav-link" href="ad-product.php">Product</a></li>
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
                    <h1>Edit Menus</h1>
                    <div class="box">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-grup">
                                <select name="category" class="form-control" required>
                                    <option value="">-Select Category-</option>
                                        <?php
                                        $category = mysqli_query($dbconn,"SELECT * FROM category");
                                        while($cate = mysqli_fetch_array($category)){
                                        ?>
                                    <option value="<?=$cate['id_category']?>" <?=$cate['id_category'] == $p->id_category?'selected': ''?>>
                                    <?=$cate['category']?></option>
                                     <?php } ?>
                                </select>

                                <br>

                                <input type="text" placeholder="Name" name="name" class="form-control" value="<?=$p->product_name?>" required>
                                <br>
                                <input type="number" placeholder="Price" name="price" class="form-control" value="<?=$p->price?>"required>
                                <br>
                                <img src="menus/<?=$p->image?>" width="100px">
                                <input type="hidden" name="foto" value="<?=$p->image?>">
                                <input type="file" name="gambar" class="form-control">
                                <br>
                                <textarea name="description" class="form-control" placeholder="Description"><?=$p->description?> </textarea>
                                <br>
                                <select name="status" class="form-control" required>
                                    <option value="">-Select Status-</option>
                                    <option value="1" <?=$p->status == 1? 'selected':''?>>Avaible</option>
                                    <option value="0" <?=$p->status == 0? 'selected':''?>>Not Avaible</option>
                                    
                                </select>

                            </div>
                            <br>

                            <input type="submit" name="submit" value="Edit Menus" class="btn btn-primary">
                            <a href="ad-product.php" class="btn btn-warning">Kembali</a>
                        </form>
                    </div>
                </div>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
