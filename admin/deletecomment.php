<?php  

include"conn.php";

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $query=mysqli_query($con,"DELETE FROM comments WHERE id=$id");
    if($query){
        header("location:index.php?managecomment");
    }else{
        echo"comment not found";
    }
}


?>