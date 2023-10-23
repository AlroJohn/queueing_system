<?php
include('../connection.php');

// Retrieve data from JavaScript (you should validate and sanitize this data)
$number = $_GET["number"];
$department = $_GET["department"];

//if the number is the same with the number inside the database(number AND department == )

// Prepare and execute an INSERT query
$sql = "INSERT INTO system (`number`, `department`, `status`) VALUES ('$number', '$department', 'Queue')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => $conn->error]);
}

// Close the database connection
$conn->close();
?>
