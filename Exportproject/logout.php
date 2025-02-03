<?php
// Start session
session_start();

// Unset session variables
unset($_SESSION["username"]);
unset($_SESSION["logged_in"]);

// Destroy session
session_destroy();

// Redirect to login page
header("Location:../index.php");
exit();
?>
