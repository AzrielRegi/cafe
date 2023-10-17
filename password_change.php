<?php
include 'config.php';
include 'cek_login/admin-cek.php';

if(isset($_GET['id'])){
   $id = $_GET['id'];

    $data = mysqli_query($dbconn, "SELECT * FROM user where id_user='$id'");
    $d = mysqli_fetch_assoc($data);
}

if(isset($_POST['change'])){
    $id = $_GET['id'];
    $pass1 = $_POST['new_pass'];
    $pass2 = $_POST['confirm_pass'];

    if($pass2 != $pass1){
        echo'<script>alert("New Password is incorrect")</script>';
    } else {
        $u_pass = mysqli_query($dbconn, "UPDATE user SET password = '".MD5($pass1)."' WHERE id_user = '$id'");
        if($u_pass){
            echo'<script>alert("Change Password is Success")</script>';
            header ('location:profile.php');
        } else {
            echo 'Failed '.mysqli_error($dbconn);
        }
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
        <title>World Cafe Admin - Change Password</title>
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
                    <h1>Change Password</h1>
                    <form method="POST">
                        
                        <div class="form-grup">
                            <label>New Password</label>
                            <input type="password" name="new_pass" class="form-control" placeholder="New Password" >
                        </div>

                        <br>

                        <div class="form-grup">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirm_pass" class="form-control" placeholder="New Password" >
                        </div>

                        <br>

                        <br>

                        <input type="submit" name="change" value="Change Password" class="btn btn-primary">
                        <a href="profile.php" class="btn btn-warning">Kembali</a>
                    </form>
                </div>
            <!-- End of Main Content -->
        </div>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
