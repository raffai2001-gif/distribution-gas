<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    // Validate inputs first
    if (empty($name) || empty($address) || empty($phone) || empty($role)) {
        $_SESSION['order_error'] = "يرجى ملء جميع الخانات";
        header("Location: order.php");
        exit();
    }

    // Insert order if validation passes
    $conn->query("INSERT INTO orders (name, address, phone, role) VALUES ('$name', '$address', '$phone', '$role')");
    
    // Set a session variable to indicate the order was successful
    $_SESSION['order_success'] = "تم تأكيد الطلب، يرجى الانتظار إلى حين التواصل معك عبر الهاتف!";

    // Redirect to the same page to prevent form resubmission
    header("Location: order.php");
    exit();
}
