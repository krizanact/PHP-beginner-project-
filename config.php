<?php
//konfiguracija baze podataka
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "knjiznica";

$conn = mysqli_connect($servername, $username , $password, $dbname) or die ('Error connecting to mysql');
mysqli_select_db($conn,"knjiznica");
mysqli_query($conn,"SET NAMES utf8");
mysqli_query($conn,"SET CHARACTER SET utf8");
mysqli_query($conn,"SET COLLATION_CONNECTION='utf8_unicode_ci'");

?>