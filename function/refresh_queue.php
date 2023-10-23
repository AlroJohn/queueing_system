<?php
include('../connection.php'); // Include your database connection file here

// Execute an SQL query to retrieve the latest "Queue" records
$sql = "SELECT * FROM system WHERE department = 'Assessment' AND status = 'Queue' ORDER BY id ASC";
$result = mysqli_query($conn, $sql); // Assuming you are using mysqli for database operations

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

// Generate HTML for the "Queue" records
$html = '';
while ($row = mysqli_fetch_assoc($result)) {
    $number = $row['number'];
    $html .= "<h3>$number</h3>";
}

// Return the generated HTML as the response
echo $html;
?>