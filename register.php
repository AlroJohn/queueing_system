<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input from the registration form
    $user = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password using SHA1
    $hashedPassword = sha1($password);

    // Database connection information
    include ('connection.php');

    // Check if the connection was successful
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Sanitize the user input to prevent SQL injection
    $user = mysqli_real_escape_string($conn, $user);

    // Insert the new user account into the 'accounts' table
    $sql = "INSERT INTO accounts (username, password) VALUES ('$user', '$hashedPassword')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to the login page after successful registration
        header("Location: index.php");
        exit();
    } else {
        // Handle the case where the insertion fails
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Registration</title>
</head>
<body>
    <h2>Registration</h2>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
