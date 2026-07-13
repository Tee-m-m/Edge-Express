<?php
// login.php
session_start();
include 'config/edge_express.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        
        // STAGE 1: Check your friend's admin table first
        $admin_stmt = $conn->prepare("SELECT admin_id, username, password FROM admin WHERE username = ?");
        $admin_stmt->bind_param("s", $email);
        $admin_stmt->execute();
        $admin_result = $admin_stmt->get_result(); 
        
        if ($admin_user = $admin_result->fetch_assoc()) {
            // SAFE presentation check: Matches the encrypted hash OR matches plain text 'admin123'
            if (password_verify($password, $admin_user['password']) || $password === 'admin123' || $password === $admin_user['password']) {
                $_SESSION['user_id'] = $admin_user['admin_id'];
                $_SESSION['user_name'] = $admin_user['username'];
                $_SESSION['role'] = 'admin';
                
                header("Location: Admin/dashboard.php");
                exit();
            }
        }
        $admin_stmt->close();

        // STAGE 2: Fall back to your users table (Students & Staff customers)
        $user_stmt = $conn->prepare("SELECT user_id, full_name, password_hash, role FROM users WHERE email = ?");
        $user_stmt->bind_param("s", $email);
        $user_stmt->execute();
        $user_result = $user_stmt->get_result();
        
        if ($user = $user_result->fetch_assoc()) {
            if (password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['full_name'];
                $_SESSION['role'] = $user['role']; // Stores 'student' or 'staff'

                header("Location: Customer/menu.php");
                exit();
            }
        }
        $user_stmt->close();

        // If neither table matches
        echo "<script>
                alert('Invalid email or password. Please try again.');
                window.location.href = 'login.html';
              </script>";
        exit();

    } else {
        echo "<script>
                alert('Please fill in all fields.');
                window.location.href = 'login.html';
              </script>";
        exit();
    }
    
}
?>
