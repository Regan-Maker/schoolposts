<?php

$server = "mysql-1020ea9e-schoolposts.c.aivencloud.com"; 
$host = "mysql-1020ea9e-schoolposts.c.aivencloud.com";
$port = "17563";
$user = "avnadmin";
$password = "AVNS_BsvAsQOA5ZunMM4Kos_";
$database = "defaultdb";

$con = mysqli_init();
mysqli_ssl_set($con, NULL, NULL, NULL, NULL, NULL);
if (!mysqli_real_connect($con, $host, $user, $password, $database, $port,NULL, MYSQLI_CLIENT_SSL)) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
