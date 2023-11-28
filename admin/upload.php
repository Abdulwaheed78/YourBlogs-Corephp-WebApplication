<!-- upload.php -->
<?php
if ($_FILES['image']) {
    $target_dir = ".images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Image uploaded successfully";
    } else {
        echo "Error uploading image";
    }
}
?>

<!-- delete.php -->
<?php
// Perform image deletion logic here
echo "Image deleted successfully";
?>
