<!DOCTYPE html>
<html lang="en">
<?php
include "config.php";
ob_start();

// if(isset($_GET['id'])){
//     $ido = $_GET['id'];

//     $getdetail = mysqli_query($dbconn, "SELECT * FROM pesanan p where id_order='$ido'");
//     $gd = mysqli_fetch_array($getdetail);
// } else {
//     header("location:ow-profit.php");
// }


?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>&nbsp;</title>
  
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="template/dashboard/css/bootstrap.min.css" />
  <link rel="stylesheet" href="template/dashboard/css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="template/dashboard/css/fullcalendar.css" />
  <link rel="stylesheet" href="template/dashboard/css/matrix-style.css" />
  <link rel="stylesheet" href="template/dashboard/css/matrix-media.css" />
  <link href="template/dashboard/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" href="template/dashboard/css/jquery.gritter.css" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
   <!-- Custom styles for this template-->
   <link href="css/sb-admin-2.min.css" rel="stylesheet">


<style>

@page{
  size: auto;
}
body {
  background: rgb(204,204,204); 
}

page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.1cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 29.7cm;
  height: 21cm; 
}
page[size="A4"][layout="potrait"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="landscape"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="landscape"] {
  width: 21cm;
  height: 19.8cm;  
}
page[size="dipakai"][layout="landscape"] {
  width: 20cm;
  height: 20cm;  
}
@media print {
  body, page {
    margin: auto;
    box-shadow: 0;
  }
}

</style>


</head>

<body onload="print()">

  <page size="dipakai" layout="landscape">
    <br>
    <?php
      $ido = $_REQUEST['id'];
      $query_order = "select * from pesanan where id_order = $ido";
      $sql_order = mysqli_query($dbconn, $query_order);
      $gd = mysqli_fetch_array($sql_order);
      //echo $id_order
    ?>
      <center>
        <h4>
          WORLD CAFE
        </h4>
        <span>
          Jl. Imam Bonjol No. 103 Ds. Tembarak, Kec. Kertosono, Kab. Nganjuk, Jatim<br>
          Telp. +6289 xxx xxx xxx || E-mail exsample@gmail.com
        </span>
      </center>
            <hr>
              <table style="width: 100%" class="">
                <tr>
                  <td>
                    Waktu Pesan
                  </td>
                  <td>
                  :
                  </td>
                  <td>
                    <?=$gd['tanggal_waktu'] ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    No Meja
                  </td>
                  <td>
                  :
                  </td>
                  <td>
                    <?=$gd['no_meja'] ?>
                  </td>
                </tr>
              </table>

              <hr>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="head0">No.</th>
                    <th class="head1">Menu</th>
                    <th class="head0 right">Jumlah</th>
                    <th class="head1 right">Harga</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no_order_fiks = 1;
                    $order = mysqli_query($dbconn, "SELECT * FROM order_detail where id_order = '$ido'");
                    while ($row = mysqli_fetch_array($order)){
                  ?>
                  <tr>
                    <td><center><?php echo $no_order_fiks++; ?>. </center></td>
                    <td><?=$row['product_name']?></td>
                    <td class="right"><center><?=$row['qty']?></center></td>
                    <td class="right">Rp. <?=number_format($row['price'])?>,-</td>
                  </tr>
                  <?php
                    }
                    $query_harga = "select * from pesanan where id_order = $ido";
                    $sql_harga = mysqli_query($dbconn, $query_harga);
                    $ptotal = mysqli_fetch_array($sql_harga);
                  ?>

                  <tr>
                    <td></td>
                    <td><strong><center>Total</center></strong></td>
                    <td class="right"></td>
                    <td class="right"><strong>Rp. <?=number_format($ptotal['total'])?>,-</strong></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><strong><center>Uang Bayar</center></strong></td>
                    <td class="right"></td>
                    <td class="right"><strong>Rp. <?=number_format($ptotal['bayar'])?>,-</strong></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><strong><center>Uang Kembali</center></strong></td>
                    <td class="right"></td>
                    <td class="right"><strong>Rp. <?=number_format($ptotal['kembalian'])?>,-</strong></td>
                  </tr>
                  
                </tbody>
              </table>
            
  </page>
</body>


<script src="template/dashboard/js/excanvas.min.js"></script> 
<script src="template/dashboard/js/jquery.min.js"></script> 
<script src="template/dashboard/js/jquery.ui.custom.js"></script> 
<script src="template/dashboard/js/bootstrap.min.js"></script> 
<script src="template/dashboard/js/jquery.flot.min.js"></script> 
<script src="template/dashboard/js/jquery.flot.resize.min.js"></script> 
<script src="template/dashboard/js/jquery.peity.min.js"></script> 
<script src="template/dashboard/js/fullcalendar.min.js"></script> 
<script src="template/dashboard/js/matrix.js"></script> 
<script src="template/dashboard/js/matrix.dashboard.js"></script> 
<script src="template/dashboard/js/jquery.gritter.min.js"></script> 
<script src="template/dashboard/js/matrix.interface.js"></script> 
<script src="template/dashboard/js/matrix.chat.js"></script> 
<script src="template/dashboard/js/jquery.validate.js"></script> 
<script src="template/dashboard/js/matrix.form_validation.js"></script> 
<script src="template/dashboard/js/jquery.wizard.js"></script> 
<script src="template/dashboard/js/jquery.uniform.js"></script> 
<script src="template/dashboard/js/select2.min.js"></script> 
<script src="template/dashboard/js/matrix.popover.js"></script> 
<script src="template/dashboard/js/jquery.dataTables.min.js"></script> 
<script src="template/dashboard/js/matrix.tables.js"></script> 
</html>
