//User_management
<?php
// login.php
session_start();
include 'database/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        // Prepare statement to find user by email
        $stmt = $conn->prepare("SELECT student_id, full_name, password_hash FROM students WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        
        // Get the structural result set
        $result = $stmt->get_result();
        
        // Fetch the row data as an associative array
        if ($user = $result->fetch_assoc()) {
            // Verify if the typed password matches the secure hash
            if (password_verify($password, $user['password_hash'])) {
                // Set the session variables for your team to use
                $_SESSION['user_id'] = $user['student_id'];
                $_SESSION['user_name'] = $user['full_name'];

                // Temporary redirect to profile.php for testing your module
                header("Location: profile.php");
                exit();
            } else {
                // FIXED: Changed raw echo to an alert box and redirected back to login form
                echo "<script>
                        alert('Invalid email or password. Please try again.');
                        window.location.href = 'login.html';
                      </script>";
                exit();
            }
        } else {
            // FIXED: Changed raw echo to an alert box and redirected back to login form
            echo "<script>
                    alert('Invalid email or password. Please try again.');
                    window.location.href = 'login.html';
                  </script>";
            exit();
        }
        
        $stmt->close();
    } else {
        // FIXED: Catch empty submissions gracefully
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
