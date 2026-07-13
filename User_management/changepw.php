<?php
// changepw.php
session_start();
include '../config/edge_express.php';

if (!isset($_SESSION['user_id'])) {
    header("Location:../login.html");
    exit();
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_pword = $_POST['current_password'];
    $new_pword = $_POST['new_password'];
    $user_id = $_SESSION['user_id'];

    if (!empty($current_pword) && !empty($new_pword)) {
        // Fetch current password hash from DB
        $stmt = $conn->prepare("SELECT password_hash FROM students WHERE student_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        // Verify old password
        if ($user && password_verify($current_pword, $user['password_hash'])) {
            if (strlen($new_pword) >= 8) {
                // Update with new password hash
                $new_hash = password_hash($new_pword, PASSWORD_BCRYPT);
                $update_stmt = $conn->prepare("UPDATE students SET password_hash = ? WHERE student_id = ?");
                $update_stmt->bind_param("si", $new_hash, $user_id);
                
                if ($update_stmt->execute()) {
                    $message = "<div class='alert alert-success'> Password updated successfully!</div>";
                } else {
                    $message = "<div class='alert alert-danger'>Error updating records.</div>";
                }
                $update_stmt->close();
            } else {
                $message = "<div class='alert alert-warning'>New password must be at least 8 characters long.</div>";
            }
        } else {
            $message = "<div class='alert alert-danger'>Incorrect current password.</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>Please fill in all lines.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../Assets/style.css">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <h3 class="text-center text-danger mb-4"> Change Password</h3>
            
            <?php echo $message; ?>

            <form name="form3" method="POST" action="change-password.php" onsubmit="return validateChange()">
                <div class="mb-3">
                    <label class="form-label">Current Password</label>
                    <input type="password" class="form-control" name="current_password">
                </div>
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password" placeholder="">
                </div>
                <button type="submit" class="btn btn-danger w-100 mb-3">Update Password</button>
                <a href="profile.php" class="btn btn-outline-secondary w-100">Cancel & Return</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
        function validateChange() {
            if(document.form3.current_password.value.length == 0 || document.form3.new_password.value.length == 0) {
                alert("All password fields are required!");
                return false;
            }
            if(document.form3.new_password.value.length == 0) {
                alert("Password Required!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
