<?php
// profile.php
session_start();
include 'db.php';

// If a student tries to access this page without logging in, block them!
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Fetch the logged-in student's full database row
$current_user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT student_id, full_name, email, phone_number, faculty FROM students WHERE student_id = ?");
$stmt->bind_param("i", $current_user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom Style Sheet Link -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="text-center mb-4">
                <div class="profile-header text-center">
                    <div class="profile-avatar">
                    <i class="bi bi-person-circle"></i>
                    </div>
                    <h2>My Profile</h2>
                    <p>Welcome back,
                    <strong><?php echo htmlspecialchars($user['full_name']); ?></strong>
                    </p>
                </div>

            <div class="mb-4">
                <div class="profile-item">
                <label><i class="bi bi-person"></i> Full Name </label>
                <p><?php echo htmlspecialchars($user['full_name']); ?></p>
                </div>
                
                <div class="profile-item">
                <label><i class="bi bi-credit-card"></i> Student ID </label>
                <p><?php echo htmlspecialchars($user['student_id']); ?></p>
                </div>

                <div class="profile-item">
                <label><i class="bi bi-envelope"></i> Email </label>
                <p><?php echo htmlspecialchars($user['email']); ?></p>
                </div>

                <div class="profile-item">
                <label><i class="bi bi-telephone"></i> Phone Number </label>
                <p><?phpecho $user['phone_number']? htmlspecialchars($user['phone_number']): 'Not Set';?></p>
                </div>
                
                <div class="profile-item">
                <label><i class="bi bi-building"></i> Faculty </label>
                <p><?phpecho $user['faculty']? htmlspecialchars($user['faculty']): 'Not Set';?></p>
                </div>
            </div>
            <hr class="mb-4">
            <div class="d-grid gap-3">

            <a href="edit-profile.php"class="btn btn-primary rounded-pill"><i class="bi bi-pencil-square"></i> Edit Profile </a>
            <a href="changepw.php"class="btn btn-outline-primary rounded-pill"><i class="bi bi-key"></i> Change Password </a>
            <a href="menu.php"class="btn btn-outline-dark rounded-pill"><i class="bi bi-arrow-left"></i> Back to Menu</a>
            <a href="logout.php"class="btn btn-danger rounded-pill"><i class="bi bi-box-arrow-right"></i>Logout</a>

            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
