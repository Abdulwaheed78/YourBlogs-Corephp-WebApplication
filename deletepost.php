<?php
include("conn.php");
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $s=mysqli_query($con,"DELETE FROM post  WHERE id=$id");
    
header("location:admin/index.php?managepost");

}