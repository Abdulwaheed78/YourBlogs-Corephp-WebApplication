<?php
include("conn.php");
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $s=mysqli_query($con,"DELETE FROM images WHERE id=$id");
    if ($s) {
        header("location:index.php?manageimage");
    } else {
       echo"Error deleting category: " . mysqli_error($con);
    }

}