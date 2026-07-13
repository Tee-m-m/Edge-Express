<?php

session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin"){
    header("Location: ../login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "edge_express";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "Connection Failed! <br>";
}

//Handle status update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];

    $sql_update = "UPDATE orders SET order_status='$new_status' WHERE order_id = '$order_id'";
    $conn->query($sql_update);
    header("Location: manage_orders.php");
    exit;
}

//Fetch all orders with user information
$sql_orders = "SELECT orders.order_id, orders.pickup_time, orders.order_status, users.full_name AS user_name
              FROM orders JOIN users ON orders.user_id = users.user_id
              ORDER BY orders.order_id DESC";

$result_orders = $conn->query($sql_orders);
?>

<html>
    <head>
        <title>Manage Orders</title>
    </head>
    <body>
        <div class="manage-orders">
            <img src="../Resources/EE logo.png">
            <h1>Manage Orders</h1>
            <a href="dashboard.php">Back to Dashboard</a>

            <?php 
            if ($result_orders->num_rows > 0) {
                echo "<table>";
                    echo "<tr><th>Order ID</th><th>User</th><th>Pickup Time</th><th>Status</th><th>Update</th></tr>";
                    while ($order = $result_orders->fetch_assoc()) {
                        echo "<tr>";
                            echo "<td>" . $order["order_id"] . "</td>";
                            echo "<td>" . $order["user_name"] . "</td>";
                            echo "<td>" . $order["pickup_time"] . "</td>";
                            echo "<td>" . $order["order_status"] . "</td>";
                            echo "<td>
                                <form method = 'POST' action='manage_orders.php' name='formorder'>
                                    <input type='hidden' name='order_id' value='" . $order["order_id"] . "'>
                                    <select name='status'>
                                        <option value='Pending'" . ($order["order_status"] == "Pending" ? " selected" : "") . ">Pending</option>
                                        <option value='Preparing'" . ($order["order_status"] == "Preparing" ? " selected" : "") . ">Preparing</option>
                                        <option value='Ready'" . ($order["order_status"] == "Ready" ? " selected" : "") . ">Ready</option>
                                    </select>
                                    <input type='submit' name='update_status' value='Update'>
                                </form>
                            </td>";
                            echo "</tr>";
                    }
                echo "</table>";
            }
            else{
                echo "No orders found!";
            }
            ?>
        </div>
    </body>
</html>