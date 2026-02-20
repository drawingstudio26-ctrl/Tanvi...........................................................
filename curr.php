<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database config
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "greenkart_d";
$port = 3310;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check DB connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])){
    if ($_POST['action'] !== 'purchase') {
        die(json_encode(['status' => 'error', 'message' => 'Invalid action']));
    }

    $required = ['first_name', 'last_name', 'email', 'phone', 'address', 'city', 'state', 'zip', 'payment_method', 'product_name', 'product_price'];
    
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            die(json_encode(['status' => 'error', 'message' => "Missing required field: $field"]));
        }
    }

    // Sanitize inputs
    $productName = $conn->real_escape_string(trim($_POST['product_name']));
    $productPrice = floatval($_POST['product_price']);
    $firstName = $conn->real_escape_string(trim($_POST['first_name']));
    $lastName = $conn->real_escape_string(trim($_POST['last_name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phone = $conn->real_escape_string(trim($_POST['phone']));
    $address = $conn->real_escape_string(trim($_POST['address']));
    $city = $conn->real_escape_string(trim($_POST['city']));
    $state = $conn->real_escape_string(trim($_POST['state']));
    $zip = $conn->real_escape_string(trim($_POST['zip']));
    $paymentMethod = $conn->real_escape_string(trim($_POST['payment_method']));
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $totalPrice = $productPrice * $quantity;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die(json_encode(['status' => 'error', 'message' => 'Invalid email format']));
    }

    $conn->begin_transaction();

    try {
        $sql = "INSERT INTO orders (
            customer_name, 
            email, 
            phone, 
            address, 
            city, 
            state, 
            zip, 
            payment_method, 
            product_name,
            product_price,
            quantity,
            order_total,
            order_status,
            created_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending', NOW())";
        
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $customerName = "$firstName $lastName";
        $stmt->bind_param(
            "ssssssssdids", 
            $customerName,
            $email,
            $phone,
            $address,
            $city,
            $state,
            $zip,
            $paymentMethod,
            $productName,
            $productPrice,
            $quantity,
            $totalPrice
        );
        
        if (!$stmt->execute()) {
            throw new Exception("Order insert failed: " . $stmt->error);
        }
        
        $orderId = $stmt->insert_id;
        $stmt->close();
        $conn->commit();

        // Return success response
        echo json_encode([
            'status' => 'success',
            'order_id' => $orderId,
            'total_price' => $totalPrice,
            'message' => 'Order placed successfully'
        ]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

    $conn->close();
    exit();
}

// Invalid fallback
die(json_encode(['status' => 'error', 'message' => 'Invalid request']));
?>