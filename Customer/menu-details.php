<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edge Express | Menu</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="Assets/css/style.css">
    <link rel="stylesheet" href="Assets/css/navbar.css">
    <link rel="stylesheet" href="Assets/css/hero.css">
    <link rel="stylesheet" href="Assets/css/sections.css">
    <link rel="stylesheet" href="Assets/css/animations.css">
    <link rel="stylesheet" href="Assets/css/responsive.css">

</head>

<body>

<div class="background-blur blur1"></div>
<div class="background-blur blur2"></div>

<!-- ================= NAVBAR ================= -->

<nav class="navbar">

    <div class="logo">

        <img src="Resources/EE logo.png" alt="Edge Express Logo">

        Edge Express

    </div>

    <ul>

        <li><a href="index.php">Home</a></li>

        <li><a href="menu.php" class="active">Menu</a></li>

        <li><a href="about.php">About</a></li>

        <li><a href="contact.php">Contact</a></li>

    </ul>

    <div class="nav-btn">

        <a href="login.php">Login</a>

    </div>

</nav>

<!-- ================= MENU DETAILS ================= -->

<section class="menu-details">

    <div class="details-image">

        <img src="Resources/burger1.png" alt="Burger">

    </div>

    <div class="details-content">

        <span class="food-tag">
            🔥 BEST SELLER
        </span>

        <h1>
            Chicken Cheese Burger
        </h1>

        <div class="food-info">

         <span class="badge">⭐ 4.9 Rating</span>

         <span class="badge">🕒 Ready in 7 mins</span>

       </div>

        <h2>
            Rs.650
        </h2>

        <p>

            Enjoy our freshly grilled chicken burger
            topped with premium cheese, crispy lettuce,
            tomatoes and our signature Edge Express sauce.

        </p>

    </div>

</section>

<section class="ingredients">

    <h2>Ingredients</h2>

    <ul>

        <li>✔ Chicken Patty</li>

        <li>✔ Cheese</li>

        <li>✔ Lettuce</li>

        <li>✔ Tomato</li>

        <li>✔ Signature Sauce</li>

    </ul>

</section>

<section class="quantity-section">

    <h2>Quantity</h2>

    <div class="quantity-box">

        <button>-</button>

        <span>1</span>

        <button>+</button>

    </div>

    <a href="cart.php" class="cart-btn">

        <i class="fas fa-cart-plus"></i>

        Add to Cart

    </a>

</section>

<section class="related-food">

    <div class="section-title">

        <span>YOU MAY ALSO LIKE</span>

        <h2>Related Items</h2>

    </div>

    <div class="special-grid">

    <!--noodles -->

        <div class="food-item meal">

            <div class="food-top">

                <span class="rating">⭐ 4.9</span>

                <i class="fa-regular fa-heart"></i>

            </div>

            <img src="Resources/noodles.png" alt="Noodles">

            <h3>Noodles</h3>

            <p class="food-desc">
                Freshly prepared noodles with vegetables and chicken.
            </p>

            <span class="price">Rs.200</span>

            <small>⏱ Ready in 9 mins</small>

            <div class="food-buttons">

                <a href="menu-details.php?id=3" class="details-btn">

                    View

                </a>

                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>

            </div>
        </div>

        
        <!--  Rice -->

        <div class="food-item meal">

            <div class="food-top">

                <span class="rating">⭐ 4.8</span>

                <i class="fa-regular fa-heart"></i>

            </div>

            <img src="Resources/rice.png" alt="Rice">

            <h3>Rice</h3>

            <p class="food-desc">
                Freshly prepared fried rice with vegetables and spice.
            </p>

            <span class="price">Rs.150</span>

            <small>⏱ Ready in 7 mins</small>

            <div class="food-buttons">

            <a href="menu-details.php?id=4" class="details-btn">   

                    View

                </a>

                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>

            </div>
        </div>

        <!-- Pizza -->

        <div class="food-item meal">

            <div class="food-top">

                <span class="rating">⭐ 5.0</span>

                <i class="fa-regular fa-heart"></i>

            </div>

            <img src="Resources/pizza.png" alt="Pizza">

            <h3>Pizza</h3>

            <p class="food-desc">
                Delicious pizza with various toppings and cheese.
            </p>

            <span class="price">Rs.250</span>

            <small>⏱ Ready in 7 mins</small>

            <div class="food-buttons">

                <a href="menu-details.php?id=5" class="details-btn">

                    View

                </a>

                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>

            </div>
        </div>

        <!--kottu  -->

        <div class="food-item meal">

            <div class="food-top">

                <span class="rating">⭐ 4.8</span>

                <i class="fa-regular fa-heart"></i>

            </div>

            <img src="Resources/kottu.png" alt="Kottu">

            <h3>Kottu</h3>

            <p class="food-desc">
                Tasty kottu with fresh ingredients and special spices.
            </p>

            <span class="price">Rs.170</span>

            <small>⏱ Ready in 9 mins</small>

            <div class="food-buttons">

                <a href="menu-details.php?id=6" class="details-btn">

                    View

                </a>

                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>

            </div>
        </div>

    </div>

</section>