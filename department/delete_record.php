<?php
include('../connection.php');

// Check if the ID parameter is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the DELETE statement
    $query = "DELETE FROM system WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Check if the statement preparation was successful
    if ($stmt === false) {
        die(json_encode(["success" => false, "message" => "Error preparing statement: " . mysqli_error($conn)]));
    }

    // Bind the parameter and execute the statement
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Check if the statement execution was successful
    if (mysqli_stmt_execute($stmt)) {
        // Close the statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        // Return a success response
        echo json_encode(["success" => true, "message" => "Record deleted successfully"]);
    } else {
        // Handle the case when execution fails
        echo json_encode(["success" => false, "message" => "Error executing statement: " . mysqli_stmt_error($stmt)]);
    }
} else {
    // Handle the case when ID is not provided
    echo json_encode(["success" => false, "message" => "Error: ID parameter not provided"]);
}
?>
