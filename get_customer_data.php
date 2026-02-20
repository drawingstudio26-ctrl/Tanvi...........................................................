<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['admin_logged_in'])) {
    die(json_encode(['error' => 'Unauthorized']));
}

// Database connection
try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3310;dbname=greenkart_d", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['error' => 'Database connection failed']));
}

$email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);

if (!$email) {
    die(json_encode(['error' => 'Invalid email']));
}

// Get customer basic info
$stmt = $pdo->prepare("SELECT * FROM purchases WHERE customer_email = ? LIMIT 1");
$stmt->execute([$email]);
$customer = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$customer) {
    die(json_encode(['error' => 'Customer not found']));
}

// Get customer stats
$totalOrders = $pdo->query("SELECT COUNT(*) FROM purchases WHERE customer_email = '$email'")->fetchColumn();
$totalSpent = $pdo->query("SELECT SUM(product_price * quantity) FROM purchases WHERE customer_email = '$email'")->fetchColumn();

// Get recent orders (last 5)
$recentOrders = $pdo->query("SELECT * FROM purchases WHERE customer_email = '$email' ORDER BY purchase_date DESC LIMIT 5")->fetchAll();

echo json_encode([
    'customer_name' => $customer['customer_name'],
    'customer_email' => $customer['customer_email'],
    'customer_phone' => $customer['customer_phone'],
    'total_orders' => $totalOrders,
    'total_spent' => $totalSpent ?: 0,
    'recent_orders' => $recentOrders
]);
?>