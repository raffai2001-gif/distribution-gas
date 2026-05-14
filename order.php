<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - GasGo</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body class="order-page">

    <!-- الهيدر -->
    <header class="header">
        <div class="brand">
            <img src="images.svg" alt="GasGo Logo">
            <div class="title">GasGo</div>
        </div>
        <a href="login.php"><button class="header-btn">Admin | center</button></a>
    </header>


    <!-- فورمة الطلب -->
    <div class="container">
    <div class="order-box">
            <form action="order_process.php" method="post">
                <h2>Order Gas Cylinders</h2>
                <p id="notification"></p>
                <?php
                if (isset($_SESSION['order_success'])) {
                    echo "<p class='success-message'>" . $_SESSION['order_success'] . "</p>";
                    unset($_SESSION['order_success']);
                }
                if (isset($_SESSION['order_error'])) {
                    echo "<p class='error-message'>" . $_SESSION['order_error'] . "</p>";
                    unset($_SESSION['order_error']);
                }
                ?>
                <input type="text" name="name" placeholder="Name/اكتب اسمك" required>
                <input type="address" name="address" placeholder="Address/اكتب عنوانك" required>
                <input type="phone" name="phone" placeholder="Phone/اضف رقم هاتفك" required>
                <select name="role" required>
                    <option value="">--حدد نوع انبوبة الغاز--</option>
                    <option value="Gadra">Gadra</option>
                    <option value="Nile">Nile</option>
                    <option value="Aprce">Aprce</option>
                    <option value="Soda">Soda</option>
                </select>
                <button type="submit" name="order">تاكيد الطلب</button>
            </form>
        </div>
    </div>


    <script src="script.js?v=<?php echo time(); ?>"></script>
    
</body>
</html>