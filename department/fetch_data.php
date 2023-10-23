<?php
include("../connection.php");

// Create an empty string to store the HTML content
$html = '';

// Function to fetch the lowest and second-lowest numbers for a department
function fetchLowestNumbers($conn, $department) {
    $query = "SELECT MIN(number) AS lowest_number FROM `system` WHERE department = '$department' AND status = 'Current'";
    $result = mysqli_query($conn, $query);
    $row1 = mysqli_fetch_assoc($result);
    $lowest_number = $row1['lowest_number'];

    // Initialize second lowest number as null
    $second_lowest_number = null;

    if ($lowest_number !== null) {
        // If there's a lowest number, fetch the second lowest
        $query = "SELECT MIN(number) AS second_lowest_number FROM `system` WHERE department = '$department' AND status = 'Current' AND number > $lowest_number";
        $result = mysqli_query($conn, $query);
        $row2 = mysqli_fetch_assoc($result);

        if ($row2 !== null) {
            $second_lowest_number = $row2['second_lowest_number'];
        }
    }

    return [$lowest_number, $second_lowest_number];
}

// Fetch and format data for Assessment
list($lowest_number_assessment, $second_lowest_number_assessment) = fetchLowestNumbers($conn, 'Assessment');
$html .= '<tr><th class="department_assessment" colspan="2">Assessment</th></tr><tr>'; // Start a single <tr> for both columns
$html .= '<td class="first_column">' . ($lowest_number_assessment !== null ? $lowest_number_assessment : '') . '</td>';
$html .= '<td class="second_column">' . ($second_lowest_number_assessment !== null ? $second_lowest_number_assessment : '') . '</td>';

// Fetch and format data for Cashier
list($lowest_number_cashier, $second_lowest_number_cashier) = fetchLowestNumbers($conn, 'Cashier');
$html .= '<tr><th class="department_cashier" colspan="2">Cashier</th></tr><tr>'; // Start a single <tr> for both columns
$html .= '<td class="first_column">' . ($lowest_number_cashier !== null ? $lowest_number_cashier : '') . '</td>';
$html .= '<td class="second_column">' . ($second_lowest_number_cashier !== null ? $second_lowest_number_cashier : '') . '</td>';

// Fetch and format data for Registrar
list($lowest_number_registrar, $second_lowest_number_registrar) = fetchLowestNumbers($conn, 'Registrar');
$html .= '<tr><th class="department_registrar" colspan="2">Registrar</th></tr><tr>'; // Start a single <tr> for both columns
$html .= '<td class="first_column">' . ($lowest_number_registrar !== null ? $lowest_number_registrar : '') . '</td>';
$html .= '<td class="second_column">' . ($second_lowest_number_registrar !== null ? $second_lowest_number_registrar : '') . '</td>';

$html .= '</tr>'; // Close the single <tr> for both columns

echo $html;
?>
