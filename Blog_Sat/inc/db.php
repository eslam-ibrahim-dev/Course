<?php 
  session_start();
$serverName= 'localhost';
$userName = 'root';
$password = '';
$dbName = 'c42_sat_blog';

$connection = mysqli_connect($serverName,$userName,$password,$dbName);
