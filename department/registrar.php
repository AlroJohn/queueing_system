<?php
include('../connection.php'); // Include your database connection file here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>3-Column Layout</title>
</head>
<body>
    <div class="column">
        <h2>Queue</h2>
        <?php
        // Execute the SQL query to retrieve data
        $sql = "SELECT * FROM `system` ORDER BY id ASC";
        $result = mysqli_query($conn, $sql); // Assuming you are using mysqli for database operations
       
        // Check if the query was successful
        if (!$result) {
            die("Database query failed: " . mysqli_error($conn));
        }
        // Loop through the result set and display each row
        while ($row = mysqli_fetch_assoc($result)) {
            $department=$row['department'];
            if($department=='Registrar'){
                $number = $row['number'];
            $department = $row['department'];
            echo "<h3>$number - $department</h3>";
            }
            // You can also include additional content for each row here
        }
        ?>
    </div>
   
    
</body>
</html>
