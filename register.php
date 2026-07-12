<?php
// register.php
session_start();
include 'config/edge_express.php';

// Check if all fields are submitted via POST
if (isset($_POST['full_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phone_number']) && isset($_POST['faculty'])) {
    
    $name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $phone = trim($_POST['phone_number']); // Matches the updated register.html name
    $faculty = trim($_POST['faculty']);
    
    // Capture the role from the dropdown, default to 'student' if not set
    $role = isset($_POST['role']) ? trim($_POST['role']) : 'student';

    // Encrypt the plain text password securely
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // MODIFIED: Target the new 'users' table and include the 'role' field
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password_hash, role, phone_number, faculty) VALUES (?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die("SQL Prepare Error: " . $conn->error);
    }
    
    // Bind all 6 parameters (ssssss means 6 strings)
    $stmt->bind_param("ssssss", $name, $email, $hashed_password, $role, $phone, $faculty);

    // TRY-CATCH BLOCK: Captures duplicate email errors gracefully
    try {
        $stmt->execute();
        
        // Registration successful message before redirecting
        echo "<script>
                alert('Registration successful! Please log in.');
                window.location.href = 'login.html';
              </script>";
        exit(); 
    } 
    catch (mysqli_sql_exception $e) {
        // Check if the error code is 1062 (Duplicate Entry for email)
        if ($e->getCode() == 1062 || $conn->errno == 1062) {
            echo "<script>
                    alert('This email address is already registered! Please use a different email or log in.');
                    window.location.href = 'register.html';
                  </script>";
            exit();
        } else {
            echo "System Error: " . $e->getMessage();
            exit();
        }
    }     
    
    $stmt->close();
} else {
    echo "<script>
            alert('Please fill in all fields.');
            window.location.href = 'register.html';
          </script>";
    exit();
}
?>
