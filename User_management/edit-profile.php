<?php
// edit-profile.php
session_start();
include 'db.php';

// Route protection shield
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

// A. BACKEND DATA RECORD UPDATE HANDLING
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = trim($_POST['full_name']);
    $new_phone = trim($_POST['phone']);
    $new_faculty = trim($_POST['faculty']);

    if (!empty($new_name)) {
        // Execute the profile update statement
        $update_stmt = $conn->prepare("UPDATE students SET full_name = ?, phone_number = ?, faculty = ? WHERE student_id = ?");
        $update_stmt->bind_param("sssi", $new_name, $new_phone, $new_faculty, $user_id);
        
        if ($update_stmt->execute()) {
            // Update the live active session tracking metric as well
            $_SESSION['user_name'] = $new_name;
            $message = "<div class='alert alert-success'>🎉 Profile updated successfully! <a href='profile.php' class='alert-link'>View Profile</a></div>";
        } else {
            $message = "<div class='alert alert-danger'>System Error: Failed to update records.</div>";
        }
        $update_stmt->close();
    } else {
        $message = "<div class='alert alert-warning'>Full Name parameter cannot be left blank.</div>";
    }
}

// B. FETCH CURRENT DATA VALUES TO POPULATE THE CHOSEN BOX FIELDS
$stmt = $conn->prepare("SELECT full_name, email, phone_number, faculty FROM students WHERE student_id = ?");
$stmt->bind_param("i", $user_id);
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
    <title>Edit Profile</title>
    <!-- Bootstrap CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="text-center mb-4">

<i class="bi bi-pencil-square profile-icon"></i>

<h2 class="page-title">Edit Profile</h2>

<p class="page-subtitle">

Update your personal information

</p>

</div>
            
            <?php echo $message; ?>

            <form name="form4" method="POST" action="edit-profile.php" onsubmit="return validateEdit()">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Email Address (Read-Only)</label>
                    <!-- Email is usually kept read-only to preserve system index keys -->
                    <input type="email" class="form-control bg-light" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($user['phone_number'] ?? ''); ?>">
                </div>

                <div class="mb-4">
                    <label class="form-label">Faculty</label>
                    <input type="text" class="form-control" name="faculty" value="<?php echo htmlspecialchars($user['faculty'] ?? ''); ?>">
                </div>

                <div class="d-grid gap-3 mt-4">

<button class="btn btn-primary rounded-pill">

<i class="bi bi-check-circle"></i>

Save Changes

</button>

<a href="profile.php"
class="btn btn-outline-secondary rounded-pill">

Cancel

</a>

</div>
            </form>
        </div>
    </div>

    <!-- Client-Side Form Constraint Checkers -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
        function validateEdit() {
            if (document.form4.full_name.value.trim().length == 0) {
                alert("Your Full Name is a required record tracking element!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
