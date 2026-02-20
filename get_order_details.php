<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    die("Unauthorized access");
}

// Database connection
try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3307;dbname=greenkart_d", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];
    $stmt = $pdo->prepare("SELECT * FROM purchases WHERE id = ?");
    $stmt->execute([$orderId]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($order) {
        header('Content-Type: application/json');
        echo json_encode($order);
    } else {
        echo json_encode(['error' => 'Order not found']);
    }
} else {
    echo json_encode(['error' => 'No order ID provided']);
}