<?php
// Choose a pickup time for the order.

session_start();
include '../config/edge_express.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit;
}

if (count($_SESSION['cart']) == 0) {
    header("Location: cart.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $pickup_time = $_POST['pickup_time'];

    if ($pickup_time == "") {

        $error = "Please choose a pickup time.";

    } else {

        $pickup_datetime = date("Y-m-d") . " " . $pickup_time . ":00";

        $user_id = $_SESSION['user_id'];

        $total = 0;

        // Calculate total
        foreach($_SESSION['cart'] as $food_id => $qty){

            $food_id = (int)$food_id;

            $result = $conn->query("SELECT price FROM fooditems WHERE food_id='$food_id'");

            $food = $result->fetch_assoc();

            $total += $food['price'] * $qty;
        }

        // Create Order
        $conn->query("
            INSERT INTO orders(user_id,pickup_time,total_price,order_status)
            VALUES('$user_id','$pickup_datetime','$total','Pending')
        ");

        $order_id = $conn->insert_id;

        // Insert order items
        foreach($_SESSION['cart'] as $food_id => $qty){

            $food_id = (int)$food_id;

            $result = $conn->query("SELECT price FROM fooditems WHERE food_id='$food_id'");

            $food = $result->fetch_assoc();

            $price = $food['price'];

            $subtotal = $price * $qty;

            $conn->query("
                INSERT INTO order_items(order_id,food_id,quantity,unit_price,subtotal)
                VALUES('$order_id','$food_id','$qty','$price','$subtotal')
            ");
        }

        // Empty cart
        unset($_SESSION['cart']);

        header("Location: order_success.php?order_id=".$order_id);

        exit();

    }

}

// Simple list of time slots (canteen open 8 AM - 6 PM)
$slots = array();
for ($hour = 8; $hour <= 17; $hour++) {
    $slots[] = str_pad($hour, 2, "0", STR_PAD_LEFT) . ":00";
    $slots[] = str_pad($hour, 2, "0", STR_PAD_LEFT) . ":30";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edge.Express | Pickup Time</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../Assets/css/style.css">
    <link rel="stylesheet" href="../Assets/css/cart.css">
    <link rel="stylesheet" href="../Assets/css/navbar.css">
    <link rel="stylesheet" href="../Assets/css/hero.css">
    <link rel="stylesheet" href="../Assets/css/sections.css">
    <link rel="stylesheet" href="../Assets/css/animations.css">
    <link rel="stylesheet" href="../Assets/css/responsive.css">
    <link rel="stylesheet" href="../Assets/css/pickup.css">

</head>

<body>

<div class="background-blur blur1"></div>
<div class="background-blur blur2"></div>

<nav class="navbar">

    <div class="logo">

        <img src="../Resources/EE logo.png" alt="Edge Express Logo">
        Edge Express

    </div>

    <ul>

        <li><a href="index.php">Home</a></li>
        <li><a href="menu.php">Menu</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>

    </ul>

    <div class="nav-btn">
        <a href="../User_management/profile.php">My profile</a>
    </div>

</nav>

<div class="auth-wrapper">

    <div class="auth-card">

    <div class="pickup-icon">
    <i class="fas fa-clock"></i>
</div>

        <h1 class="page-title">Choose a Pickup Time</h1>
        <p class="page-subtitle">Canteen hours: 8:00 AM - 6:00 PM</p>

        <?php if ($error != "") { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <form method="post" action="pickup.php">

            <select name="pickup_time" class="form-control mb-3" required>
                <option value="">-- Select a time --</option>
            <?php foreach ($slots as $slot) { ?>
                <option value="<?php echo $slot; ?>"><?php echo $slot; ?></option>
            <?php } ?>
            </select>

            <button type="submit" class="btn-premium-login w-100">Continue to Checkout</button>

        </form>

        <p class="footer-text" style="margin-top:20px; text-align:center;">
            <a href="cart.php" class="footer-link-register">Back to Cart</a>
        </p>

    </div>

</div>

</body>
</html>