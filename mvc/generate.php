<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $number = $_GET['number'] ?? 1;
    if ($number <= 100) {
        echo json_encode(['number' => $number]);
    } elseif ($number >= 100) {
        // Reset the number to 1
        $number = 1;
        echo json_encode(['number' => $number]);
    } else {
        echo json_encode(['number' => 'Queue is empty']);
    }
}
?>
