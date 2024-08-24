<?php

require_once "../inc/db.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $query = "SELECT * from users where email = '$email'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $user_id = $user['id'];
            $user_name = $user['name'];
            $oldPassword = $user['password'];
            $verify = password_verify($password, $oldPassword);
            if ($verify) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['success'] = "Welcome $user_name";
                header("location:../index.php");
                exit();
            } else {
                $_SESSION['errors'] = "the password is incorrect";
                header("location:../Login.php");
            }
        }else 
        {
            $_SESSION['errors'] = "the email is incorrect";
            header("location:../Login.php");
        }
    }
    header("location:../Login.php");
}
