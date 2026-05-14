
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - GasGo</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>

    <!-- الهيدر -->
    <header class="header">
        <div class="brand">
            <img src="images.svg" alt="GasGo Logo">
            <div class="title">GasGo</div>
        </div>
        <a href="login.php"><button class="header-btn">Admin | center</button></a>
    </header>


    <!-- المحتوى الرئيسي للصفحة -->
    <div class="welcome-container">
        <h1>GasGo</h1>
        <h2>نظام ذكي يهدف الي تسهيل طلب أسطوانات الغاز بطريق سريع و امنة <span>GasGo</span> مرحبا بكم في </h2>
        <h3> يربط المستخدمين بمراكز التوزيع لتقديم خدمة اكثر كفاءة وراحة في توصيل الغاز إلى المنازل</h3>
        <p>اطلب اسطوانة الغاز بضغطة زر</p>
        <a href="order.php"><button class="order-btn">اطلب الآن</button></a>
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

</body>
</html>