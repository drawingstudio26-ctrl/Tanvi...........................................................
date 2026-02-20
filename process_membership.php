<?php
session_start();

// Database connection
try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3310;dbname=greenkart_d", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $membership_type = $_POST['membership_type'];
    $payment_method = $_POST['payment_method'];

    try {
        $stmt = $pdo->prepare("INSERT INTO memberships (customer_name, customer_email, membership_type, payment_method) VALUES (?, ?, ?, ?)");
        $stmt->execute([$customer_name, $customer_email, $membership_type, $payment_method]);
        
        // Redirect with success message
        $_SESSION['membership_success'] = true;
        $_SESSION['membership_type'] = $membership_type;
        header("Location: index.php#offers-section");
        exit();
    } catch (PDOException $e) {
        // Redirect with error message
        $_SESSION['membership_error'] = "Error: " . $e->getMessage();
        header("Location: index.php#offers-section");
        exit();
    }
}
?>