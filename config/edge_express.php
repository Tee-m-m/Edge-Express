<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "edge_express";

$conn = new mysqli($servername , $username , $password , $dbname);

//CREATING STUDENT AND ORDERS TABLES
// $sql1 = "CREATE TABLE IF NOT EXISTS students(
//     student_id INT AUTO_INCREMENT PRIMARY KEY,
//     full_name VARCHAR(100) NOT NULL,
//     email VARCHAR(100) UNIQUE NOT NULL,
//     password_hash VARCHAR(255) NOT NULL,
//     phone_number VARCHAR(150) NULL,
//     faculty VARCHAR(100) NULL,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// )";
// if ($conn->query($sql1) === TRUE) {
//     echo "created successfully<br>";
// } else {
//     echo "Error creating table: " . $conn->error . "<br>";
// }


// $sql2 = "CREATE TABLE IF NOT EXISTS orders(
//     order_id INT AUTO_INCREMENT PRIMARY KEY,
//     student_id INT NOT NULL,
//     total_price DECIMAL(10, 2) NOT NULL,
//     order_status VARCHAR(50) DEFAULT 'Pending',
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE
// )";

// if ($conn->query($sql2) === TRUE) {
//     echo "created successfully<br>";
// } else {
//     echo "Error creating table: " . $conn->error . "<br>";
// }

$sql3 = "CREATE TABLE IF NOT EXISTS admin(
       admin_id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) NOT NULL UNIQUE,
       password VARCHAR(255) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql3) === TRUE) {
       echo "Created the admin table sucessfully!<br>";
}
else{
       echo "Error creating the table: " .$conn->error . "<br>";
}