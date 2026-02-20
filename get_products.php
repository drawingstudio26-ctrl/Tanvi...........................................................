<?php
header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3307;dbname=greenkart_d", "root", "");
    $products = $pdo->query("SELECT id, name, price, image_url FROM products")->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['success' => true, 'products' => $products]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Database error']);
}