<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edge Express | Skip the Queue</title>

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

<nav class="navbar">

<div class="logo">

<img src="Resources/EE logo.png" alt="Edge Express Logo">
   Edge Express
   
</div>


</div>

<ul>

<li><a href="index.php" class ="active">Home</a></li>

<li><a href="menu.php" >Menu</a></li>

<li><a href="about.php" >About</a></li>

<li><a href="contact.php" >Contact</a></li>

</ul>

<div class="nav-btn">

<a href="login.php">Login</a>

</div>

</nav>

<section class="register-section">

<div class="register-card">

<h2>Create Account ✨</h2>

<p>

Join Edge Express and skip the queue.

</p>

<form action="register.php" method="POST">

<div class="input-group">

<i class="fas fa-user"></i>

<input
type="text"
name="full_name"
placeholder="Full Name"
required>

</div>

<div class="input-group">

<i class="fas fa-envelope"></i>

<input
type="email"
name="email"
placeholder="Email Address"
required>

</div>

<div class="input-group">

<i class="fas fa-phone"></i>

<input
type="text"
name="phone_number"
placeholder="Phone Number"
required>

</div>

<div class="input-group">

<i class="fas fa-building"></i>

<select name="faculty" required>

<option value="">Select Faculty</option>

<option>Computing</option>

<option>Business</option>

<option>Engineering</option>

<option>Science</option>

</select>

</div>

<div class="input-group">

<i class="fas fa-users"></i>

<select name="role">

<option value="student">

Student

</option>

<option value="admin">

Admin

</option>

</select>

</div>

<div class="input-group">

<i class="fas fa-lock"></i>

<input
type="password"
name="password"
placeholder="Password"
required>

</div>

<div class="input-group">

<i class="fas fa-lock"></i>

<input
type="password"
name="confirm_password"
placeholder="Confirm Password"
required>

</div>

<button class="register-btn">

Create Account

</button>

</form>

<div class="login-link">

Already have an account?

<a href="login.php">

Login

</a>

</div>

</div>

<div class="register-image">

<div class="food-glow"></div>

<img
src="Resources/burger1.png"
class="register-food">

</div>

</section>