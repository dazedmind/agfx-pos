<?php
session_start();

// Unset user-related session variables
unset($_SESSION['username']);
// Add any other user-related session variables you want to unset

// Redirect the user to the login page or another page after logout
header('Location: ../login.php');
exit();
?>