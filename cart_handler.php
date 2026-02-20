<?php
session_start();
header('Content-Type: application/json');

$action = $_POST['action'] ?? '';
$response = ['success' => false];

try {
    $dsn = "mysql:host=127.0.0.1;port=3307;dbname=greenkart_d";
    $pdo = new PDO($dsn, 'root', '');
    
    switch($action) {
        case 'add':
            $id = $_POST['id'];
            $product = $pdo->query("SELECT id, name, price FROM products WHERE id = $id")->fetch();
            
            if($product) {
                if(!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
                
                $found = false;
                foreach($_SESSION['cart'] as &$item) {
                    if($item['id'] == $id) {
                        $item['quantity']++;
                        $found = true;
                        break;
                    }
                }
                
                if(!$found) {
                    $_SESSION['cart'][] = [
                        'id' => $id,
                        'name' => $_POST['name'],
                        'price' => $_POST['price'],
                        'image' => $_POST['image'],
                        'quantity' => 1
                    ];
                }
                
                $response = [
                    'success' => true,
                    'cartCount' => array_sum(array_column($_SESSION['cart'], 'quantity'))
                ];
            }
            break;
            
        case 'checkout':
            // Handle full checkout process with database insertion
            break;
    }
} catch(Exception $e) {
    $response['error'] = $e->getMessage();
}

echo json_encode($response);