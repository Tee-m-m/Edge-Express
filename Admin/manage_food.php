<?php

session_start();

if(!isset($_SESSION["admin_id"])) {
    header("Location: ../login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "edge_express";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "Connection Failed!<br>";
}

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

//Adding food
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_food'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $sql_insert = "INSERT INTO fooditems (name, price, category) VALUES (
    '$name', '$price', '$category')";
    $conn->query($sql_insert);

    header("Location: manage_food.php");
    exit;
}

//Edit food
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_food'])) {
    $id = $_POST['food_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $sql_update = "UPDATE fooditems SET name='$name', price='$price', category='$category' WHERE food_id='$id'";
    $conn->query($sql_update);

    header("Location: manage_food.php");
    exit;
}

//Delete food
if ($action == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_delete = "DELETE FROM fooditems WHERE food_id = '$id'";
    $conn->query($sql_delete);

    header("Location: manage_food.php");
    exit;
}

//pre-filling the form
if ($action == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_edit = "SELECT * FROM fooditems WHERE food_id = '$id'";
    $result_edit = $conn->query($sql_edit);
    $food_to_edit = $result_edit->fetch_assoc();
}

//Displaying all items
function getAllFood($conn){
    $sql = "SELECT * FROM fooditems";
    return $conn->query($sql);
}
?>

<html>
    <head>
        <title>Manage Food</title>
    </head>
    <body>
        <div class="manage-food">
            <h1>Manage Food Items</h1>
            <a href="dashboard.php">Back to Dashboard</a>

            <?php if ($action == 'list') { ?>
                <a href="manage_food.php?action=add">
                    <button>Add Food</button>
                </a>
                <a href="manage_food.php?action=edit_select">
                    <button>Edit Food</button>
                </a>
                <a href="manage_food.php?action=delete_select">
                    <button>Delete Food</button>
                </a>
                <br><br>

                <?php
                $result = getAllFood($conn);
                if ($result->num_rows > 0) {
                    echo "<table>";
                        echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Category</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                                echo "<td>" . $row["food_id"] . "</td>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["price"] . "</td>";
                                echo "<td>" . $row["category"] . "</td>";
                            echo "</tr>";
                        }
                    echo "</table>";
                }
                else{
                    echo "No food items found!";
                }
                ?>

                <?php }
                elseif ($action == 'add') { ?>
                    <h2>Add New Food Items</h2>
                    <form name="formAddFood" method="POST" action="manage_food.php">
                        Name: <br>
                        <input type="text" name="name" required><br><br>
                        Price: <br>
                        <input type="text" name="price" required><br><br>
                        Category: <br>
                        <input type="text" name="category" required><br><br>
                        <input type="submit" name="add_food" value="Add Item">
                    </form>
                    <br><a href="manage_food.php">Cancel</a>

                <?php }
                elseif ($action == 'edit_select') { ?>
                    <h2>Select a Food Item to Edit</h2>
                    <?php
                    $result = getAllFood($conn);
                    if ($result->num_rows > 0) {
                        echo "<table>";
                            echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Category</th><th>Action</th></tr>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                    echo "<td>" . $row["food_id"] . "</td>";
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td>" . $row["price"] . "</td>";
                                    echo "<td>" . $row["category"] . "</td>";
                                    echo "<td><a href='manage_food.php?action=edit&id=" .$row['food_id'] . "'>Edit this</a></td>";
                                    echo "</tr>";
                            }
                        echo "</table>";
                    }
                    else{
                        echo "No food items found!";
                    }
                    ?>
                    <br><a href="manage_food.php">Cancel</a>

                    <?php }
                    elseif ($action == 'edit' && $food_to_edit) { ?>
                        <h2>Edit Food Item</h2>
                        <form name="formEditFood" method="POST" action="manage_food.php">
                            <input type="hidden" name="food_id" value="<?php echo $food_to_edit['food_id']; ?>">
                            Name: <br>
                            <input type="text" name="name" value="<?php echo $food_to_edit['name']; ?>" required><br><br>
                            Price: <br>
                            <input type="text" name="price" value="<?php echo $food_to_edit['price']; ?>" required><br><br>
                            Category: <br>
                            <input type="text" name="category" value="<?php echo $food_to_edit['category']; ?>" required><br><br>
                            <input type="submit" name="edit_food" value="Save Changes">
                        </form>
                        <br><a href="manage_food.php">Cancel</a>

                        <?php } 
                        elseif ($action == 'delete_select') { ?>
                            <h2>Delete a Food Item to Delete</h2>
                            <?php
                            $result = getAllFood($conn);
                            if ($result->num_rows > 0){
                                echo "<table>";
                                    echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Category</th><th>Action</th></tr>";
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                            echo "<td>" . $row["food_id"] . "</td>";
                                            echo "<td>" . $row["name"] . "</td>";
                                            echo "<td>" . $row["price"] . "</td>";
                                            echo "<td>" . $row["category"] . "</td>";
                                            echo "<td><a href='manage_food.php?action=delete&id=" . $row['food_id'] . "' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete This</a></td>";
                                            echo "</tr>";
                                    }
                                echo "</table>";
                            }
                            else{
                                echo "No food item found!";
                            }
                            ?>
                            <br><a href="manage_food.php">Cancel</a>
                        <?php } ?>
        </div>
    </body>
</html>