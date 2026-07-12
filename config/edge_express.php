<?php
// db_setup.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "edge_express";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//USERS TABLE (Handles Students & Staff)
// $sql1 = "CREATE TABLE IF NOT EXISTS users (
//     user_id INT AUTO_INCREMENT PRIMARY KEY,
//     full_name VARCHAR(100) NOT NULL,
//     email VARCHAR(100) UNIQUE NOT NULL,
//     password_hash VARCHAR(255) NOT NULL,
//     role VARCHAR(20) NOT NULL DEFAULT 'student', -- Stores: 'student', 'staff', 'admin'
//     phone_number VARCHAR(150) NULL,
//     faculty VARCHAR(100) NULL,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

// if ($conn->query($sql1) === TRUE) {
//     echo "Users table processed successfully<br>";
// } else {
//     echo "Error: " . $conn->error . "<br>";
// }

// //ORDERS TABLE
// $sql2 = "CREATE TABLE IF NOT EXISTS orders (
//     order_id INT AUTO_INCREMENT PRIMARY KEY,
//     user_id INT NOT NULL,
//     total_price DECIMAL(10, 2) NOT NULL,
//     order_status VARCHAR(50) DEFAULT 'Pending',
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

// if ($conn->query($sql2) === TRUE) {
//     echo "Orders table processed successfully<br>";
// } else {
//     echo "Error: " . $conn->error . "<br>";
// }

// //admin
// $sql3 = "CREATE TABLE IF NOT EXISTS admin (
//        admin_id INT AUTO_INCREMENT PRIMARY KEY,
//        username VARCHAR(50) NOT NULL UNIQUE,
//        password VARCHAR(255) NOT NULL,
//        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

// if ($conn->query($sql3) === TRUE) {
//        echo "Admin table created successfully!<br>";
// } else {
//        echo "Error: " . $conn->error . "<br>";
// }

// //Food items
// $sql4 = "CREATE TABLE IF NOT EXISTS fooditems (
//           food_id INT AUTO_INCREMENT PRIMARY KEY, 
//           name VARCHAR(100) NOT NULL,
//           price FLOAT NOT NULL,
//           category VARCHAR(100) NOT NULL 
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

// if ($conn->query($sql4) === TRUE) {
//     echo "Fooditems table created successfully!<br>";
// } else {
//     echo "Error: " . $conn->error . "<br>";
// }

$sql4_alter = "ALTER TABLE fooditems ADD COLUMN image VARCHAR(255)";
$conn->query($sql4_alter);

?>
