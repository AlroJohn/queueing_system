<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['id_acc'])) {
    header("Location: ../index.php");
    exit();
}

    // Display user information or dashboard content here

    include('../connection.php'); // Include your database connection file here

    // Define an array to store records based on status
    $records = array('Queue' => array(), 'Current' => array(), 'Pending' => array());
    $current = array('Queue' => array(), 'Current' => array(), 'Pending' => array());

    // Execute the SQL query to retrieve data
    $sql = "SELECT * FROM system WHERE department = 'Registrar' ORDER BY id ASC";
    $result = mysqli_query($conn, $sql); // Assuming you are using mysqli for database operations

    // Check if the query was successful
    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }

    // Loop through the result set and categorize records based on status
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $status = $row['status'];
        $number = $row['number'];

        // Categorize records based on status
        $records[$status][] = "<h3>$number</h3>";
        $current[$status][] = "<h3 onclick='deleteRecord($id)'>$number </h3>";
    }
        // JavaScript function to handle record deletion
        echo "<script>
        function deleteRecord(id) {
            if (confirm('Are you sure you want to delete this ENTRY NUMBER??')) {
                // Make an AJAX request to delete the record by ID
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Reload the page or update the UI as needed
                        location.reload(); // You may want to use AJAX to update the UI without a page reload
                    }
                };
                xhr.open('GET', 'delete_record.php?id=' + id, true);
                xhr.send();
            }
        }
        </script>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../images/divine_logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_departments.css">
    <link rel="stylesheet" href="../css/navi3.css">
    <title>DWCL - Registrar</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!-- HEADER -->
    <div class="header">
            <a href="../logout.php" class="login__submit" value="Logout">
            <i class="fa-solid fa-power-off"></i>
                <span class="button__text">Logout</span>
            </a>
            <img src="../images/divine_logo.png" alt="DWCL">
            <h3 class="assessment_title">DWCL registrar</h3>
        </div>
    <!-- Columns -->

    <div class="column" id="queueSection">
    <br>
        <h2>Queue</h2>
        <div id="queueContent">
            <!-- Content to be refreshed -->
            <?php
            // Display records for the "Queue" section
            foreach ($records['Queue'] as $record) {
                echo $record;
            }
            ?>
        </div>
        <!-- Button outside of the refreshed content -->
        <button id="nextButton">Next</button>
    </div>

    <div class="column">
    <br>
        <h2>Current<i id="nextButton4" class='bx bx-undo'></i></h2>
        <?php
        // Display records for the "Current" section
        foreach ($current['Current'] as $record) {
            echo $record;
        }
        ?>
        <button id="nextButton2">Current</button>
    </div>

    <div class="column">
    <br>
        <h2>Pending</h2>
        <?php
        // Display records for the "Pending" section
        foreach ($records['Pending'] as $record) {
            echo $record;
        }
        ?>
        <button id="nextButton3">Dequeue</button>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
    // Function to handle the "Next" button click
    function handleNextButton(section, nextButtonId, action) {
        var nextButton = document.getElementById(nextButtonId);
        nextButton.addEventListener("click", function () {
            // Send an AJAX request to a PHP script to update the database
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../function/registrar.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // If the update was successful, remove the displayed item from the section
                    var elementToRemove = section.querySelector("h3:first-child");
                    if (elementToRemove) {
                        elementToRemove.parentNode.removeChild(elementToRemove);
                    }

                    // Add the updated item to the section
                    var updatedItem = xhr.responseText;
                    section.innerHTML += updatedItem;

                    // Check if there are more items in the "Queue" section
                    if (section === queueSection) {
                        var queueItems = document.querySelectorAll(".column:nth-child(1) h3");
                        if (queueItems.length === 0) {
                            nextButton.disabled = true; // Disable the button when no more items in "Queue"
                        }
                    }

                    // Refresh the page after a successful update
                    location.reload();
                }
            };
            xhr.send("action=" + action);
        });
    }

    // Define a function to handle the "Next2" button click
    function handleNext2Button(section, nextButtonId, action) {
        var nextButton = document.getElementById(nextButtonId);
        nextButton.addEventListener("click", function () {
            // Send an AJAX request to a PHP script to update the database (similar to the "Next" button)
            // You can use a different action for the "Next2" button, e.g., "updateCurrentToPending"
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../function/registrar.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // If the update was successful, remove the displayed item from the section
                    var elementToRemove = section.querySelector("h3:first-child");
                    if (elementToRemove) {
                        elementToRemove.parentNode.removeChild(elementToRemove);
                    }

                    // Add the updated item to the section (similar to the "Next" button)
                    var updatedItem = xhr.responseText;
                    section.innerHTML += updatedItem;

                    // Refresh the page after a successful update
                    location.reload();
                }
            };
            xhr.send("action=" + action);
        });
    }

        var queueSection = document.querySelector(".column:nth-child(2)");
        var currentSection = document.querySelector(".column:nth-child(3)");
        var pendingSection = document.querySelector(".column:nth-child(4)");

        // Call the functions for both "Next" and "Next2" buttons
        handleNextButton(queueSection, "nextButton", "updateQueue");
        handleNext2Button(currentSection, "nextButton2", "updateCurrentToPending");
        handleNextButton(pendingSection, "nextButton3", "updatePending");
        handleNext2Button(currentSection, "nextButton4", "undo");
    });

    </script>
    <script>
        function refreshQueueSection() {
            var queueSection = document.getElementById("queueContent");

            // Send an AJAX request to a PHP script to fetch the latest data for the "Queue" section
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../function/refresh_registrar.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Update the content of the "Queue" section with the fetched data
                    queueSection.innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        // Call the refreshQueueSection function periodically (e.g., every 5 seconds)
        setInterval(refreshQueueSection, 1000); // 5000 milliseconds = 5 seconds
    </script>
</body>
</html>