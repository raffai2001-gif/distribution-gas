<?php

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center_page</title>
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body class="center-page" style="background: linear-gradient(to right, #e9e0e0, #b4c3f5);">

    <div class="center-box">
        <h1>Welcome <span><?php echo $_SESSION['name']; ?></span></h1>
        <p>This is the <span>center</span> page.</p>
        <button onclick="window.location.href='logout.php'">logout</button>
    </div>
    
    <div class="container">
        <h1>Order List</h1>
        <table>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Role</th>
            </tr>
            <?php
            // Database connection
            require_once "config.php";

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch order data
            $sql = "SELECT name, address, phone, role FROM orders";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $i = 1;
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $i++ . "</td> <td>" . $row["name"] . "</td><td>" . $row["address"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["role"] . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No orders found</td></tr>";
            }

            $conn->close();
            ?>



</body>

</html>