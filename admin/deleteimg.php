<?php 
include("conn.php");
if(isset($_GET['delete'])){

    $id=$_GET['delete'];

    //echo"$id";
    $query = mysqli_query($con, "UPDATE users SET profileimage = NULL WHERE id = $id");
    if($query){
        header("location:profile.php");
    }else{
        echo"not done";
    }
}

?>