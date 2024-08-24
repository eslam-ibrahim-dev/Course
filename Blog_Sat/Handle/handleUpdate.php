<?php 

require_once "../inc/db.php";

if(isset($_POST['submit']) && isset($_GET['id']))
{
    $id = $_GET['id'];
    $title = $_POST['title'];
    $body = $_POST['body'];

    $query = "select * from posts where id = $id";
    $result = mysqli_query($connection,$query);
    $oldImage = mysqli_fetch_assoc($result)['image'];

    $errors=[];
    if(empty($title))
    {
        $errors[] = "the title should be exist";
    }
    if(empty($body))
    {
        $errors[] = "the body should be exist";
    }

    if(isset($_FILES['image']) && $_FILES['image']['name'])
    {
        $img = $_FILES['image'];
        $img_name = $img['name'];
        $img_tmpName = $img['tmp_name'];
        $ext = pathinfo($img_name,PATHINFO_EXTENSION);
        $img_error= $img['error'];
        $img_size = $img['size'] / (1024 * 1024);
        $now = date("Y/m/d h:i:s");
        $newName = uniqid(). "." . $ext; // 213153436515313213.png
        $dir_img = "../assets/images/postImage/"; 
        if($img_error > 0)
        {
            $errors[] = "the img is broken";
        }
        elseif( $img_size > 1 )
        {
            $errors[] = "the image size is bigger than 1mb";
        }
        elseif(!in_array($ext,['png','jpg']))
        {
              $errors[] = "the image must be jpg pr png";
        }

    }else 
    {
        $newName = $oldImage;
    }

    if(empty($errors))
    {
        $query = "UPDATE posts SET `title` = '$title' , `body` = '$body' , `image` = '$newName' WHERE id =$id";

        $result = mysqli_query($connection,$query);
        if($result)
        {
            $_SESSION['success'] = "the post is updated successfully";
            unlink("assets/images/postImage/$oldImage");
            move_uploaded_file($img_tmpName,$dir_img.$newName);
            header('location:../index.php');
            exit();
        }else {
            $errors[]= "the post is not updated";
        }
    }

    $_SESSION['errors'] = $errors;
    header("location:../index.php");

}