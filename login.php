<?php
// login.php
session_start();

include 'config/edge_express.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT user_id, full_name, password_hash, role FROM users WHERE email = ?");
        
        if ($stmt === false) {
            die("SQL Prepare Error: " . $conn->error);
        }
        
        $stmt->bind_param("s", $email);
        $stmt->execute();
        
        // Get the structural result set
        $result = $stmt->get_result();
        
        // Fetch the row data as an associative array
        if ($user = $result->fetch_assoc()) {
            // Verify if the typed password matches the secure hash
            if (password_verify($password, $user['password_hash'])) {
                
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['full_name'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'admin') {
                    header("Location: Admin/dashboard.php");
                } else {
                    header("Location: User_management/profile.php");
                }
                exit();
            } else {
                echo "<script>
                        alert('Invalid email or password. Please try again.');
                        window.location.href = 'login.html';
                      </script>";
                exit();
            }
        } else {
            echo "<script>
                    alert('Invalid email or password. Please try again.');
                    window.location.href = 'login.html';
                  </script>";
            exit();
        }
        
        $stmt->close();
    } else {
        echo "<script>
                alert('Please fill in all fields.');
                window.location.href = 'login.html';
                      </script>";
        exit();
    }
}
?>

<!-- Login Form Fallback -->
<form method="POST" action="login.php">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" class="btn btn-custom-primary w-100 mb-3 fs-6">Sign In</button>
</form>
