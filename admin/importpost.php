<?php
include("conn.php");

if (isset($_POST['import'])) {
    if (isset($_FILES['csv_file'])) {
        $csvFileTmpName = $_FILES['csv_file']['tmp_name'];

        // Process the CSV file
        $file = fopen($csvFileTmpName, 'r');
        if ($file !== false) {
            // Skip the header if present
            fgetcsv($file);

            while (($data = fgetcsv($file)) !== false) {
                $title = mysqli_real_escape_string($con, $data[0]); // Assuming the first column is the title
                $content = mysqli_real_escape_string($con, $data[1]); // Assuming the second column is the content
                $categoryName = mysqli_real_escape_string($con, $data[2]); // Assuming the third column is the category name

                // Insert into category table
                mysqli_query($con, "INSERT INTO category (name) VALUES ('$categoryName')");

                // Get the last inserted category id
                $category_id = mysqli_insert_id($con);

                // Insert into post table
                mysqli_query($con, "INSERT INTO post (title, content, category_id, image) VALUES ('$title', '$content', $category_id, 'default_image.jpg')");
            }

            fclose($file);
            echo "Done imported successfully";
        } else {
            echo "Error reading the CSV file.";
        }
    } else {
        echo "No CSV file uploaded.";
    }
}
?>
