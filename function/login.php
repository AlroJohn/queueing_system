<?php
session_start();
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize the username input to prevent SQL injection
    $user = mysqli_real_escape_string($conn, $user);

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM accounts WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // Verify the entered password using a secure hashing algorithm (e.g., bcrypt)
            if (sha1($password) === $row['password']) {
                $_SESSION['id_acc'] = $row['id_acc'];
                // Redirect to the appropriate department based on user role
                if ($user === 'assessment') {
                    echo '<script>alert("Welcome to Divine World College of Legazpi Queueing System!"); window.location.href = "../department/assessment.php";</script>';
                } elseif ($user === 'cashier') {
                    echo '<script>alert("Welcome to Divine World College of Legazpi Queueing System!"); window.location.href = "../department/cashier.php";</script>';
                } elseif ($user === 'registrar') {
                    echo '<script>alert("Welcome to Divine World College of Legazpi Queueing System!"); window.location.href = "../department/registrar.php";</script>';
                }elseif ($user === 'admin') {
                    echo '<script>alert("Welcome to Divine World College of Legazpi Queueing System!"); window.location.href = "../mvc/index.php";</script>';
                }
                exit();
            } else {
                echo '<script>alert("Email and Password not correct! Please try again"); window.location.href = "../index.php";</script>';
            }
        } else {
            echo '<script>alert("Username not found"); window.location.href = "../index.php";</script>';
        }
    } else {
        echo '<script>alert("Database query failed: ' . mysqli_error($conn) . '"); window.location.href = "../index.php";</script>';
    }
}
?>
