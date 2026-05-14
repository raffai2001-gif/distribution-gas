<?php

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); //تم التبديل من index.php إلى login.php
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_page</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body class="admin-page">

    <div class="admin-box">
    <h1>Welcome <span><?php echo $_SESSION['name']; ?></span></h1>
    <p>This is the admin page.</p>

    <div class="admin-buttons">
        <button class="report-btn"
        onclick="window.location.href='report.php'">
        التقارير
        </button>

        <button class="logout-btn"
        onclick="window.location.href='logout.php'">
        logout
        </button>
    </div>
    
    
    </div>

    <div class="container">
        <h1>Center Gas List</h1>
        <table>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <?php
            // Database connection
            require_once "config.php";

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch user data
            $sql = "SELECT name, email FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $i = 1;
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $i++ . "</td> <td>" . $row["name"] . "</td><td>" . $row["email"] . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No users found</td></tr>";
            }

            $conn->close();
            ?>
        </table>

    </div>

</body>

</html>