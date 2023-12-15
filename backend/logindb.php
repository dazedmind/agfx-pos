<?php
session_start();

// Replace these variables with your actual database information
$host = "localhost"; // Your database host
$dbname = "pointofsale"; // Your database name
$username = "root"; // Your database username
$password = ""; // Your database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve username and password from the form
    $usernameInput = isset($_POST['username']) ? $_POST['username'] : '';
    $passwordInput = isset($_POST['password']) ? $_POST['password'] : '';

    // Check if both username and password are provided
    if (!empty($usernameInput) && !empty($passwordInput)) {
        // Check the database for the username and password
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $usernameInput);
        $stmt->bindParam(':password', $passwordInput);
        $stmt->execute();

        // Fetch the user
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Set user information in the session (you can customize this based on your user structure)
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to index.php
            header('Location: ../index.php');
            exit();
        } else {
            // Invalid credentials, redirect to a login page with an error message
            header('Location: login.php?error=invalid_credentials');
            exit();
        }
    } else {
        // Username or password not provided, redirect to a login page with an error message
        header('Location: login.php?error=missing_credentials');
        exit();
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
