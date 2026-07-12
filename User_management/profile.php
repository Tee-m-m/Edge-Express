<?php
// profile.php (Located inside the User_management folder)
session_start();

// FIXED: Stepped up one directory level to find your config folder safely
include '../config/edge_express.php';

// If a student tries to access this page without logging in, block them!
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

// Fetch the logged-in user's full database row
$current_user_id = $_SESSION['user_id'];

// FIXED: Changed table to 'users', column to 'user_id', and added 'role' selection
$stmt = $conn->prepare("SELECT user_id, full_name, email, role, phone_number, faculty FROM users WHERE user_id = ?");
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
    
    <!-- FIXED: Added ../ to locate your stylesheet asset folder path -->
    <link rel="stylesheet" href="../Assets/style.css">
</head>
<body>

    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="text-center mb-4">
                <div class="profile-header text-center">
                    <div class="profile-avatar mb-2">
                        <i class="bi bi-person-circle fs-1 text-primary"></i>
                    </div>
                    <h2>My Profile</h2>
                    <p>Welcome back, 
                        <strong><?php echo htmlspecialchars($user['full_name']); ?></strong> 
                        (<span class="text-capitalize text-muted small"><?php echo htmlspecialchars($user['role']); ?></span>)
                    </p>
                </div>
            </div>

            <div class="mb-4">
                <div class="profile-item mb-2">
                    <label class="fw-bold text-secondary"><i class="bi bi-person"></i> Full Name </label>
                    <p class="m-0"><?php echo htmlspecialchars($user['full_name']); ?></p>
                </div>
                
                <div class="profile-item mb-2">
                    <label class="fw-bold text-secondary"><i class="bi bi-credit-card"></i> User ID </label>
                    <p class="m-0"><?php echo htmlspecialchars($user['user_id']); ?></p>
                </div>

                <div class="profile-item mb-2">
                    <label class="fw-bold text-secondary"><i class="bi bi-envelope"></i> Email </label>
                    <p class="m-0"><?php echo htmlspecialchars($user['email']); ?></p>
                </div>

                <div class="profile-item mb-2">
                    <label class="fw-bold text-secondary"><i class="bi bi-telephone"></i> Phone Number </label>
                    <!-- FIXED: Added spaces to target tags and handle formatting properly -->
                    <p class="m-0"><?php echo !empty($user['phone_number']) ? htmlspecialchars($user['phone_number']) : 'Not Set'; ?></p>
                </div>
                
                <div class="profile-item mb-3">
                    <label class="fw-bold text-secondary"><i class="bi bi-building"></i> Faculty </label>
                    <!-- FIXED: Added spaces to target tags and handle formatting properly -->
                    <p class="m-0"><?php echo !empty($user['faculty']) ? htmlspecialchars($user['faculty']) : 'Not Set'; ?></p>
                </div>
            </div>
            
            <hr class="mb-4">
            
            <div class="d-grid gap-3">
                <a href="edit-profile.php" class="btn btn-primary rounded-pill"><i class="bi bi-pencil-square"></i> Edit Profile </a>
                <a href="changepw.php" class="btn btn-outline-primary rounded-pill"><i class="bi bi-key"></i> Change Password </a>
                
                <!-- FIXED: Added ../ to go up out of User_management if menu.php is in the root directory -->
                <a href="../menu.php" class="btn btn-outline-dark rounded-pill"><i class="bi bi-arrow-left"></i> Back to Menu</a>
                <a href="../logout.php" class="btn btn-danger rounded-pill"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
