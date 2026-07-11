//User_management
<?php
// logout.php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the actual session on the server
session_destroy();

// Redirect the user back to your login page
header("Location: login.html");
exit();
?>
