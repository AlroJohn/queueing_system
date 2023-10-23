<?php
include('../connection.php'); // Include your database connection file here

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
    if ($_POST["action"] == "updateQueue") {
        // Retrieve the lowest ID record from the "Queue" section
        $sqlSelect = "SELECT * FROM system WHERE `department` = 'Registrar' AND `status` = 'Queue' ORDER BY id ASC";
        $resultSelect = mysqli_query($conn, $sqlSelect);

        if (!$resultSelect) {
            die("Database query failed: " . mysqli_error($conn));
        }

        // Fetch the selected row
        $row = mysqli_fetch_assoc($resultSelect);

        if ($row) {
            $number = $row['number'];
            $department = $row['department'];

            // Update the status of the record to "Current"
            $sqlUpdate = "UPDATE system SET status = 'Current' WHERE id = {$row['id']}";
            $resultUpdate = mysqli_query($conn, $sqlUpdate);

            if (!$resultUpdate) {
                die("Database update failed: " . mysqli_error($conn));
            }

            // Return the updated item as a response
            echo "<h3>$number</h3>";
        }
    } elseif ($_POST["action"] == "updateCurrentToPending") {
        // Retrieve the lowest ID record from the "Current" section
        $sqlSelect = "SELECT * FROM system WHERE `department` = 'Registrar' AND status = 'Current' ORDER BY id ASC";
        $resultSelect = mysqli_query($conn, $sqlSelect);

        if (!$resultSelect) {
            die("Database query failed: " . mysqli_error($conn));
        }
        // Fetch the selected row
        $row = mysqli_fetch_assoc($resultSelect);

        if ($row) {
            $number = $row['number'];
            $department = $row['department'];

            // Update the status of the record to "Pending"
            $sqlUpdate = "UPDATE system SET status = 'Pending' WHERE id = {$row['id']}";
            $resultUpdate = mysqli_query($conn, $sqlUpdate);

            if (!$resultUpdate) {
                die("Database update failed: " . mysqli_error($conn));
            }

            // Return the updated item as a response
            echo "<h3>$number</h3>";
        }
    }elseif ($_POST["action"] == "updatePending"){
        // Retrieve the lowest ID record from the "Current" section
        $sqlSelect = "SELECT * FROM system WHERE `department` = 'Registrar' AND status = 'Pending' ORDER BY id ASC";
        $resultSelect = mysqli_query($conn, $sqlSelect);

        if (!$resultSelect) {
            die("Database query failed: " . mysqli_error($conn));
        }
        // Fetch the selected row
        $row = mysqli_fetch_assoc($resultSelect);

        if ($row) {
            $number = $row['number'];
            $department = $row['department'];

            // Update the status of the record to "Pending"
            $sqlUpdate = "DELETE FROM system WHERE status = 'Pending' AND id = {$row['id']}";

            $resultUpdate = mysqli_query($conn, $sqlUpdate);

            if (!$resultUpdate) {
                die("Database update failed: " . mysqli_error($conn));
            }

            // Return the updated item as a response
            echo "<h3>$number</h3>";
        }
    }elseif ($_POST["action"] == "undo"){
        // Retrieve the lowest ID record from the "Current" section
        $sqlSelect = "SELECT * FROM system WHERE `department` = 'Registrar' AND status = 'Current' ORDER BY id DESC";
        $resultSelect = mysqli_query($conn, $sqlSelect);
        
        if (!$resultSelect) {
            die("Database query failed: " . mysqli_error($conn));
        }
        // Fetch the selected row
        $row = mysqli_fetch_assoc($resultSelect);
        
        if ($row) {
            $number = $row['number'];
            $department = $row['department'];
        
            // Update the status of the record to "Pending"
            $sqlUpdate = "UPDATE system SET status = 'Queue' WHERE id = {$row['id']}";
            $resultUpdate = mysqli_query($conn, $sqlUpdate);
        
            if (!$resultUpdate) {
                die("Database update failed: " . mysqli_error($conn));
            }
        
            // Return the updated item as a response
            echo "<h3>$number</h3>";
        }
        
            
    }
}
?>