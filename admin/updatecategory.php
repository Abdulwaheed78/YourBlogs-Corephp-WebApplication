<?php 
include "conn.php";

if(isset($_POST['updatecat'])){
    $id = $_POST['id'];
    $name = $_POST['name'];

    $query = mysqli_query($con, "UPDATE Category SET name='$name' WHERE id=$id");

    if($query){
        header("location:index.php?managecategory");
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
