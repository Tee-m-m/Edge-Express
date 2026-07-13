<?php
// Customer/contact.php
session_start();
include '../config/edge_express.php';

// Route security guard - kicks unlogged users back to login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit;
}

$feedback_message = "";

// ---- BACKEND MESSAGE STORAGE PARSER ENGINE ----
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_msg'])) {
    $name = trim($_POST['user_name']);
    $email = trim($_POST['user_email']);
    $subject = trim($_POST['msg_subject']);
    $message_content = trim($_POST['user_message']);

    // Server-side validation grid
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message_content)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $feedback_message = "<div class='alert alert-danger' style='padding:12px; margin-bottom:15px; background:#ff4757; color:white; border-radius:10px;'>Invalid email formatting!</div>";
        } else {
            // Prepared statement insertion
            $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $subject, $message_content);
            
            if ($stmt->execute()) {
                $feedback_message = "<div class='alert alert-success' style='padding:12px; margin-bottom:15px; background:#2ed573; color:white; border-radius:10px;'>🎉 Message sent successfully!</div>";
            } else {
                $feedback_message = "<div class='alert alert-danger' style='padding:12px; margin-bottom:15px; background:#ff4757; color:white; border-radius:10px;'>System Error: " . htmlspecialchars($conn->error) . "</div>";
            }
            $stmt->close();
        }
    } else {
        $feedback_message = "<div class='alert alert-warning' style='padding:12px; margin-bottom:15px; background:#ffa502; color:white; border-radius:10px;'>Please complete all parameters!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edge.Express | Skip the Queue</title>
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- CSS Assets -->
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

<!-- ================= NAVBAR ================= -->
<nav class="navbar">
    <div class="logo">
        <img src="../Resources/EE logo.png" alt="Edge Express Logo">
        Edge.Express
    </div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="menu.php">Menu</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php" class="active">Contact</a></li>
    </ul>
    <div class="nav-btn">
        <a href="../User_management/profile.php">My profile</a>
    </div>
</nav>

<!-- ================= HERO ================= -->
<section class="contact-hero">
    <span>📞 GET IN TOUCH</span>
    <h1>We're Here to Help</h1>
    <p>Have questions or suggestions? We'd love to hear from you.</p>
</section>

<!-- ================= CONTACT SECTIONS ================= -->
<section class="contact-container">
    <div class="contact-info">
        <h2>Contact Information</h2>
        <div class="info-box">
            <i class="fas fa-map-marker-alt"></i>
            <div>
                <h3>Location</h3>
                <p>NSBM Green University, Homagama</p>
            </div>
        </div>
        <div class="info-box">
            <i class="fas fa-phone"></i>
            <div>
                <h3>Phone</h3>
                <p>+94 71 234 5678</p>
            </div>
        </div>
        <div class="info-box">
            <i class="fas fa-envelope"></i>
            <div>
                <h3>Email</h3>
                <p>support@edgeexpress.com</p>
            </div>
        </div>
    </div>

    <!-- UPDATED: FORM FIELDS INTEGRATED WITH PROPER ACTIONS AND ATTRIBUTES -->
    <div class="contact-form">
        <h2>Send us a Message</h2>
        
        <!-- Output the feedback validation banner block state alert -->
        <?php echo $feedback_message; ?>

        <form name="contactForm" method="POST" action="contact.php" onsubmit="return validateContact()">
            <input type="text" name="user_name" placeholder="Your Name">
            <input type="email" name="user_email" placeholder="Email Address">
            <input type="text" name="msg_subject" placeholder="Subject">
            <textarea name="user_message" placeholder="Your Message"></textarea>
            <button type="submit" name="send_msg">
                Send Message
            </button>
        </form>
    </div>
</section>

<!-- CLIENT-SIDE EVENT HANDLER MATRIX VALIDATION -->
<script>
function validateContact() {
    var name = document.contactForm.user_name.value.trim();
    var email = document.contactForm.user_email.value.trim();
    var subject = document.contactForm.msg_subject.value.trim();
    var msg = document.contactForm.user_message.value.trim();

    if (name.length == 0 || email.length == 0 || subject.length == 0 || msg.length == 0) {
        alert("All fields are mandatory form parameters!");
        return false;
    }
    if (!email.includes("@") || !email.includes(".")) {
        alert("Please type a valid email configuration format!");
        return false;
    }
    return true;
}
</script>

</body>
</html>
