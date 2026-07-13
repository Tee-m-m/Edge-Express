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
        $_SESSION['pickup_time'] = date("Y-m-d") . " " . $pickup_time . ":00";
        header("Location: checkout.php");
        exit;
    }
}

// Simple list of time slots (canteen open 8 AM - 6 PM)
$slots = array();
for ($hour = 8; $hour <= 17; $hour++) {
    $slots[] = str_pad($hour, 2, "0", STR_PAD_LEFT) . ":00";
    $slots[] = str_pad($hour, 2, "0", STR_PAD_LEFT) . ":30";
}
?>
<html>
<head>
    <title>Pickup Time | Edge.Express</title>
</head>
<body>

    <div class="container py-5">
        <h1 class="page-title">Choose a Pickup Time</h1>
        <p class="page-subtitle">Canteen hours: 8:00 AM - 6:00 PM</p>

        <?php if ($error != "") { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <form method="post" action="pickup.php" class="w-auto" style="max-width:300px;">
            <select name="pickup_time" class="form-control mb-3" required>
                <option value="">-- Select a time --</option>
            <?php foreach ($slots as $slot) { ?>
                <option value="<?php echo $slot; ?>"><?php echo $slot; ?></option>
            <?php } ?>
            </select>
            <button type="submit" class="btn btn-premium-login w-100">Continue to Checkout</button>
        </form>

    <br>
    <a href="cart.php">Back to Cart</a>
</div>

</body>
</html>
