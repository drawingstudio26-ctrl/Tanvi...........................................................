<?php
header('Content-Type: application/json');

// Database connection
try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3307;dbname=greenkart_d", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['error' => 'Database connection failed']));
}

try {
    $stmt = $pdo->query("SELECT * FROM coupon_codes WHERE is_active = TRUE AND valid_until >= CURDATE()");
    $coupons = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($coupons);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Failed to fetch coupons']);
}
?>