<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edge.Express | Menu</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- CSS -->
<<<<<<< HEAD
    <link rel="stylesheet" href="Assets/css/style.css">
    <link rel="stylesheet" href="Assets/css/navbar.css">
    <link rel="stylesheet" href="Assets/css/hero.css">
    <link rel="stylesheet" href="Assets/css/sections.css">
    <link rel="stylesheet" href="Assets/css/animations.css">
    <link rel="stylesheet" href="Assets/css/responsive.css">
=======
    <link rel="stylesheet" href="../Assets/css/style.css">
    <link rel="stylesheet" href="../Assets/css/navbar.css">
    <link rel="stylesheet" href="../Assets/css/hero.css">
    <link rel="stylesheet" href="../Assets/css/sections.css">
    <link rel="stylesheet" href="../Assets/css/animations.css">
    <link rel="stylesheet" href="../Assets/css/responsive.css">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

</head>

<body>

<div class="background-blur blur1"></div>
<div class="background-blur blur2"></div>

<!-- ================= NAVBAR ================= -->

<nav class="navbar">

    <div class="logo">

<<<<<<< HEAD
        <img src="Resources/EE logo.png" alt="Edge Express Logo">
=======
        <img src="../Resources/EE logo.png">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

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

</nav>

<!-- ================= MENU HERO ================= -->

<section class="menu-hero">
    <div class="menu-hero-content">
        <span>🍴 EDGE EXPRESS MENU</span>
        <h1>Explore Today's Menu</h1>
        <p>
            Freshly prepared meals and drinks waiting for you.
            Pre-order now and collect without waiting.
        </p>
    </div>
</section>

<!-- ================= SEARCH ================= -->

<section class="menu-search">
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input
            type="text"
            placeholder="Search burgers, drinks, desserts..."
        >
    </div>
</section>

<!-- ================= CATEGORIES ================= -->

<section class="categories">

    <button class="active-category" data-filter="all">
        🍽️ All
    </button>

    <button data-filter="meal">
        🍔 Meals
    </button>

    <button data-filter="drink">
        🥤 Drinks
    </button>

    <button data-filter="dessert">
        🍰 Desserts
    </button>

</section>

<!-- ================= FOOD ITEMS ================= -->

<section class="specials">

    <div class="special-grid">

        <!-- Burger -->

        <div class="food-item meal">
            <div class="food-top">
                <span class="rating">⭐ 4.9</span>
                <i class="fa-regular fa-heart"></i>
            </div>

<<<<<<< HEAD
            <img src="Resources/burger1.png" alt="Burger">

=======
            <img src="../Resources/burger1.png" alt="Burger">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54
            <h3>Chicken Burger</h3>
            <p class="food-desc">
                Fresh grilled chicken with cheese & lettuce.
            </p>
            <span class="price">Rs.650</span>
            <small>⏱ Ready in 7 mins</small>
            <div class="food-buttons">
                <a href="menu-details.php?id=1" class="details-btn">   
                     View
                </a>

<<<<<<< HEAD
                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

=======
                <!-- Use this exact syntax for your Add buttons on menu.php -->
<<<<<<< HEAD
                <a href="cart.php?action=add&id=1" class="cart-btn"><i class="fas fa-cart-plus"></i> Add</a>
=======
                <a href="cart.php?action=add&id=1" class="cart-btn">
                <i class="fas fa-cart-plus"></i> Add
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54
                </a>
>>>>>>> 4c24ef48ebca1149903671d4eaceee2f559501ae
            </div>

        </div>

        <!-- Fried Rice -->

        <div class="food-item meal ">

            <div class="food-top">

                <span class="rating">⭐ 4.8</span>

                <i class="fa-regular fa-heart"></i>

            </div>

<<<<<<< HEAD
            <img src="Resources/friedrice.png" alt="Fried Rice">
=======
            <img src="../Resources/friedrice.png" alt="Fried Rice">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

            <h3>Fried Rice</h3>

            <p class="food-desc">
                Freshly prepared fried rice with vegetables and chicken.
            </p>

            <span class="price">Rs.250</span>

            <small>⏱ Ready in 10 mins</small>

            <div class="food-buttons">

             <a href="menu-details.php?id=2" class="details-btn">   

                    View

                </a>

<<<<<<< HEAD
                <a href="cart.php?action=add&id=2" class="cart-btn"><i class="fas fa-cart-plus"></i> Add</a>
=======
                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>
>>>>>>> 4c24ef48ebca1149903671d4eaceee2f559501ae

            </div>

        </div>

        
        <!--noodles -->

        <div class="food-item meal">

            <div class="food-top">

                <span class="rating">⭐ 4.9</span>

                <i class="fa-regular fa-heart"></i>

            </div>

<<<<<<< HEAD
            <img src="Resources/noodles.png" alt="Noodles">
=======
            <img src="../Resources/noodles.png" alt="Noodles">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

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

<<<<<<< HEAD
                <a href="cart.php?action=add&id=3" class="cart-btn"><i class="fas fa-cart-plus"></i> Add</a>
=======
                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>
>>>>>>> 4c24ef48ebca1149903671d4eaceee2f559501ae

            </div>
        </div>

        
        <!--  Rice -->

        <div class="food-item meal">

            <div class="food-top">

                <span class="rating">⭐ 4.8</span>

                <i class="fa-regular fa-heart"></i>

            </div>

<<<<<<< HEAD
            <img src="Resources/rice.png" alt="Rice">
=======
            <img src="../Resources/rice.png" alt="Rice">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

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

<<<<<<< HEAD
                <a href="cart.php?action=add&id=4" class="cart-btn"><i class="fas fa-cart-plus"></i> Add</a>
=======
                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>
>>>>>>> 4c24ef48ebca1149903671d4eaceee2f559501ae

            </div>
        </div>

                <!-- Pizza -->

        <div class="food-item meal">

            <div class="food-top">

                <span class="rating">⭐ 5.0</span>

                <i class="fa-regular fa-heart"></i>

            </div>

<<<<<<< HEAD
            <img src="Resources/pizza.png" alt="Pizza">
=======
            <img src="../Resources/pizza.png" alt="Pizza">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

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

<<<<<<< HEAD
                <a href="cart.php?action=add&id=5" class="cart-btn"><i class="fas fa-cart-plus"></i> Add</a>
=======
                <a href="cart.php" class="cart-btn">
>>>>>>> 4c24ef48ebca1149903671d4eaceee2f559501ae


            </div>
        </div>

                <!--kottu  -->

        <div class="food-item meal">

            <div class="food-top">

                <span class="rating">⭐ 4.8</span>

                <i class="fa-regular fa-heart"></i>

            </div>

<<<<<<< HEAD
            <img src="Resources/kottu.png" alt="Kottu">
=======
            <img src="../Resources/kottu.png" alt="Kottu">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

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

<<<<<<< HEAD
                <a href="cart.php?action=add&id=6" class="cart-btn"><i class="fas fa-cart-plus"></i> Add</a>
=======
                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>
>>>>>>> 4c24ef48ebca1149903671d4eaceee2f559501ae

            </div>
        </div>
                <!-- Biriyani -->

        <div class="food-item meal ">

            <div class="food-top">

                <span class="rating">⭐ 4.8</span>

                <i class="fa-regular fa-heart"></i>

            </div>

<<<<<<< HEAD
            <img src="Resources/biriyani.png" alt="Biriyani">
=======
            <img src="../Resources/biriyani.png" alt="Biriyani">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

            <h3>Biriyani</h3>

            <p class="food-desc">
                Flavorful biriyani with tender meat and aromatic spices.
            </p>

            <span class="price">Rs.250</span>

            <small>⏱ Ready in 10 mins</small>

            <div class="food-buttons">

                <a href="menu-details.php?id=7" class="details-btn">

                    View

                </a>

<<<<<<< HEAD
                <a href="cart.php?action=add&id=7" class="cart-btn"><i class="fas fa-cart-plus"></i> Add</a>
=======
                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>
>>>>>>> 4c24ef48ebca1149903671d4eaceee2f559501ae

            </div>
        </div>
                <!-- iddi appa  -->

        <div class="food-item meal">

            <div class="food-top">

                <span class="rating">⭐ 4.8</span>

                <i class="fa-regular fa-heart"></i>

            </div>

<<<<<<< HEAD
            <img src="Resources/iddi appa.png" alt="Iddi Appa">
=======
            <img src="../Resources/iddi appa.png" alt="Iddi Appa">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

            <h3>Iddi Appa</h3>

            <p class="food-desc">
                Traditional Iddi Appa with authentic flavors and spices.
            </p>

            <span class="price">Rs.150</span>

            <small>⏱ Ready in 7 mins</small>

            <div class="food-buttons">

                <a href="menu-details.php?id=8" class="details-btn">

                    View

                </a>

<<<<<<< HEAD
                <a href="cart.php?action=add&id=8" class="cart-btn"><i class="fas fa-cart-plus"></i> Add</a>
=======
                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>
>>>>>>> 4c24ef48ebca1149903671d4eaceee2f559501ae

            </div>
        </div>
        
                 <!-- Drinks -->
                <!-- ice coffee -->

        <div class="food-item drink">

            <div class="food-top">

                <span class="rating">⭐ 4.8</span>

                <i class="fa-regular fa-heart"></i>

            </div>

<<<<<<< HEAD
            <img src="Resources/icecoffee.png" alt="Ice Coffee">
=======
            <img src="../Resources/icecoffee.png" alt="Ice Coffee">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

            <h3>Ice Coffee</h3>

            <p class="food-desc">
                Refreshing ice coffee with a perfect balance of flavor and caffeine.
            </p>

            <span class="price">Rs.120</span>

            <small>⏱ Ready in 6 mins</small>

            <div class="food-buttons">

                <a href="menu-details.php?id=9" class="details-btn">

                    View

                </a>

                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>

            </div>
        </div>
        
        <div class="food-item drink">

            <div class="food-top">

                <span class="rating">⭐ 4.8</span>

                <i class="fa-regular fa-heart"></i>

            </div>

<<<<<<< HEAD
            <img src="Resources/mango.png" alt="Mango Smoothy">
=======
            <img src="../Resources/mango.png" alt="Mango Smoothy">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

            <h3>Mango Smoothy</h3>

            <p class="food-desc">
                Refreshing mango smoothie with a perfect balance of flavor and creaminess.
            </p>

            <span class="price">Rs.100</span>

            <small>⏱ Ready in 6 mins</small>

            <div class="food-buttons">

                <a href="menu-details.php?id=10" class="details-btn">

                    View

                </a>

                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>

            </div>
        </div>

        
        <div class="food-item drink">

            <div class="food-top">

                <span class="rating">⭐ 4.8</span>

                <i class="fa-regular fa-heart"></i>

            </div>

<<<<<<< HEAD
            <img src="Resources/orange.png" alt="Orange Juice">
=======
            <img src="../Resources/orange.png" alt="Orange Juice">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

            <h3>Orange Juice</h3>

            <p class="food-desc">
                A refreshing orange juice with a perfect balance of flavor and vitamins.
            </p>

            <span class="price">Rs.150</span>

            <small>⏱ Ready in 5 mins</small>

            <div class="food-buttons">

                <a href="menu-details.php?id=11" class="details-btn">

                    View

                </a>

                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>

            </div>
        </div>
        
        <div class="food-item drink">

            <div class="food-top">

                <span class="rating">⭐ 4.8</span>

                <i class="fa-regular fa-heart"></i>

            </div>

<<<<<<< HEAD
            <img src="Resources/mohito.png" alt="Mohito">
=======
            <img src="../Resources/mohito.png" alt="Mohito">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

            <h3>Mojito</h3>

            <p class="food-desc">
                Refreshing mojito with a perfect balance of flavor.
            </p>

            <span class="price">Rs.160</span>

            <small>⏱ Ready in 8 mins</small>

            <div class="food-buttons">

                <a href="menu-details.php?id=12" class="details-btn">

                    View

                </a>

                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>

            </div>
        </div>

             <!-- Dessert --->
             <!--ice cream--> 
        
        <div class="food-item dessert">

            <div class="food-top">

                <span class="rating">⭐ 4.9</span>

                <i class="fa-regular fa-heart"></i>

            </div>

<<<<<<< HEAD
            <img src="Resources/icecream.png" alt="Ice Cream">
=======
            <img src="../Resources/icecream.png" alt="Ice Cream">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

            <h3>Ice Cream</h3>

            <p class="food-desc">
                Refreshing ice cream with a perfect balance of flavor and creaminess.
            </p>

            <span class="price">Rs.130</span>

            <small>⏱ Ready in 5 mins</small>

            <div class="food-buttons">

                <a href="menu-details.php?id=13" class="details-btn">

                    View

                </a>

                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>

            </div>
        </div>

        <!--Bpudding--> 
        
        <div class="food-item dessert">

            <div class="food-top">

                <span class="rating">⭐ 4.7</span>

                <i class="fa-regular fa-heart"></i>

            </div>

<<<<<<< HEAD
            <img src="Resources/Bpudding.png" alt="Pudding">
=======
            <img src="../Resources/Bpudding.png" alt="Pudding">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

            <h3>Biscuit Pudding</h3>

            <p class="food-desc">
                Refreshing biscuit pudding with a perfect balance of flavor and creaminess.
            </p>

            <span class="price">Rs.100</span>

            <small>⏱ Ready in 3 mins</small>

            <div class="food-buttons">

                <a href="menu-details.php?id=14" class="details-btn">

                    View

                </a>

                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>

            </div>
        </div>

        <!--cake--> 
        
        <div class="food-item dessert">

            <div class="food-top">

                <span class="rating">⭐ 4.9</span>

                <i class="fa-regular fa-heart"></i>

            </div>

<<<<<<< HEAD
            <img src="Resources/cake.png" alt="Cake">
=======
            <img src="../Resources/cake.png" alt="Cake">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

            <h3>RedVelvet Cake</h3>

            <p class="food-desc">
                Delicious red velvet cake with a perfect balance of flavor and creaminess.
            </p>

            <span class="price">Rs.130</span>

            <small>⏱ Ready in 5 mins</small>

            <div class="food-buttons">

                <a href="menu-details.php?id=15" class="details-btn">

                    View

                </a>

                <a href="cart.php" class="cart-btn">

                    <i class="fas fa-cart-plus"></i>

                    Add

                </a>

            </div>
        </div>

        <!--Cup Cake --> 
        
        <div class="food-item dessert">

            <div class="food-top">

                <span class="rating">⭐ 4.5</span>

                <i class="fa-regular fa-heart"></i>

            </div>

<<<<<<< HEAD
            <img src="Resources/Ccake.png" alt="Cup Cake">
=======
            <img src="../Resources/Ccake.png" alt="Cup Cake">
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

            <h3>Cup Cake</h3>

            <p class="food-desc">
                Delightful cupcake with a perfect balance of flavor and creaminess.
            </p>

            <span class="price">Rs.130</span>

            <small>⏱ Ready in 5 mins</small>

            <div class="food-buttons">

                <a href="menu-details.php?id=16" class="details-btn">

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

<!-- ================= JS ================= -->

<<<<<<< HEAD
<script src="Customer/js/app.js"></script>

<script src="Customer/js/navbar.js"></script>

<script src="Customer/js/animations.js"></script>

<script src="Customer/js/menu.js"></script>
=======
<script src="js/app.js"></script>

<script src="js/navbar.js"></script>

<script src="js/animations.js"></script>

<script src="js/menu.js"></script>
>>>>>>> 1757b61c50a2fd2858198c84f78b78de9f8b1f54

<div class="floating-cart">

    <i class="fas fa-shopping-cart"></i>

    <span>3</span>

</div>

</body>

</html>