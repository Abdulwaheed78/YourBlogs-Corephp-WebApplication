<?php
include "conn.php";

// Fetch data from the comments table
$query = "SELECT name, email, created_at FROM comments";
$result = $con->query($query);

// Prepare CSV or Excel content based on user's choice
$exportType = isset($_GET['type']) ? strtolower($_GET['type']) : 'csv';

if ($exportType === 'csv') {
    // Prepare CSV content
    $content = "Name,Email,Created At\n"; // Add your column headers

    while ($row = $result->fetch_assoc()) {
        $name = str_replace('"', '""', $row['name']);
        $email = str_replace('"', '""', $row['email']);
        $created_at = $row['created_at'];

        $content .= "\"$name\",\"$email\",\"$created_at\"\n";
    }

    // Set response headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="comments_records.csv"');

    // Output CSV content
    echo $content;
} elseif ($exportType === 'excel') {
    // Prepare Excel content
    $excelData = array();

    while ($row = $result->fetch_assoc()) {
        $excelData[] = array(
            'Name' => $row['name'],
            'Email' => $row['email'],
            'Created At' => $row['created_at']
        );
    }

    // Set response headers for Excel download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="comments_records.xlsx"');

    // Output Excel content
    $output = fopen('php://output', 'w');
    fputcsv($output, array_keys($excelData[0])); // Excel column headers
    foreach ($excelData as $row) {
        fputcsv($output, $row);
    }
}

// Close the database connection
$con->close();
?>
