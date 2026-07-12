<?php
// Shows a final review of the order and saves it to the database.

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
if (!isset($_SESSION['pickup_time'])) {
    header("Location: pickup.php");
    exit;
}

// ---- Get cart items again ----
$ids = implode(",", array_map('intval', array_keys($_SESSION['cart'])));
$sql = "SELECT food_id, name, price FROM fooditems WHERE food_id IN ($ids)";
$result = $conn->query($sql);

$cartItems = array();
$grandTotal = 0;

while ($row = $result->fetch_assoc()) {
    $qty = $_SESSION['cart'][$row['food_id']];
    $subtotal = $qty * $row['price'];
    $grandTotal = $grandTotal + $subtotal;

    $row['quantity'] = $qty;
    $row['subtotal'] = $subtotal;
    $cartItems[] = $row;
}

// ---- Place the order ----
if (isset($_POST['place_order'])) {
    $user_id = $_SESSION['user_id'];
    $pickup_time = $_SESSION['pickup_time'];
    $notes = $conn->real_escape_string($_POST['notes']);

    // 1) Insert into orders
    $insertOrder = "INSERT INTO orders (user_id, pickup_time, total_price, notes, order_status)
                    VALUES ('$user_id', '$pickup_time', '$grandTotal', '$notes', 'Pending')";
    $conn->query($insertOrder);

    $order_id = $conn->insert_id;

    // 2) Insert each item into order_items
    foreach ($cartItems as $item) {
        $food_id = $item['food_id'];
        $qty = $item['quantity'];
        $price = $item['price'];
        $subtotal = $item['subtotal'];

        $insertItem = "INSERT INTO order_items (order_id, food_id, quantity, unit_price, subtotal)
                       VALUES ('$order_id', '$food_id', '$qty', '$price', '$subtotal')";
        $conn->query($insertItem);
    }

    // 3) Clear cart and pickup time
    $_SESSION['cart'] = array();
    unset($_SESSION['pickup_time']);

    header("Location: order_success.php?order_id=" . $order_id);
    exit;
}
?>
<html>
<head>
    <title>Checkout | Edge Express</title>
</head>
<body>

<div class="container py-5">
    <h1 class="page-title">Review Your Order</h1>

    <table class="table table-bordered bg-white" style="max-width:500px;">
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
        <?php foreach ($cartItems as $item) { ?>
        <tr>
            <td><?php echo htmlspecialchars($item['name']); ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td>Rs. <?php echo number_format($item['subtotal'], 2); ?></td>
        </tr>
        <?php } ?>
    </table>

    <p>Pickup Time: <strong><?php echo date("g:i A", strtotime($_SESSION['pickup_time'])); ?></strong></p>
    <p class="fs-4"><strong>Total: Rs. <?php echo number_format($grandTotal, 2); ?></strong></p>

    <form method="post" action="checkout.php" id="order-form" style="max-width:400px;">
        <label>Special instructions (optional):</label>
        <textarea name="notes" rows="3" class="form-control mb-3"></textarea>
        <button type="submit" name="place_order" value="1" class="btn btn-premium-login w-100">Place Order</button>
    </form>

    <br>
    <a href="pickup.php">Back to Pickup Time</a>
</div>

<script>
var orderForm = document.getElementById("order-form");
orderForm.addEventListener("submit", function(e) {
    var confirmed = confirm("Place this order?");
    if (!confirmed) {
        e.preventDefault();
    }
});
</script>

</body>
</html>
