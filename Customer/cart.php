<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edge.Express | Skip the Queue</title>

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

<li><a href="index.php" >Home</a></li>

<li><a href="menu.php"class="active">Menu</a></li>

<li><a href="about.php">About</a></li>

<li><a href="contact.php">Contact</a></li>

</ul>

<div class="nav-btn">

 <a href="../User_management/profile.php">My profile</a>

</div>

</nav>

<section class="cart-hero">

<span>🛒 EDGE EXPRESS</span>

<h1>Your Shopping Cart</h1>

<p>

Review your selected meals before checkout.

</p>

</section>

<section class="cart-container">

<div class="cart-left">

<!-- Food cards here -->

</div>

<div class="cart-right">

<!-- Summary here -->

</div>

</section>

<div class="cart-card">

<img src="../Resources/burger1.png">

<div class="cart-info">

<h2>Chicken Burger</h2>

<p>

Fresh grilled chicken with cheese.

</p>

<span>

⏱ Ready in 7 mins

</span>

</div>

<div class="cart-controls">

<h3>Rs.650</h3>

<div class="quantity">

<button>-</button>

<input type="number" value="1">

<button>+</button>

</div>

<button class="remove-btn">

<i class="fas fa-trash"></i>

Remove

</button>

</div>

</div>
<div class="summary-card">

<h2>Order Summary</h2>

<div class="summary-row">

<span>Items</span>

<span>1</span>

</div>

<div class="summary-row">

<span>Subtotal</span>

<span>Rs.650</span>

</div>

<div class="summary-row">

<span>Pickup</span>

<span>FREE</span>

</div>

<hr>

<div class="summary-total">

<span>Total</span>

<strong>Rs.650</strong>

</div>

<a href="pickup.php" class="checkout-btn">

Proceed to Pickup

<i class="fas fa-arrow-right"></i>

</a>

</div>
<script src="../Customer/js/cart.js"></script>

</body>

</html>