<?php
// logout.php (Located in Edge-Express/ root directory)
session_start();

// 1. Unset all session variables
$_SESSION = array();

// 2. Destroys the session cookie in the user's browser completely
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Destroy the session file on the XAMPP server
session_destroy();

// 4. Send the user back to the main landing page or login screen cleanly
echo "<script>
        alert('Logged out successfully. Session reset.');
        window.location.href = 'login.html';
      </script>";
exit();
?>
