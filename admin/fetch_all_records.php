<?php
include "conn.php";

// Fetch all records
$result = mysqli_query($con, "SELECT * FROM comments LEFT JOIN post ON comments.post_id = post.id");

// Fetch the data into an associative array
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Close the connection
mysqli_close($con);

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
