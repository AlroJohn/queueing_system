<?php
include('../connection.php'); // Include your database connection file here

// Define an array to store records based on status
$records = array('Queue' => array(), 'Current' => array(), 'Pending' => array());

// Execute the SQL query to retrieve data
$sql = "SELECT * FROM `system` WHERE `department` = 'Assessment' ORDER BY id ASC";
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
    $records[$status][] = "<h3>$number - $department</h3>";
}
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
        // Display records for the "Queue" section
        foreach ($records['Queue'] as $record) {
            echo $record;
        }
        ?>
        <button id="nextButton">Next</button>
    </div>

    <div class="column">
        <h2>Current</h2>
        <?php
        // Display records for the "Current" section
        foreach ($records['Current'] as $record) {
            echo $record;
        }
        ?>
        <button id="nextButton2">Next2</button>
    </div>

    <div class="column">
        <h2>Pending</h2>
        <?php
        // Display records for the "Pending" section
        foreach ($records['Pending'] as $record) {
            echo $record;
        }
        ?>
        <button id="nextButton3">Next3</button>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
    // Function to handle the "Next" button click
    function handleNextButton(section, nextButtonId, action) {
        var nextButton = document.getElementById(nextButtonId);
        nextButton.addEventListener("click", function () {
            // Send an AJAX request to a PHP script to update the database
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../function/update.php", true);
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
            xhr.open("POST", "../function/update.php", true);
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

        var queueSection = document.querySelector(".column:nth-child(1)");
        var currentSection = document.querySelector(".column:nth-child(2)");
        var pendingSection = document.querySelector(".column:nth-child(3)");

        // Call the functions for both "Next" and "Next2" buttons
        handleNextButton(queueSection, "nextButton", "updateQueue");
        handleNext2Button(currentSection, "nextButton2", "updateCurrentToPending");
        handleNextButton(pendingSection, "nextButton3", "updatePending");
    });

    </script>
</body>
</html>
