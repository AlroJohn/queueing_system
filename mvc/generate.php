<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $number = $_GET['number'] ?? 1;
    $limit = 100; // Define the loop limit here

    if ($number <= $limit) {
        echo json_encode(['number' => $number]);
    } else {
        // Calculate the new number within the range 1 to $limit
        $newNumber = ($number - 1) % $limit + 1;
        echo json_encode(['number' => $newNumber]);
    }
}

?>
