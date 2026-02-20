<?php
// admin_fetch.php
header('Content-Type: application/json');
session_start();

// Database configuration
$servername = "127.0.0.1";
$port = "3310";
$username = "root";
$password = "";
$dbname = "greenkart_d";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Verify admin session
if (!isset($_SESSION['admin_logged_in'])) {
    die(json_encode(['error' => 'Unauthorized access']));
}

// Handle different actions
$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'get_stats':
        getStatistics($conn);
        break;
    case 'get_orders':
        getOrders($conn);
        break;
    case 'get_order_details':
        getOrderDetails($conn);
        break;
    case 'update_order_status':
        updateOrderStatus($conn);
        break;
    case 'get_products':
        getProducts($conn);
        break;
    case 'get_customers':
        getCustomers($conn);
        break;
    case 'get_enquiries':
        getEnquiries($conn);
        break;
    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}

function getStatistics($conn) {
    // Total products
    $products = $conn->query("SELECT COUNT(*) as count FROM products")->fetch_assoc()['count'];
    
    // Total orders and revenue
    $orders = $conn->query("SELECT COUNT(*) as count, SUM(order_total) as revenue FROM orders")->fetch_assoc();
    
    // New enquiries
    $enquiries = $conn->query("SELECT COUNT(*) as count FROM enquiries WHERE status = 'new'")->fetch_assoc()['count'];
    
    // Recent orders (last 5)
    $recentOrders = [];
    $result = $conn->query("SELECT o.id, o.customer_name, o.order_date, o.order_total, o.order_status 
                           FROM orders o 
                           ORDER BY o.order_date DESC LIMIT 5");
    while ($row = $result->fetch_assoc()) {
        $recentOrders[] = $row;
    }
    
    // Recent enquiries (last 5)
    $recentEnquiries = [];
    $result = $conn->query("SELECT e.id, e.name, e.email, e.subject, e.created_at, e.status 
                           FROM enquiries e 
                           ORDER BY e.created_at DESC LIMIT 5");
    while ($row = $result->fetch_assoc()) {
        $recentEnquiries[] = $row;
    }
    
    echo json_encode([
        'products' => $products,
        'orders' => $orders['count'],
        'revenue' => $orders['revenue'] ?? 0,
        'enquiries' => $enquiries,
        'recent_orders' => $recentOrders,
        'recent_enquiries' => $recentEnquiries
    ]);
}
function getOrders($conn) {
    $page = intval($_GET['page'] ?? 1);
    $limit = 10;
    $offset = ($page - 1) * $limit;
    
    $statusFilter = $_GET['status'] ?? '';
    $searchQuery = $_GET['search'] ?? '';
    
    $whereClauses = [];
    $params = [];
    $types = '';
    
    if ($statusFilter) {
        $whereClauses[] = "o.order_status = ?";
        $params[] = $statusFilter;
        $types .= 's';
    }
    
    if ($searchQuery) {
        $whereClauses[] = "(o.customer_name LIKE ? OR o.order_id LIKE ?)";
        $params[] = "%$searchQuery%";
        $params[] = "%$searchQuery%";
        $types .= 'ss';
    }
    
    $where = $whereClauses ? 'WHERE ' . implode(' AND ', $whereClauses) : '';
    
    // Get orders
    $stmt = $conn->prepare("SELECT o.id, o.order_id, o.customer_name, o.order_date, o.order_total, o.order_status 
                          FROM orders o 
                          $where 
                          ORDER BY o.order_date DESC 
                          LIMIT ? OFFSET ?");
    
    if ($whereClauses) {
        $stmt->bind_param($types . 'ii', ...array_merge($params, [$limit, $offset]));
    } else {
        $stmt->bind_param('ii', $limit, $offset);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    
    // Get total count for pagination
    $countStmt = $conn->prepare("SELECT COUNT(*) as total FROM orders o $where");
    if ($whereClauses) {
        $countStmt->bind_param($types, ...$params);
    }
    $countStmt->execute();
    $total = $countStmt->get_result()->fetch_assoc()['total'];
    $pages = ceil($total / $limit);
    
    echo json_encode([
        'orders' => $orders,
        'total' => $total,
        'pages' => $pages,
        'current_page' => $page
    ]);
}

   

function getOrderDetails($conn) {
    $orderId = intval($_GET['order_id']);
    
    // Get order info
    $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->bind_param('i', $orderId);
    $stmt->execute();
    $order = $stmt->get_result()->fetch_assoc();
    
    if (!$order) {
        echo json_encode(['error' => 'Order not found']);
        return;
    }
    
    // Get order items
    $stmt = $conn->prepare("SELECT oi.product_id, oi.product_name, oi.price, oi.quantity, p.image_url 
                           FROM order_items oi 
                           LEFT JOIN products p ON oi.product_id = p.id 
                           WHERE oi.order_id = ?");
    $stmt->bind_param('i', $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $items = [];
    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
        $total += $row['price'] * $row['quantity'];
    }
    
    echo json_encode([
        'order' => $order,
        'items' => $items,
        'total' => $total
    ]);
}

function updateOrderStatus($conn) {
    $orderId = intval($_POST['order_id']);
    $status = $_POST['status'];
    
    $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE id = ?");
    $stmt->bind_param('si', $status, $orderId);
    $success = $stmt->execute();
    
    echo json_encode(['success' => $success]);
}

function getProducts($conn) {
    $searchQuery = $_GET['search'] ?? '';
    
    $where = '';
    $params = [];
    $types = '';
    
    if ($searchQuery) {
        $where = "WHERE name LIKE ?";
        $params[] = "%$searchQuery%";
        $types = 's';
    }
    
    $stmt = $conn->prepare("SELECT id, name, price, stock, category, image_url FROM products $where ORDER BY name");
    if ($where) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    echo json_encode(['products' => $products]);
}

function getCustomers($conn) {
    $searchQuery = $_GET['search'] ?? '';
    
    $where = '';
    $params = [];
    $types = '';
    
    if ($searchQuery) {
        $where = "WHERE name LIKE ? OR email LIKE ?";
        $params[] = "%$searchQuery%";
        $params[] = "%$searchQuery%";
        $types = 'ss';
    }
    
    $stmt = $conn->prepare("SELECT id, name, email, phone, 
                           (SELECT COUNT(*) FROM orders WHERE customer_email = c.email) as order_count,
                           (SELECT MAX(order_date) FROM orders WHERE customer_email = c.email) as last_order
                           FROM customers c $where ORDER BY name");
    if ($where) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    $customers = [];
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
    
    echo json_encode(['customers' => $customers]);
}

function getEnquiries($conn) {
    $statusFilter = $_GET['status'] ?? '';
    $searchQuery = $_GET['search'] ?? '';
    
    $whereClauses = [];
    $params = [];
    $types = '';
    
    if ($statusFilter) {
        $whereClauses[] = "status = ?";
        $params[] = $statusFilter;
        $types .= 's';
    }
    
    if ($searchQuery) {
        $whereClauses[] = "(name LIKE ? OR subject LIKE ?)";
        $params[] = "%$searchQuery%";
        $params[] = "%$searchQuery%";
        $types .= 'ss';
    }
    
    $where = $whereClauses ? 'WHERE ' . implode(' AND ', $whereClauses) : '';
    
    $stmt = $conn->prepare("SELECT id, name, email, subject, created_at, status FROM enquiries $where ORDER BY created_at DESC");
    if ($whereClauses) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    $enquiries = [];
    while ($row = $result->fetch_assoc()) {
        $enquiries[] = $row;
    }
    
    echo json_encode(['enquiries' => $enquiries]);
}

$conn->close();