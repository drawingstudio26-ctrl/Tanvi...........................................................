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

// Check if customer email is provided
if (!isset($_GET['email'])) {
    header('HTTP/1.1 400 Bad Request');
    die(json_encode(['error' => 'Customer email required']));
}

$customerEmail = $_GET['email'];

// Fetch customer's recent orders
try {
    $stmt = $pdo->prepare("SELECT * FROM purchases WHERE customer_email = ? ORDER BY purchase_date DESC LIMIT 5");
    $stmt->execute([$customerEmail]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($orders);
    
} catch (PDOException $e) {
    header('HTTP/1.1 500 Internal Server Error');
    die(json_encode(['error' => 'Database error: ' . $e->getMessage()]));
}