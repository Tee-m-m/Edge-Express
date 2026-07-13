<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

$food_items = [
    1  => ["name" => "Chicken Cheese Burger", "price" => 650, "rating" => 4.9, "time" => "7 mins", "image" => "burger1.png", "desc" => "Enjoy our freshly grilled chicken burger topped with premium cheese, crispy lettuce, tomatoes and our signature Edge Express sauce.", "tag" => "🔥 BEST SELLER", "category" => "meal", "ingredients" => ["Chicken Patty", "Cheese", "Lettuce", "Tomato", "Signature Sauce"]],
    2  => ["name" => "Fried Rice", "price" => 250, "rating" => 4.8, "time" => "10 mins", "image" => "friedrice.png", "desc" => "Freshly prepared fried rice with vegetables and chicken.", "tag" => "🍚 POPULAR", "category" => "meal", "ingredients" => ["Rice", "Chicken", "Carrot", "Beans", "Soy Sauce"]],
    3  => ["name" => "Noodles", "price" => 200, "rating" => 4.9, "time" => "9 mins", "image" => "noodles.png", "desc" => "Freshly prepared noodles with vegetables and chicken.", "tag" => "🍜 POPULAR", "category" => "meal", "ingredients" => ["Noodles", "Chicken", "Cabbage", "Carrot", "Soy Sauce"]],
    4  => ["name" => "Rice", "price" => 150, "rating" => 4.8, "time" => "7 mins", "image" => "rice.png", "desc" => "Freshly prepared fried rice with vegetables and spice.", "tag" => "🍚 CLASSIC", "category" => "meal", "ingredients" => ["Rice", "Mixed Vegetables", "Spices", "Curry Leaves"]],
    5  => ["name" => "Pizza", "price" => 250, "rating" => 5.0, "time" => "7 mins", "image" => "pizza.png", "desc" => "Delicious pizza with various toppings and cheese.", "tag" => "🍕 TOP RATED", "category" => "meal", "ingredients" => ["Pizza Base", "Cheese", "Tomato Sauce", "Bell Peppers", "Chicken"]],
    6  => ["name" => "Kottu", "price" => 170, "rating" => 4.8, "time" => "9 mins", "image" => "kottu.png", "desc" => "Tasty kottu with fresh ingredients and special spices.", "tag" => "🔥 LOCAL FAVOURITE", "category" => "meal", "ingredients" => ["Roti", "Chicken", "Egg", "Leeks", "Special Spices"]],
    7  => ["name" => "Biriyani", "price" => 250, "rating" => 4.8, "time" => "10 mins", "image" => "biriyani.png", "desc" => "Flavorful biriyani with tender meat and aromatic spices.", "tag" => "🍛 POPULAR", "category" => "meal", "ingredients" => ["Basmati Rice", "Chicken", "Aromatic Spices", "Fried Onions", "Cashews"]],
    8  => ["name" => "Iddi Appa", "price" => 150, "rating" => 4.8, "time" => "7 mins", "image" => "iddi appa.png", "desc" => "Traditional Iddi Appa with authentic flavors and spices.", "tag" => "🍚 TRADITIONAL", "category" => "meal", "ingredients" => ["Rice Flour", "Coconut Sambol", "Curry", "Dhal Curry"]],
    9  => ["name" => "Ice Coffee", "price" => 120, "rating" => 4.8, "time" => "6 mins", "image" => "icecoffee.png", "desc" => "Refreshing ice coffee with a perfect balance of flavor and caffeine.", "tag" => "☕ REFRESHING", "category" => "drink", "ingredients" => ["Coffee", "Milk", "Ice", "Sugar Syrup"]],
    10 => ["name" => "Mango Smoothy", "price" => 100, "rating" => 4.8, "time" => "6 mins", "image" => "mango.png", "desc" => "Refreshing mango smoothie with a perfect balance of flavor and creaminess.", "tag" => "🥭 REFRESHING", "category" => "drink", "ingredients" => ["Mango", "Yogurt", "Milk", "Honey"]],
    11 => ["name" => "Orange Juice", "price" => 150, "rating" => 4.8, "time" => "5 mins", "image" => "orange.png", "desc" => "A refreshing orange juice with a perfect balance of flavor and vitamins.", "tag" => "🍊 REFRESHING", "category" => "drink", "ingredients" => ["Fresh Oranges", "Water", "Sugar"]],
    12 => ["name" => "Mojito", "price" => 160, "rating" => 4.8, "time" => "8 mins", "image" => "mohito.png", "desc" => "Refreshing mojito with a perfect balance of flavor.", "tag" => "🍹 REFRESHING", "category" => "drink", "ingredients" => ["Lime", "Mint Leaves", "Soda Water", "Sugar Syrup"]],
    13 => ["name" => "Ice Cream", "price" => 130, "rating" => 4.9, "time" => "5 mins", "image" => "icecream.png", "desc" => "Refreshing ice cream with a perfect balance of flavor and creaminess.", "tag" => "🍨 SWEET", "category" => "dessert", "ingredients" => ["Milk", "Cream", "Sugar", "Vanilla"]],
    14 => ["name" => "Biscuit Pudding", "price" => 100, "rating" => 4.7, "time" => "3 mins", "image" => "Bpudding.png", "desc" => "Refreshing biscuit pudding with a perfect balance of flavor and creaminess.", "tag" => "🍮 SWEET", "category" => "dessert", "ingredients" => ["Biscuits", "Cream", "Cocoa", "Condensed Milk"]],
    15 => ["name" => "RedVelvet Cake", "price" => 130, "rating" => 4.9, "time" => "5 mins", "image" => "cake.png", "desc" => "Delicious red velvet cake with a perfect balance of flavor and creaminess.", "tag" => "🎂 SWEET", "category" => "dessert", "ingredients" => ["Flour", "Cocoa", "Cream Cheese Frosting", "Buttermilk"]],
    16 => ["name" => "Cup Cake", "price" => 130, "rating" => 4.5, "time" => "5 mins", "image" => "Ccake.png", "desc" => "Delightful cupcake with a perfect balance of flavor and creaminess.", "tag" => "🧁 SWEET", "category" => "dessert", "ingredients" => ["Flour", "Butter", "Sugar", "Vanilla Frosting"]],
];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // food_id => quantity
}

// Handle add / increase / decrease / remove
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action  = $_POST['action'] ?? '';
    $food_id = isset($_POST['food_id']) ? (int)$_POST['food_id'] : 0;

    if ($action === 'add' && isset($food_items[$food_id])) {
        $qty = isset($_POST['quantity']) ? max(1, (int)$_POST['quantity']) : 1;
        if (isset($_SESSION['cart'][$food_id])) {
            $_SESSION['cart'][$food_id] += $qty;
        } else {
            $_SESSION['cart'][$food_id] = $qty;
        }
    }

    if ($action === 'increase' && isset($_SESSION['cart'][$food_id])) {
        $_SESSION['cart'][$food_id]++;
    }

    if ($action === 'decrease' && isset($_SESSION['cart'][$food_id])) {
        if ($_SESSION['cart'][$food_id] > 1) {
            $_SESSION['cart'][$food_id]--;
        }
    }

    if ($action === 'remove' && isset($_SESSION['cart'][$food_id])) {
        unset($_SESSION['cart'][$food_id]);
    }

    // Prevent form resubmission on refresh
    header("Location: cart.php");
    exit();
}

// Build cart data for display
$cart_items  = [];
$subtotal    = 0;
$total_items = 0;

foreach ($_SESSION['cart'] as $food_id => $qty) {
    if (isset($food_items[$food_id])) {
        $item       = $food_items[$food_id];
        $line_total = $item['price'] * $qty;

        $subtotal    += $line_total;
        $total_items += $qty;

        $cart_items[] = [
            'id'         => $food_id,
            'name'       => $item['name'],
            'desc'       => $item['desc'],
            'image'      => $item['image'],
            'time'       => $item['time'],
            'price'      => $item['price'],
            'qty'        => $qty,
            'line_total' => $line_total,
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edge.Express | Skip the Queue</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/style.css">
    <link rel="stylesheet" href="../Assets/css/cart.css">
    <link rel="stylesheet" href="../Assets/css/navbar.css">
    <link rel="stylesheet" href="../Assets/css/hero.css">
    <link rel="stylesheet" href="../Assets/css/sections.css">
    <link rel="stylesheet" href="../Assets/css/animations.css">
    <link rel="stylesheet" href="../Assets/css/responsive.css">
</head>
<body>
<div class="background-blur blur1"></div>
<div class="background-blur blur2"></div>

<nav class="navbar">
<<<<<<< HEAD
    <div class="logo">
        <img src="../Resources/EE logo.png" alt="Edge Express Logo">
        Edge Express
    </div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="menu.php" class="active">Menu</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>
    <div class="nav-btn">
        <a href="../User_management/profile.php">My profile</a>
    </div>
=======

<div class="logo">

<img src="../Resources/EE logo.png" alt="Edge Express Logo">
   Edge Express

</div>

<ul>

<li><a href="index.php" >Home</a></li>

<li><a href="menu.php"class="active">Menu</a></li>

<li><a href="about.php">About</a></li>

<li><a href="contact.php">Contact</a></li>

</ul>

<div class="nav-btn">

 <a href="../User_management/profile.php">My profile</a>

</div>

>>>>>>> d3e048dc17e222741738ad1a41e7ac602d3505e9
</nav>

<section class="cart-hero">
    <span>🛒 EDGE EXPRESS</span>
    <h1>Your Shopping Cart</h1>
    <p>Review your selected meals before checkout.</p>
</section>

<section class="cart-container">
    <div class="cart-left">
        <?php if (empty($cart_items)) { ?>
            <p id="empty-cart-msg">Your cart is empty. <a href="menu.php">Browse the menu</a>.</p>
        <?php } else { ?>
            <?php foreach ($cart_items as $ci) { ?>
                <div class="cart-card">
                    <img src="../Resources/<?php echo $ci['image']; ?>" alt="<?php echo $ci['name']; ?>">
                    <div class="cart-info">
                        <h2><?php echo $ci['name']; ?></h2>
                        <p><?php echo $ci['desc']; ?></p>
                        <span>⏱ Ready in <?php echo $ci['time']; ?></span>
                    </div>
                    <div class="cart-controls">
                        <h3>Rs.<?php echo number_format($ci['line_total'], 0); ?></h3>

                        <div class="quantity">
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="action" value="decrease">
                                <input type="hidden" name="food_id" value="<?php echo $ci['id']; ?>">
                                <button type="submit">-</button>
                            </form>

                            <input type="number" value="<?php echo $ci['qty']; ?>" readonly>

                            <form action="cart.php" method="POST">
                                <input type="hidden" name="action" value="increase">
                                <input type="hidden" name="food_id" value="<?php echo $ci['id']; ?>">
                                <button type="submit">+</button>
                            </form>
                        </div>

                        <form action="cart.php" method="POST">
                            <input type="hidden" name="action" value="remove">
                            <input type="hidden" name="food_id" value="<?php echo $ci['id']; ?>">
                            <button type="submit" class="remove-btn">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="cart-right">
        <div class="summary-card">
            <h2>Order Summary</h2>
            <div class="summary-row">
                <span>Items</span>
                <span><?php echo $total_items; ?></span>
            </div>
            <div class="summary-row">
                <span>Subtotal</span>
                <span>Rs.<?php echo number_format($subtotal, 0); ?></span>
            </div>
            <div class="summary-row">
                <span>Pickup</span>
                <span>FREE</span>
            </div>
            <hr>
            <div class="summary-total">
                <span>Total</span>
                <strong>Rs.<?php echo number_format($subtotal, 0); ?></strong>
            </div>

            <?php if (!empty($cart_items)) { ?>
                <a href="pickup.php" class="checkout-btn">
                    Proceed to Pickup <i class="fas fa-arrow-right"></i>
                </a>
            <?php } else { ?>
                <a href="menu.php" class="checkout-btn disabled" aria-disabled="true">
                    Browse Menu
                </a>
            <?php } ?>
        </div>
    </div>
</section>

</body>
</html>