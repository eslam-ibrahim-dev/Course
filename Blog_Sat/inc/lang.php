<?php 

require_once "db.php";

if(isset($_GET['lang']))
{
    $lang = $_GET['lang'];
}

if($lang == "ar")
{
    $_SESSION['lang'] = 'ar';
}else 
{
    $_SESSION['lang'] = 'eng';
}
// echo "<pre>";
// print_r($_SERVER);die();
header("location:".$_SERVER['HTTP_REFERER']);