<?php
// Shows the cart. Also handles adding, updating, and removing items.

session_start();
include '../config/edge_express.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// ---- Add item to cart (menu.php sends food_id + quantity here) ----
if (isset($_POST['action']) && $_POST['action'] == "add") {
    $food_id = intval($_POST['food_id']);
    $quantity = intval($_POST['quantity']);
    if ($quantity < 1) {
        $quantity = 1;
    }

    if (isset($_SESSION['cart'][$food_id])) {
        $_SESSION['cart'][$food_id] = $_SESSION['cart']
        [$food_id] + $quantity;
    } else {
        $_SESSION['cart'][$food_id] = $quantity;
    }
}

// ---- Update quantities ----
if (isset($_POST['action']) && $_POST['action'] == "update") {
    foreach ($_POST['qty'] as $food_id => $qty) {
        $food_id = intval($food_id);
        $qty = intval($qty);
        if ($qty <= 0) {
            unset($_SESSION['cart'][$food_id]);
        } else {
            $_SESSION['cart'][$food_id] = $qty;
        }
    }
}

// ---- Remove single item ----
if (isset($_GET['remove'])) {
    $food_id = intval($_GET['remove']);
    unset($_SESSION['cart'][$food_id]);
    header("Location: cart.php");
    exit;
}
// ---- Get cart items from database ----
$cartItems = array();
$grandTotal = 0;

if (count($_SESSION['cart']) > 0) {
    $ids = implode(",", array_map('intval', array_keys($_SESSION['cart'])));
    $sql = "SELECT food_id, name, price, image FROM fooditems WHERE food_id IN ($ids)";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $qty = $_SESSION['cart'][$row['food_id']];
        $subtotal = $qty * $row['price'];
        $grandTotal = $grandTotal + $subtotal;

        $row['quantity'] = $qty;
        $row['subtotal'] = $subtotal;
        $cartItems[] = $row;
    }
}
?>
<html>
<head>
    <title>Your Cart | Edge.Express</title>
</head>
<body>

    <div class="container py-5">
        <h1 class="page-title">Your Cart</h1>

        <?php if (count($cartItems) == 0) { ?>
        <p class="page-subtitle">Your cart is empty.</p>
        <a href="../index.php" class="btn btn-premium-login">Back to Menu</a>

        <?php } else { ?>

        <form method="post" action="cart.php">
            <input type="hidden" name="action" value="update">

            <table class="table table-bordered bg-white">
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr><?php foreach ($cartItems as $item) { ?>
                    <tr>
                        <td>
                            <img src="../Resources/<?php echo htmlspecialchars($item['image']); ?>" width="50" style="margin-right:10px;">
                        <?php echo htmlspecialchars($item['name']); ?>
                        </td>
                        <td>Rs. <?php echo number_format($item['price'], 2); ?></td>
                        <td>
                            <input type="number" name="qty[<?php echo $item['food_id']; ?>]"
                            value="<?php echo $item['quantity']; ?>" min="0" max="20" class="form-control" style="width:80px;">
                        </td>
                        <td>Rs. <?php echo number_format($item['subtotal'], 2); ?></td>
                        <td><a href="cart.php?remove=<?php echo $item['food_id']; ?>" class="remove-link">Remove</a></td>
                    </tr>
                <?php } ?>
                </table>

            <p class="fs-4"><strong>Grand Total: Rs. <?php echo number_format($grandTotal, 2); ?></strong></p>

            <button type="submit" class="btn btn-secondary">Update Cart</button>
        </form>

    <br>
    <a href="pickup.php" class="btn btn-premium-login">Proceed to Pickup Time</a>

    <?php } ?>
</div>

<a href="cart.php" class="floating-cart-btn" style="position: fixed; bottom: 30px; right: 30px; text-decoration: none; z-index: 999;">
    <div style="background: #00ADB5; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(0,0,0,0.2); position: relative;">
        <i class="fas fa-shopping-cart" style="font-size: 24px;"></i>
        
        <!-- Only display the red badge if there are items inside the cart memory -->
        <?php if ($total_items > 0) { ?>
            <span style="position: absolute; top: -5px; right: -5px; background: #ff4757; color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold;">
                <?php echo $total_items; ?>
            </span>
        <?php } ?>
    </div>
</a>


<script>
var removeLinks = document.querySelectorAll(".remove-link");
for (var i = 0; i < removeLinks.length; i++) {
    removeLinks[i].addEventListener("click", function(e) {
        var confirmed = confirm("Remove this item?");
        if (!confirmed) {
            e.preventDefault();
        }
    });
}
</script>

</body>
</html>