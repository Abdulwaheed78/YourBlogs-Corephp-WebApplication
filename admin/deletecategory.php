<?php
include("conn.php");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    if (mysqli_query($con, "DELETE FROM category WHERE id=$id")) {
        header("location:index.php?managecategory");
    } else {
       echo"Error deleting category: " . mysqli_error($con);
    }

    
}
?>
