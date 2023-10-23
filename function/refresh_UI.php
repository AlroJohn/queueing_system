<?php
include('../connection.php'); // Include your database connection file here

// Define an array to store records based on status
$records = array('Current' => array());

// Execute the SQL query to retrieve data
$sql = "SELECT * FROM system WHERE status = 'Current' ORDER BY id ASC";
$result = mysqli_query($conn, $sql); // Assuming you are using mysqli for database operations

// Check if the query was successful
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

  // Loop through the result set and categorize records based on status
  while ($row = mysqli_fetch_assoc($result)) {
    $status = $row['status'];
    $number = $row['number'];
    $department = $row['department'];

    // Categorize records based on status
    $records[$status][] = "<h3>$number<span hidden>$department</span></h3>";
}
// Return the updated content as a JSON response
echo json_encode($records);
?>
