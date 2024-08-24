<?php 

require_once "../inc/db.php";

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $hashPassword = password_hash($password,PASSWORD_DEFAULT);

    $query = "INSERT INTO users (`name`,`email`,`password`,`phone`) VALUES
    ('$name','$email','$hashPassword','$phone')";
    $result = mysqli_query($connection,$query);
    if($result)
    {
        header("location:../Login.php");
    }else 
    {
        header("location:../register.php");
    }

}