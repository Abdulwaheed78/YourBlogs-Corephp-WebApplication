<?php 
include("../conn.php");
if(isset($_POST['post'])){
    $title=$_POST['title'];

    $content=$_POST['content'];

    $category=$_POST['category_id'];

    $image_name = $_FILES['image']['name'];
    $tmpname = $_FILES['image']['tmp_name'];

    $folder = "../images/" . $image_name;

    move_uploaded_file($tmpname, $folder);

mysqli_query($con," INSERT INTO post (title,content,category_id,image) VALUES ('$title','$content',$category,'$image_name')");

header("location:index.php?");   
}



?>