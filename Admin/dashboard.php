<?php

session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin"){
    header("Location: ../login.php");
    exit;
}
?>

<html>
    <head>
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="../Assets/css/style.css">
        <link rel="stylesheet" href="../Assets/admincss/dashboard.css">
    </head>
    <body>
        <div class="site-logo">
            <img src="../Resources/EE logo.png">
        </div>
        <div class="admin-header">
            <h1 class="welcome-pill">ආයුබෝවන් | WELCOME</h1>
            <h1 class="admin-name"><?php echo $_SESSION["user_name"]; ?>!</h1>
            <h1 class="admin-subtitle">to the Admin Dashboard</h1>
            <?php
            if(isset($_GET['login']) && $_GET['login'] == 'success') { ?>
            <script>
                alert("Login successful! Welcome to the Admin Dashboard");
            </script>
            <?php } ?>
            <a href="../logout.php">
                <button>Logout</button>
            </a>
        </div>
        <div class="admin_btn_section">
            <a href="manage_food.php">
                <button><h2>Manage Food</h2><br>
                    <p>Add, Edit or Delete items here!</p></button>
            </a>
            <a href="manage_orders.php">
                <button><h2>Manage Orders</h2><br>
                    <p>Manage customer orders here!</p></button>
            </a>
        </div>
    </body>
</html>