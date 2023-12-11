<?php 
include"conn.php";
if(isset($_POST['updatesub'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $action=$_POST['action'];
    $parent=$_POST['parent_menu_id'];

    $postquery=mysqli_query($con,"UPDATE submenu SET name='$name',action='$action',parent_menu_id='$parent' WHERE id=$id");
    if($postquery){
        header("location:index.php?managesubmenu");
    }else{
        echo"not done";
    }
}


?>