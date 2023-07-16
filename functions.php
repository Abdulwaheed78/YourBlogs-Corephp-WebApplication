
<?php
function getcategory($con,$id){
    
    $run= mysqli_query($con,"SELECT * FROM category WHERE id=$id");
    $data=mysqli_fetch_assoc($run);
       return $data['name'];
}


function getimagesbyid($con,$post_id){
   $run= mysqli_query($con,"SELECT * FROM images WHERE post_id=$post_id");
  
   $data=array();
   while($d=mysqli_fetch_assoc($run)){
      $data[]=$d;
   }
   return $data;
}

function getsubmenu($con,$menu_id){
   $run=mysqli_query($con,"SELECT * FROM submenu WHERE parent_menu_id=$menu_id");
   $data=array();
     while($d=mysqli_fetch_assoc($run)){
        $data[]=$d;
     }
     return $data;
}

function getsubmenuno($con,$menu_id){
   $run=mysqli_query($con,"SELECT * FROM submenu WHERE parent_menu_id=$menu_id");
   return mysqli_num_rows($run);

}

function getadmin($con, $username){
   $sql=mysqli_query($con,"SELECT * FROM admin WHERE username='$username'");
   $res=mysqli_fetch_assoc($sql);
   return $res;

}

?>
