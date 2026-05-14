<?php
session_start();
require_once "config.php";

// Function to get total users count
function getTotalUsers() {
    global $conn;
    $sql = "SELECT COUNT(*) as total FROM users";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total'];
}

// Function to get total orders count
function getTotalOrders() {
    global $conn;
    $sql = "SELECT COUNT(*) as total FROM orders";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total'];
}

// Function to get pending orders count
// Since there's no status column in the orders table, we'll count all orders as pending
// In a real system, you would have a status column to track order status
function getPendingOrders() {
    global $conn;
    $sql = "SELECT COUNT(*) as total FROM orders";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total'];
}

// Function to get users report data
function getUsersReport() {
    global $conn;
    $sql = "SELECT id, name, email, role FROM users ORDER BY id";
    $result = $conn->query($sql);
    $users = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    return $users;
}

// Function to get orders report data
function getOrdersReport() {
    global $conn;
    $sql = "SELECT id, name, address, phone, role FROM orders ORDER BY id DESC";
    $result = $conn->query($sql);
    $orders = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }
    return $orders;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - GasGo</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <style>
        /* Additional styles for reports page */
        .stats-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
            flex: 1;
            min-width: 150px;
            transition: transform 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-card h3 {
            margin: 0 0 10px 0;
            color: #666;
            font-size: 16px;
        }
        .stat-card .value {
            font-size: 28px;
            font-weight: bold;
            color: #7892da;
        }
        .report-section {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            overflow: hidden;
        }
        .report-section h2 {
            background: linear-gradient(to left, #47bdf3, #5976d6);
            color: white;
            padding: 15px 20px;
            margin: 0;
            font-size: 20px;
        }
        .search-container {
            padding: 15px 20px;
            display: flex;
            gap: 10px;
        }
        .search-container input {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }
        .search-container button {
            width: 100px;
            padding: 12px ;
            background: #7892da;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.2s ease;
        }
        .search-container button:hover {
            background: #4066ce;
        }
        .table-container {
            overflow-x: auto;
            margin: 0 20px 20px 20px;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 0;
        }
        th, td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        th {
            background-color: #4066ce;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .no-data {
            text-align: center;
            padding: 30px;
            color: #666;
            font-style: italic;
        }
        @media (max-width: 768px) {
            .stats-container {
                flex-direction: column;
            }
            .stat-card {
                min-width: 100%;
            }
        }
    </style>
</head>
<body class="report-page">
    
    <!-- الهيدر -->
    <header class="header">
        <div class="brand">
            <img src="images.svg" alt="GasGo Logo">
            <div class="title">GasGo</div>
        </div>

    </header>

    <!-- المحتوى الرئيسي للصفحة -->
    <div class="report-box">
        <!-- Statistics Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <h3>مجموع المستخدمين </h3>
                <div class="value"><?php echo getTotalUsers(); ?></div>
            </div>
            <div class="stat-card">
                <h3>مجموع الطلبات</h3>
                <div class="value"><?php echo getTotalOrders(); ?></div>
            </div>
            <div class="stat-card">
                <h3>الطلبات المعلقة</h3>
                <div class="value"><?php echo getPendingOrders(); ?></div>
            </div>
        </div>

        <!-- Users Report Section -->
        <section class="report-section">
            <h2>تقرير جميع المستخدمين</h2>
            <div class="search-container">
                <input type="text" id="usersSearch" placeholder="Search users...">
                <button onclick="searchTable('usersSearch', 'usersTable')">Search</button>
            </div>
            <div class="table-container">
                <table id="usersTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $users = getUsersReport();
                        if (!empty($users)) {
                            foreach($users as $user) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($user['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($user['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($user['role']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='no-data'>No users found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Orders Report Section -->
        <section class="report-section">
            <h2>تقرير الطلبات</h2>
            <div class="search-container">
                <input type="text" id="ordersSearch" placeholder="Search orders...">
                <button onclick="searchTable('ordersSearch', 'ordersTable')">Search</button>
            </div>
            <div class="table-container">
                <table id="ordersTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Gas Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $orders = getOrdersReport();
                        if (!empty($orders)) {
                            foreach($orders as $order) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($order['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($order['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($order['address']) . "</td>";
                                echo "<td>" . htmlspecialchars($order['phone']) . "</td>";
                                echo "<td>" . htmlspecialchars($order['role']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='no-data'>No orders found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- الفوتر -->
    <footer class="footer">
        <div class="footer-container">

            <!-- من نحن -->
            <div class="footer-section">
                <h3>من نحن</h3>
                <p>
                    GasGo هو نظام إلكتروني يساعد المستخدمين في طلب أسطوانات الغاز بسهولة،
                    ويربطهم مباشرة بمراكز التوزيع لتقديم خدمة سريعة وآمنة.
                </p>
            </div>

            <!-- روابط -->
            <div class="footer-section">
                <h3>روابط سريعة</h3>
                <ul>
                    <li><a href="index.php">الرئيسية</a></li>
                    <li><a href="order.php">اطلب الآن</a></li>
                    <li><a href="login.php">تسجيل الدخول</a></li>
                </ul>
            </div>

            <!-- تواصل -->
            <div class="footer-section">
                <h3>تواصل معنا</h3>
                <p>📞 0912345678</p>
                <p>📧 gasgo@email.com</p>
                <p>📍 الخرطوم - السودان</p>
            </div>

        </div>

        <div class="footer-bottom">
            <p>© 2026 GasGo - جميع الحقوق محفوظة</p>
        </div>
    </footer>

    <script>
        function searchTable(inputId, tableId) {
            const input = document.getElementById(inputId);
            const filter = input.value.toUpperCase();
            const table = document.getElementById(tableId);
            const rows = table.getElementsByTagName("tr");
            
            // Loop through all table rows, and hide those who don't match the search query
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                let found = false;
                
                // Check all cells in the row
                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell) {
                        const text = cell.textContent || cell.innerText;
                        if (text.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                
                // Show or hide the row
                if (found) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
        
        // Enable search on Enter key press
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const activeElement = document.activeElement;
                if (activeElement.tagName === 'INPUT' && activeElement.type === 'text') {
                    const inputId = activeElement.id;
                    let tableId = '';
                    if (inputId === 'usersSearch') {
                        tableId = 'usersTable';
                    } else if (inputId === 'ordersSearch') {
                        tableId = 'ordersTable';
                    }
                    if (tableId) {
                        searchTable(inputId, tableId);
                    }
                }
            }
        });
    </script>
</body>
</html>