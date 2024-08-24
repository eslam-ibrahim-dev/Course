<?php 

require_once "../inc/db.php";

if($_GET['id'])
{
    $id = $_GET['id'];

    $query = "DELETE FROM posts WHERE id = $id";
    $result = mysqli_query($connection,$query);
    if($result)
    {
        $_SESSION['success'] = "the post is deleted";
        header("location:../index.php");
    }
    else {
        header("location:../viewPost.php?id=$id");
    }
}