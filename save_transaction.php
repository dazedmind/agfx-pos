<?php
session_start(); // Add this line at the beginning of your script

// Replace these variables with your actual database information
$host = "localhost"; // Your database host
$dbname = "pointofsale"; // Your database name
$username = "root"; // Your database username
$password = ""; // Your database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve data from the form
    // $productName = isset($_POST['productName']) ? $_POST['productName'] : '';
    $totalAmount = isset($_POST['grand-total-amount']) ? $_POST['grand-total-amount'] : '';

    if (!empty($totalAmount)) {
        // Insert data into the database
        $sql = "INSERT INTO pos_sales (totalAmount) VALUES (:totalAmount)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':totalAmount', $totalAmount);
        $stmt->execute();

        $_SESSION['status'] = "success";
        $_SESSION['transaction_success'] = true;

        // Return a success message if needed
        echo "Transaction saved successfully!";
        header('Location: index.php');
    } else {
        $_SESSION['status'] = "failed";
        $_SESSION['transaction_success'] = false;
        header('Location: index.php');

        echo 'Error: Missing data';
    }

    // Close the database connection
    $conn = null;

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
