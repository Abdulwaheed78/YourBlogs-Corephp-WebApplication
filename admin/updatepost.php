<?php
include("conn.php");

if (isset($_POST['post'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category_id'];

    if (isset($_GET['edit'])) {
        $post_id = $_GET['edit'];

        // Check if the "Delete Previous Images" checkbox is selected
        if (isset($_POST['delete_previous_images']) && $_POST['delete_previous_images'] == 1) {
            // Delete previous images excluding the first image
            mysqli_query($con, "DELETE FROM images WHERE post_id = $post_id");
        }

        // Save the first image in the post table (if a new featured image is provided)
        if (isset($_FILES['featured_image']['name']) && !empty($_FILES['featured_image']['name'])) {
            $firstImageName = $_FILES['featured_image']['name'];
            $firstImageTmpName = $_FILES['featured_image']['tmp_name'];
            $firstImageFolder = "../images/" . $firstImageName;
            move_uploaded_file($firstImageTmpName, $firstImageFolder);

            // Update post table with new details and featured image
            mysqli_query($con, "UPDATE post SET title = '$title', content = '$content', category_id = $category, image = '$firstImageName' WHERE id = $post_id");
        } else {
            // No new featured image provided, only update post details
            mysqli_query($con, "UPDATE post SET title = '$title', content = '$content', category_id = $category WHERE id = $post_id");
        }

        // Save the remaining images in the images table (if new images are provided)
        if (!empty($_FILES['image']['name'][0])) {
            for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
                $image_name = $_FILES['image']['name'][$i];
                $tmpname = $_FILES['image']['tmp_name'][$i];
                $folder = "../images/" . $image_name;
                move_uploaded_file($tmpname, $folder);

                // Insert into images table with the corresponding post_id
                mysqli_query($con, "INSERT INTO images (image, post_id) VALUES ('$image_name', $post_id)");
            }
        }
        
        header("location:index.php?managepost");
    } else {
        // Handle case where post ID is not provided
        echo "Post ID is not provided.";
    }
}
?>
