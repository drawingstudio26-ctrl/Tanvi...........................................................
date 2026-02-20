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
    $customer_phone = $_POST['customer_phone'];
    $subscription_type = $_POST['subscription_type'];
    $delivery_address = $_POST['delivery_address'];
    $special_instructions = $_POST['special_instructions'] ?? null;

    try {
        $stmt = $pdo->prepare("INSERT INTO subscriptions (customer_name, customer_email, customer_phone, subscription_type, delivery_address, special_instructions) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$customer_name, $customer_email, $customer_phone, $subscription_type, $delivery_address, $special_instructions]);
        
        // Redirect with success message
        $_SESSION['subscription_success'] = true;
        header("Location: index.php#shop-section");
        exit();
    } catch (PDOException $e) {
        // Redirect with error message
        $_SESSION['subscription_error'] = "Error: " . $e->getMessage();
        header("Location: index.php#shop-section");
        exit();
    }
}
?>