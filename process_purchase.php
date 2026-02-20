<?php
header('Content-Type: application/json');

// Database connection
try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3310;dbname=greenkart_d", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Get form data
$customerName = $_POST['customer_name'] ?? '';
$customerEmail = $_POST['customer_email'] ?? '';
$customerPhone = $_POST['customer_phone'] ?? '';
$customerAddress = $_POST['customer_address'] ?? '';
$productName = $_POST['product_name'] ?? '';
$productPrice = $_POST['product_price'] ?? '';
$quantity = $_POST['quantity'] ?? 1;
$paymentMethod = $_POST['payment_method'] ?? '';

// Validate data
if (empty($customerName) || empty($customerEmail) || empty($customerPhone) || 
    empty($customerAddress) || empty($productName) || empty($productPrice)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

try {
    // Insert purchase into database
    $stmt = $pdo->prepare("INSERT INTO purchases (customer_name, customer_email, customer_phone, 
                          customer_address, product_name, product_price, quantity, payment_method)
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->execute([
        $customerName,
        $customerEmail,
        $customerPhone,
        $customerAddress,
        $productName,
        $productPrice,
        $quantity,
        $paymentMethod
    ]);
    
    echo json_encode(['success' => true, 'message' => 'Purchase recorded successfully']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}