<?php
    
    include('../connection.php'); // Include your database connection file here

    // Define an array to store records based on status
    $records = array('Current' => array());

    // Execute the SQL query to retrieve data
    $sql = "SELECT * FROM system ORDER BY id ASC";
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
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../images/divine_logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/UI_stylers.css">
    <style>

    </style>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>DWCL - Cashier</title>
</head>
<body>
    <!-- HEADER -->
    <div class="all_columns">
        <!-- Column for "Assessment" -->
        <div class="current" id="assessmentSection">
            <h2>Assessment</h2>
            <div class="queueContent">
                <!-- Content to be refreshed -->
                <?php
                // Display records for the "Assessment" section
                foreach ($records['Current'] as $record) {
                    if (strpos($record, 'Assessment') !== false) {
                        echo $record;
                    }
                }
                ?>
            </div>
        </div>


        <!-- Column for "Cashier" -->
        <div class="current" id="cashierSection">
            <h2>Cashier</h2>
            <div class="queueContent">
                <!-- Content to be refreshed -->
                <?php
                // Display records for the "Cashier" section
                foreach ($records['Current'] as $record) {
                    if (strpos($record, 'Cashier') !== false) {
                        echo $record;
                    }
                }
                ?>
            </div>
        </div>

        <!-- Column for "Registrar" -->
        <div class="current" id="registrarSection">
            <h2>Registrar</h2>
            <div class="queueContent">
                <!-- Content to be refreshed -->
                <?php
                // Display records for the "Registrar" section
                foreach ($records['Current'] as $record) {
                    if (strpos($record, 'Registrar') !== false) {
                        echo $record;
                    }
                }
                ?>
            </div>
        </div>

    </div>

    <script>
    function refreshQueueSection() {
        // Send an AJAX request to a PHP script to fetch the latest data for the "Queue" section
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../function/refresh_UI.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Parse the JSON response
                var responseData = JSON.parse(xhr.responseText);

                // Filter and display records for the "Assessment" section
                displayRecords(responseData['Current'], 'Assessment', 'assessmentSection');

                // Filter and display records for the "Cashier" section
                displayRecords(responseData['Current'], 'Cashier', 'cashierSection');

                // Filter and display records for the "Registrar" section
                displayRecords(responseData['Current'], 'Registrar', 'registrarSection');
            }
        };
        xhr.send();
    }

    // Function to filter and display records for a specific section
    function displayRecords(records, department, sectionId) {
        var section = document.getElementById(sectionId);
        var queueSection = section.querySelector(".queueContent");
        queueSection.innerHTML = ""; // Clear existing content

        records.forEach(function (record) {
            if (record.indexOf(department) !== -1) {
                queueSection.innerHTML += record;
            }
        });
    }

    // Call the refreshQueueSection function periodically (e.g., every 5 seconds)
    setInterval(refreshQueueSection, 1000); // 5000 milliseconds = 5 seconds
</script>



</body>
</html>