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

$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

if (!isset($food_items[$id])) {
    header("Location: menu.php");
    exit();
}

$item = $food_items[$id];

// Build related items: same category, excluding the current item, max 4
$related = [];
foreach ($food_items as $rel_id => $rel_item) {
    if ($rel_id != $id && $rel_item['category'] == $item['category']) {
        $related[$rel_id] = $rel_item;
    }
    if (count($related) >= 4) {
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edge.Express | <?php echo $item['name']; ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="stylesheet" href="../Assets/css/style.css">
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
    <div class="logo">
        <img src="../Resources/EE logo.png" alt="Edge Express Logo">
        Edge.Express
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
</nav>

<section class="menu-details">
    <div class="details-image">
        <img src="../Resources/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
    </div>

    <div class="details-content">
        <span class="food-tag"><?php echo $item['tag']; ?></span>
        <h1><?php echo $item['name']; ?></h1>

        <div class="food-info">
            <span class="badge">⭐ <?php echo $item['rating']; ?> Rating</span>
            <span class="badge">🕒 Ready in <?php echo $item['time']; ?></span>
        </div>

        <h2>Rs.<?php echo $item['price']; ?></h2>

        <p><?php echo $item['desc']; ?></p>
    </div>
</section>

<section class="ingredients">
    <h2>Ingredients</h2>
    <ul>
        <?php foreach ($item['ingredients'] as $ingredient) { ?>
            <li>✔ <?php echo $ingredient; ?></li>
        <?php } ?>
    </ul>
</section>

<section class="related-food">
    <div class="section-title">
        <span>YOU MAY ALSO LIKE</span>
        <h2>Related Items</h2>
    </div>

    <div class="special-grid">
        <?php foreach ($related as $rel_id => $rel_item) { ?>
            <div class="food-item <?php echo $rel_item['category']; ?>">
                <div class="food-top">
                    <span class="rating">⭐ <?php echo $rel_item['rating']; ?></span>
                    <i class="fa-regular fa-heart"></i>
                </div>

                <img src="../Resources/<?php echo $rel_item['image']; ?>" alt="<?php echo $rel_item['name']; ?>">
                <h3><?php echo $rel_item['name']; ?></h3>
                <p class="food-desc"><?php echo $rel_item['desc']; ?></p>
                <span class="price">Rs.<?php echo $rel_item['price']; ?></span>
                <small>⏱ Ready in <?php echo $rel_item['time']; ?></small>

                <div class="food-buttons">
                    <a href="menu-details.php?id=<?php echo $rel_id; ?>" class="details-btn">View</a>

                    <form action="../Customer/cart.php" method="POST">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="food_id" value="<?php echo $rel_id; ?>">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="cart-btn">
                            <i class="fas fa-cart-plus"></i> Add
                        </button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

</body>
</html>