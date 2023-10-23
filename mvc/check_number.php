<?php
include ('../connection.php');

// Department parameter from the client-side AJAX request
$department = $_GET['department'];

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute a query to check if the number is available for the department
$query = "SELECT number FROM `system` WHERE department = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $department);
$stmt->execute();
$stmt->store_result();

$response = array();

if ($stmt->num_rows == 0) {
    // Number is available
    $response['available'] = true;
} else {
    // Number has already been generated
    $response['available'] = false;
}

// Close the database connection
$stmt->close();
$conn->close();

// Send the JSON response back to the client
header('Content-Type: application/json');
echo json_encode($response);
?>
