<?php
include("conn.php");

if(isset($_POST['updateimage'])){
    $id = $_POST['id'];

    // File upload handling
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Get file details
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];

        // Specify the target directory
        $target_directory = "../images/";

        // Move the uploaded file to the target directory
        $target_path = $target_directory . $file_name;
        move_uploaded_file($file_tmp, $target_path);

        // Database update
        $sql = "UPDATE images SET image = '$target_path' WHERE id = $id";
        $result = mysqli_query($con, $sql);

        if($result) {
            header("location:index.php?manageimage");
        } else {
            echo "Error updating image: " . mysqli_error($conn);
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
