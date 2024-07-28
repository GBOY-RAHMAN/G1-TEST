<?php

$severName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName ="phpproject_01";

$conn =  mysqli_connect($severName,$dbUserName, $dbPassword,$dbName,);
if (!$conn){
    die("connection failed :" . my_sqli_connect_error());
}