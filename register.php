<?php
// register.php
include 'config/edge_express.php';

if (isset($_POST['full_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phone']) && isset($_POST['faculty'])) {
    
    $name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $phone = trim($_POST['phone']);
    $faculty = trim($_POST['faculty']);

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO students (full_name, email, password_hash, phone_number, faculty) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $hashed_password, $phone, $faculty);


        // TRY-CATCH BLOCK: This captures the error before XAMPP crashes the page!
        try {
            $stmt->execute();
            // If execution succeeds, redirect to login layout instantly
            header("Location: login.html");
            exit(); 
        } 
        catch (mysqli_sql_exception $e) {
            // Check if the caught error code is 1062 (Duplicate Entry constraint)
            if ($e->getCode() == 1062 || $conn->errno == 1062) {
                echo "<script>
                        alert('This email address is already registered! Please use a different email or log in.');
                        window.location.href = 'register.html';
                      </script>";
                exit();
            } else {
                // Any other database error
                echo "System Error: " . $e->getMessage();
                exit();
            }
        }     
} else {
    echo "Please fill in all fields.";
}

// Close the statement
$stmt->close();


?>

<!-- Registration Form Fallback -->
<form method="POST" action="register.php">
    <input type="text" name="full_name" placeholder="Full Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
</form>
