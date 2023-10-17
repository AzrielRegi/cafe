<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db =  'cafe';

$dbconn = new mysqli("$host", "$user", "$pass", "$db");
if($dbconn -> connect_error){
    echo "Koneksi Gagal -> ".$dbconn->connect_error;
}

?>