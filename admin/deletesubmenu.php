<?php
include("conn.php");
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $s=mysqli_query($con,"DELETE FROM submenu WHERE id=$id");
    if ($s) {
        header("location:index.php?managesubmenu");
    } else {
       echo"Error deleting category: " . mysqli_error($con);
    }


}