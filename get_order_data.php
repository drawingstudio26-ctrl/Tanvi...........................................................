<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('HTTP/1.1 403 Forbidden');
    die(json_encode(['error' => 'Unauthorized access']));
}

// Database connection
try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3310;dbname=greenkart_d", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    header('HTTP/1.1 500 Internal Server Error');
    die(json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]));
}

// Check if order ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('HTTP/1.1 400 Bad Request');
    die(json_encode(['error' => 'Invalid order ID']));
}

$orderId = (int)$_GET['id'];

// Fetch order details
try {
    $stmt = $pdo->prepare("SELECT * FROM purchases WHERE id = ?");
    $stmt->execute([$orderId]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$order) {
        header('HTTP/1.1 404 Not Found');
        die(json_encode(['error' => 'Order not found']));
    }
    
    // Format the response
    $response = [
        'id' => $order['id'],
        'customer_name' => $order['customer_name'],
        'customer_email' => $order['customer_email'],
        'customer_phone' => $order['customer_phone'],
        'product_name' => $order['product_name'],
        'product_price' => (float)$order['product_price'],
        'quantity' => (int)$order['quantity'],
        'payment_method' => $order['payment_method'],
        'status' => $order['status'],
        'purchase_date' => $order['purchase_date']
    ];
    
    header('Content-Type: application/json');
    echo json_encode($response);
    
} catch (PDOException $e) {
    header('HTTP/1.1 500 Internal Server Error');
    die(json_encode(['error' => 'Database error: ' . $e->getMessage()]));
}