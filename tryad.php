<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Database connection
try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3307;dbname=greenkart_d", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle form submissions and actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_status'])) {
        $orderId = $_POST['order_id'];
        $newStatus = $_POST['new_status'];
        $stmt = $pdo->prepare("UPDATE purchases SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $orderId]);
        header("Location: admin.php?tab=orders");
        exit;
    }
    
    if (isset($_POST['delete_order'])) {
        $orderId = $_POST['order_id'];
        $stmt = $pdo->prepare("DELETE FROM purchases WHERE id = ?");
        $stmt->execute([$orderId]);
        header("Location: admin.php?tab=orders");
        exit;
    }
    
    if (isset($_POST['delete_product'])) {
        $productName = $_POST['product_name'];
        $stmt = $pdo->prepare("DELETE FROM purchases WHERE product_name = ?");
        $stmt->execute([$productName]);
        header("Location: admin.php?tab=products");
        exit;
    }
    
    if (isset($_POST['delete_customer'])) {
        $customerEmail = $_POST['customer_email'];
        $stmt = $pdo->prepare("DELETE FROM purchases WHERE customer_email = ?");
        $stmt->execute([$customerEmail]);
        header("Location: admin.php?tab=customers");
        exit;
    }
    
    if (isset($_POST['add_customer'])) {
        // In a real application, you would add validation here
        $customerData = [
            $_POST['customer_name'],
            $_POST['customer_email'],
            $_POST['customer_phone'],
            'Default Product',
            100,
            1,
            'Cash on Delivery',
            'Pending',
            date('Y-m-d H:i:s')
        ];
        $stmt = $pdo->prepare("INSERT INTO purchases (customer_name, customer_email, customer_phone, product_name, product_price, quantity, payment_method, status, purchase_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute($customerData);
        header("Location: admin.php?tab=customers");
        exit;
    }
    
    if (isset($_POST['add_product'])) {
        // In a real application, you would add validation here
        $productData = [
            'Default Customer',
            'customer@example.com',
            '1234567890',
            $_POST['product_name'],
            $_POST['product_price'],
            1,
            'Cash on Delivery',
            'Pending',
            date('Y-m-d H:i:s')
        ];
        $stmt = $pdo->prepare("INSERT INTO purchases (customer_name, customer_email, customer_phone, product_name, product_price, quantity, payment_method, status, purchase_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute($productData);
        header("Location: admin.php?tab=products");
        exit;
    }
    
    if (isset($_POST['add_order'])) {
        // In a real application, you would add validation here
        $orderData = [
            $_POST['customer_name'],
            $_POST['customer_email'],
            $_POST['customer_phone'],
            $_POST['product_name'],
            $_POST['product_price'],
            $_POST['quantity'],
            $_POST['payment_method'],
            'Pending',
            date('Y-m-d H:i:s')
        ];
        $stmt = $pdo->prepare("INSERT INTO purchases (customer_name, customer_email, customer_phone, product_name, product_price, quantity, payment_method, status, purchase_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute($orderData);
        header("Location: admin.php?tab=orders");
        exit;
    }
}

// Get all data with pagination and search
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$items_per_page = 10;
$offset = ($current_page - 1) * $items_per_page;

$search_query = isset($_GET['search']) ? $_GET['search'] : '';

// Base queries
$purchases_query = "SELECT * FROM purchases";
$products_query = "SELECT DISTINCT product_name, product_price FROM purchases";
$customers_query = "SELECT DISTINCT customer_name, customer_email FROM purchases";

// Add search conditions if search query exists
if (!empty($search_query)) {
    $search_term = "%$search_query%";
    $purchases_query .= " WHERE customer_name LIKE :search OR customer_email LIKE :search OR product_name LIKE :search";
    $products_query .= " WHERE product_name LIKE :search";
    $customers_query .= " WHERE customer_name LIKE :search OR customer_email LIKE :search";
}

// Complete queries with ordering and pagination
$purchases_query .= " ORDER BY purchase_date DESC LIMIT $items_per_page OFFSET $offset";
$products_query .= " LIMIT $items_per_page OFFSET $offset";
$customers_query .= " LIMIT $items_per_page OFFSET $offset";

// Prepare and execute queries
$purchases_stmt = $pdo->prepare($purchases_query);
$products_stmt = $pdo->prepare($products_query);
$customers_stmt = $pdo->prepare($customers_query);

if (!empty($search_query)) {
    $purchases_stmt->bindParam(':search', $search_term);
    $products_stmt->bindParam(':search', $search_term);
    $customers_stmt->bindParam(':search', $search_term);
}

$purchases_stmt->execute();
$products_stmt->execute();
$customers_stmt->execute();

$purchases = $purchases_stmt->fetchAll();
$products = $products_stmt->fetchAll();
$customers = $customers_stmt->fetchAll();

// Get total counts for pagination
$total_purchases = $pdo->query("SELECT COUNT(*) FROM purchases")->fetchColumn();
$total_products = $pdo->query("SELECT COUNT(DISTINCT product_name) FROM purchases")->fetchColumn();
$total_customers = $pdo->query("SELECT COUNT(DISTINCT customer_email) FROM purchases")->fetchColumn();

$total_pages = ceil($total_purchases / $items_per_page);

// Get stats
$totalOrders = $pdo->query("SELECT COUNT(*) FROM purchases")->fetchColumn();
$totalRevenue = $pdo->query("SELECT SUM(product_price * quantity) FROM purchases")->fetchColumn();
$totalProducts = $pdo->query("SELECT COUNT(DISTINCT product_name) FROM purchases")->fetchColumn();
$totalCustomers = $pdo->query("SELECT COUNT(DISTINCT customer_email) FROM purchases")->fetchColumn();

// Determine current tab
$current_tab = $_GET['tab'] ?? 'dashboard';

// Enhanced product to image mapping with fallbacks
$productImageMap = [
    'Organic Bananas' => 'bananas.jpg',
    'Shimla Apples' => 'Apples.webp',
    'Papaya' => 'Papaya.jpg',
    'Fresh Broccoli' => 'Brocolli.jpg',
    'Hass Avocados' => 'Avocado.webp',
    'Sweet Potatoes' => 'Sweet Potato.jpg',
    'California Almonds' => 'Almonds.jpg',
    'Organic Honey' => 'Honey.jpg',
    'Organic Moong Dal' => 'Moong dal.jpg',
    'Alphonso Mangoes' => 'Alphonso.webp',
    'Pomegranates' => 'Pomogranate.jpg',
    'Sweet Corn' => 'Corn.jpg',
    'Chikoo' => 'Chikoo.jpg',
    'Lychees' => 'Lychee.jpg',
    'Jackfruit' => 'Jackfruit.jpg',
    'Muskmelon' => 'Muskmelon.jpg',
    'Watermelon' => 'Watermelon.jpg',
    'Bitter Gourd' => 'B.jpg',
    'Organic Tomatoes' => 'Tomato.jpg',
    'Fresh Carrots' => 'Carrot.webp',
    'Baby Spinach' => 'Ba.jpg',
    'Colored Capsicum' => 'BellPeppers.avif',
    'French Beans' => 'Bean.jpg',
    'Dried Mango' => 'DrMa.jpg',
    'Sun-Dried Tomatoes' => 'DrTo.jpg',
    'Dried Mushrooms' => 'Mushr.jpg',
    'Dried Cranberries' => 'cran.webp',
    'Dried Apricots' => 'Apri.jpg',
    'Dried Coconut Chips' => 'DrCo.jpg',
    'Organic Quinoa' => 'Quinoa.jpg',
    'Basmati Rice' => 'BaRi.jpeg',
    'Rolled Oats' => 'Oats.webp',
    'Millet Flour' => 'MiFl.jpg',
    'Whole Wheat Flour' => 'WhWe.jpg',
    'Sugar-Free Muesli' => 'Mues.webp',
    'Organic Milk' => 'Milk.jpg',
    'Fresh Paneer' => 'Paneer.jpg',
    'Greek Yogurt' => 'Yogurt.avif',
    'Mozzarella Cheese' => 'Moze.jpg',
    'White Butter' => 'Butter.jpg',
    'Pure Ghee' => 'Ghee.jpg',
    // Default fallback image
    'default' => '7.jpg' // Your logo as fallback
];

function getProductImage($productName, $productImageMap) {
    $imageName = isset($productImageMap[$productName]) ? $productImageMap[$productName] : $productImageMap['default'];
    $imagePath = 'Img/' . $imageName;
    
    // Check if file exists (case-insensitive)
    $directory = 'Img/';
    $files = scandir($directory);
    $foundFile = null;
    
    foreach ($files as $file) {
        if (strtolower($file) == strtolower($imageName)) {
            $foundFile = $file;
            break;
        }
    }
    
    return $foundFile ? 'Img/' . $foundFile : 'Img/' . $productImageMap['default'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - GreenKart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4c774a;
            --secondary: #81b978;
            --light: #f8f9fa;
            --dark: #343a40;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --success: #28a745;
        }
        
        body {
            background-color: var(--light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .sidebar {
            background: var(--dark);
            min-height: 100vh;
            position: fixed;
            width: 250px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            border-radius: 5px;
            margin: 2px 0;
            padding: 10px 15px;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover, 
        .sidebar .nav-link.active {
            background: var(--primary);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
            width: calc(100% - 250px);
        }
        
        .stat-card {
            border-radius: 10px;
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }
        
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
        }
        
        .tab-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .table th {
            background: var(--primary);
            color: white;
            position: sticky;
            top: 0;
        }
        
        .badge {
            padding: 5px 10px;
            font-weight: 500;
            font-size: 0.8rem;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        
        .card:hover {
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }
        
        .card-header {
            background: white;
            border-bottom: 1px solid rgba(0,0,0,0.1);
            font-weight: 600;
            border-radius: 10px 10px 0 0 !important;
        }
        
        .btn-action {
            width: 30px;
            height: 30px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 3px;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-box input {
            padding-left: 35px;
            border-radius: 20px;
        }
        
        .search-box i {
            position: absolute;
            left: 12px;
            top: 10px;
            color: #6c757d;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .report-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }

        /* Modal styles */
        .modal-content {
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .modal-header {
            background-color: var(--primary);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }
        
        .modal-footer {
            border-top: 1px solid rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="p-3">
                <div class="text-center mb-4">
                    <img src="<?= getProductImage('default', $productImageMap) ?>" alt="Logo" class="rounded-circle" width="80">
                    <h5 class="text-white mt-2">GreenKart Admin</h5>
                    <small class="text-muted">Administrator Panel</small>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?= $current_tab == 'dashboard' ? 'active' : '' ?>" 
                           href="admin.php?tab=dashboard">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_tab == 'orders' ? 'active' : '' ?>" 
                           href="admin.php?tab=orders">
                            <i class="fas fa-shopping-cart"></i> Orders
                            <span class="badge bg-danger float-end"><?= $totalOrders ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_tab == 'products' ? 'active' : '' ?>" 
                           href="admin.php?tab=products">
                            <i class="fas fa-box"></i> Products
                            <span class="badge bg-info float-end"><?= $totalProducts ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_tab == 'customers' ? 'active' : '' ?>" 
                           href="admin.php?tab=customers">
                            <i class="fas fa-users"></i> Customers
                            <span class="badge bg-success float-end"><?= $totalCustomers ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_tab == 'reports' ? 'active' : '' ?>" 
                           href="admin.php?tab=reports">
                            <i class="fas fa-chart-bar"></i> Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_tab == 'promotions' ? 'active' : '' ?>" 
                           href="admin.php?tab=promotions">
                            <i class="fas fa-bullhorn"></i> Promotions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_tab == 'inventory' ? 'active' : '' ?>" 
                           href="admin.php?tab=inventory">
                            <i class="fas fa-warehouse"></i> Inventory
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_tab == 'settings' ? 'active' : '' ?>" 
                           href="admin.php?tab=settings">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                    </li>
                    <li class="nav-item mt-4">
                        <a class="nav-link text-danger" href="logout.php">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Dashboard Tab -->
            <div class="tab-content <?= $current_tab == 'dashboard' ? 'active' : '' ?>" id="dashboard">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-tachometer-alt me-2"></i> Dashboard</h2>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" placeholder="Search..." id="dashboardSearch">
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4 g-4">
                    <div class="col-md-3">
                        <div class="stat-card" style="background: linear-gradient(135deg, var(--primary), var(--secondary));">
                            <div class="h2"><?= $totalOrders ?></div>
                            <div>Total Orders</div>
                            <i class="fas fa-shopping-cart fa-2x opacity-25 mt-2"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card" style="background: linear-gradient(135deg, #6c757d, #495057);">
                            <div class="h2">₹<?= number_format($totalRevenue, 2) ?></div>
                            <div>Total Revenue</div>
                            <i class="fas fa-rupee-sign fa-2x opacity-25 mt-2"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card" style="background: linear-gradient(135deg, var(--secondary), #9ccc65);">
                            <div class="h2"><?= $totalProducts ?></div>
                            <div>Products Sold</div>
                            <i class="fas fa-box-open fa-2x opacity-25 mt-2"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card" style="background: linear-gradient(135deg, var(--warning), #ffab00);">
                            <div class="h2"><?= $totalCustomers ?></div>
                            <div>Customers</div>
                            <i class="fas fa-users fa-2x opacity-25 mt-2"></i>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i> Recent Orders</h5>
                        <a href="admin.php?tab=orders" class="btn btn-sm btn-primary">View All</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (array_slice($purchases, 0, 5) as $purchase): ?>
                                    <tr>
                                        <td>#<?= str_pad($purchase['id'], 5, '0', STR_PAD_LEFT) ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="<?= getProductImage($purchase['product_name'], $productImageMap) ?>" 
                                                     class="product-img me-3" 
                                                     onerror="this.src='<?= getProductImage('default', $productImageMap) ?>'">
                                                <div>
                                                    <?= htmlspecialchars($purchase['product_name']) ?>
                                                    <div class="text-muted small">Qty: <?= $purchase['quantity'] ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <strong><?= htmlspecialchars($purchase['customer_name']) ?></strong><br>
                                            <small class="text-muted"><?= htmlspecialchars($purchase['customer_email']) ?></small><br>
                                            <small class="text-muted"><?= htmlspecialchars($purchase['customer_phone']) ?></small>
                                        </td>
                                        <td>₹<?= number_format($purchase['product_price'] * $purchase['quantity'], 2) ?></td>
                                        <td><?= date('d M Y', strtotime($purchase['purchase_date'])) ?></td>
                                        <td>
                                            <span class="badge bg-<?= 
                                                $purchase['status'] == 'Completed' ? 'success' : 
                                                ($purchase['status'] == 'Pending' ? 'warning' : 'danger') 
                                            ?>">
                                                <?= $purchase['status'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-action btn-primary view-order-btn" 
                                                    data-order-id="<?= $purchase['id'] ?>" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <form action="admin.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="order_id" value="<?= $purchase['id'] ?>">
                                                <input type="hidden" name="new_status" value="Completed">
                                                <button type="submit" name="update_status" class="btn btn-sm btn-action btn-success" title="Complete">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Tab -->
            <div class="tab-content <?= $current_tab == 'orders' ? 'active' : '' ?>" id="orders">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-shopping-cart me-2"></i> All Orders</h2>
                    <div class="d-flex">
                        <form method="GET" class="d-flex">
                            <input type="hidden" name="tab" value="orders">
                            <div class="search-box me-2">
                                <i class="fas fa-search"></i>
                                <input type="text" name="search" class="form-control" placeholder="Search orders..." 
                                       value="<?= htmlspecialchars($search_query) ?>">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Search</button>
                        </form>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                            <i class="fas fa-plus me-1"></i> Add Order
                        </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($purchases as $purchase): ?>
                                    <tr>
                                        <td>#<?= str_pad($purchase['id'], 5, '0', STR_PAD_LEFT) ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="<?= getProductImage($purchase['product_name'], $productImageMap) ?>" 
                                                     class="product-img me-3"
                                                     onerror="this.src='<?= getProductImage('default', $productImageMap) ?>'">
                                                <div>
                                                    <?= htmlspecialchars($purchase['product_name']) ?>
                                                    <div class="text-muted small">Qty: <?= $purchase['quantity'] ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <strong><?= htmlspecialchars($purchase['customer_name']) ?></strong><br>
                                            <small class="text-muted"><?= htmlspecialchars($purchase['customer_email']) ?></small>
                                        </td>
                                        <td>₹<?= number_format($purchase['product_price'] * $purchase['quantity'], 2) ?></td>
                                        <td><?= date('d M Y', strtotime($purchase['purchase_date'])) ?></td>
                                        <td>
                                            <span class="badge bg-<?= 
                                                $purchase['payment_method'] == 'Credit Card' ? 'primary' : 
                                                ($purchase['payment_method'] == 'Cash on Delivery' ? 'warning' : 'info') 
                                            ?>">
                                                <?= $purchase['payment_method'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <form action="admin.php" method="POST" class="status-form">
                                                <input type="hidden" name="order_id" value="<?= $purchase['id'] ?>">
                                                <select class="form-select form-select-sm status-select" 
                                                        name="new_status"
                                                        style="background-color: <?= 
                                                            $purchase['status'] == 'Completed' ? 'var(--success)' : 
                                                            ($purchase['status'] == 'Pending' ? 'var(--warning)' : 'var(--danger)') 
                                                        ?>; color: white;">
                                                    <option value="Pending" <?= $purchase['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                                    <option value="Processing" <?= $purchase['status'] == 'Processing' ? 'selected' : '' ?>>Processing</option>
                                                    <option value="Shipped" <?= $purchase['status'] == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                                                    <option value="Completed" <?= $purchase['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                                                    <option value="Cancelled" <?= $purchase['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-action btn-primary view-order-btn" 
                                                    data-order-id="<?= $purchase['id'] ?>" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-action btn-success edit-order-btn" 
                                                    data-order-id="<?= $purchase['id'] ?>" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="admin.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="order_id" value="<?= $purchase['id'] ?>">
                                                <button type="submit" name="delete_order" class="btn btn-sm btn-action btn-danger" 
                                                        title="Delete" onclick="return confirm('Are you sure you want to delete this order?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <nav aria-label="Page navigation" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?= $current_page == 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="admin.php?tab=orders&page=<?= $current_page - 1 ?><?= !empty($search_query) ? '&search=' . urlencode($search_query) : '' ?>" tabindex="-1">Previous</a>
                                </li>
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                        <a class="page-link" href="admin.php?tab=orders&page=<?= $i ?><?= !empty($search_query) ? '&search=' . urlencode($search_query) : '' ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?= $current_page == $total_pages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="admin.php?tab=orders&page=<?= $current_page + 1 ?><?= !empty($search_query) ? '&search=' . urlencode($search_query) : '' ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Products Tab -->
            <div class="tab-content <?= $current_tab == 'products' ? 'active' : '' ?>" id="products">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-box me-2"></i> Products</h2>
                    <div class="d-flex">
                        <form method="GET" class="d-flex">
                            <input type="hidden" name="tab" value="products">
                            <div class="search-box me-2">
                                <i class="fas fa-search"></i>
                                <input type="text" name="search" class="form-control" placeholder="Search products..." 
                                       value="<?= htmlspecialchars($search_query) ?>">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Search</button>
                        </form>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="fas fa-plus me-1"></i> Add Product
                        </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Orders</th>
                                        <th>Revenue</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product): 
                                        $productOrders = $pdo->query("SELECT COUNT(*) FROM purchases WHERE product_name = '".$product['product_name']."'")->fetchColumn();
                                        $productRevenue = $pdo->query("SELECT SUM(product_price * quantity) FROM purchases WHERE product_name = '".$product['product_name']."'")->fetchColumn();
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="<?= getProductImage($product['product_name'], $productImageMap) ?>" 
                                                     class="product-img me-3"
                                                     onerror="this.src='<?= getProductImage('default', $productImageMap) ?>'">
                                                <div>
                                                    <strong><?= htmlspecialchars($product['product_name']) ?></strong>
                                                    <div class="text-muted small">Category: Grocery</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>₹<?= number_format($product['product_price'], 2) ?></td>
                                        <td><?= $productOrders ?></td>
                                        <td>₹<?= number_format($productRevenue, 2) ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-action btn-primary view-product-btn" 
                                                    data-product-name="<?= htmlspecialchars($product['product_name']) ?>" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-action btn-success edit-product-btn" 
                                                    data-product-name="<?= htmlspecialchars($product['product_name']) ?>" 
                                                    data-product-price="<?= $product['product_price'] ?>" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="admin.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>">
                                                <button type="submit" name="delete_product" class="btn btn-sm btn-action btn-danger" 
                                                        title="Delete" onclick="return confirm('Are you sure you want to delete this product and all its orders?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            <button class="btn btn-sm btn-action btn-info product-stats-btn" 
                                                    data-product-name="<?= htmlspecialchars($product['product_name']) ?>" title="Stats">
                                                <i class="fas fa-chart-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customers Tab -->
            <div class="tab-content <?= $current_tab == 'customers' ? 'active' : '' ?>" id="customers">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-users me-2"></i> Customers</h2>
                    <div class="d-flex">
                        <form method="GET" class="d-flex">
                            <input type="hidden" name="tab" value="customers">
                            <div class="search-box me-2">
                                <i class="fas fa-search"></i>
                                <input type="text" name="search" class="form-control" placeholder="Search customers..." 
                                       value="<?= htmlspecialchars($search_query) ?>">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Search</button>
                        </form>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                            <i class="fas fa-plus me-1"></i> Add Customer
                        </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Orders</th>
                                        <th>Total Spent</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($customers as $customer): 
                                        $customerOrders = $pdo->query("SELECT COUNT(*) FROM purchases WHERE customer_email = '".$customer['customer_email']."'")->fetchColumn();
                                        $customerSpent = $pdo->query("SELECT SUM(product_price * quantity) FROM purchases WHERE customer_email = '".$customer['customer_email']."'")->fetchColumn();
                                        $customerPhone = $pdo->query("SELECT customer_phone FROM purchases WHERE customer_email = '".$customer['customer_email']."' LIMIT 1")->fetchColumn();
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-3" style="width: 40px; height: 40px; background-color: #<?= substr(md5($customer['customer_email']), 0, 6) ?>; 
                                                    color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                    <?= strtoupper(substr($customer['customer_name'], 0, 1)) ?>
                                                </div>
                                                <div>
                                                    <strong><?= htmlspecialchars($customer['customer_name']) ?></strong>
                                                    <div class="text-muted small">Member since: <?= date('M Y') ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($customer['customer_email']) ?></td>
                                        <td><?= htmlspecialchars($customerPhone) ?></td>
                                        <td><?= $customerOrders ?></td>
                                        <td>₹<?= number_format($customerSpent, 2) ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-action btn-primary view-customer-btn" 
                                                    data-customer-email="<?= htmlspecialchars($customer['customer_email']) ?>" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-action btn-success edit-customer-btn" 
                                                    data-customer-name="<?= htmlspecialchars($customer['customer_name']) ?>" 
                                                    data-customer-email="<?= htmlspecialchars($customer['customer_email']) ?>" 
                                                    data-customer-phone="<?= htmlspecialchars($customerPhone) ?>" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="admin.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="customer_email" value="<?= htmlspecialchars($customer['customer_email']) ?>">
                                                <button type="submit" name="delete_customer" class="btn btn-sm btn-action btn-danger" 
                                                        title="Delete" onclick="return confirm('Are you sure you want to delete this customer and all their orders?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            <button class="btn btn-sm btn-action btn-info message-customer-btn" 
                                                    data-customer-email="<?= htmlspecialchars($customer['customer_email']) ?>" title="Message">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reports Tab -->
            <div class="tab-content <?= $current_tab == 'reports' ? 'active' : '' ?>" id="reports">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-chart-bar me-2"></i> Reports</h2>
                    <div class="d-flex">
                        <select class="form-select me-2" id="reportPeriod">
                            <option>Last 7 Days</option>
                            <option>Last 30 Days</option>
                            <option selected>Last 90 Days</option>
                            <option>This Year</option>
                            <option>Custom Range</option>
                        </select>
                        <button class="btn btn-primary" id="exportReportBtn">
                            <i class="fas fa-download me-1"></i> Export
                        </button>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="mb-0">Sales Overview</h5>
                            </div>
                            <div class="card-body">
                                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" 
                                     alt="Sales Chart" class="report-img">
                                <p class="text-muted">Sales performance chart showing revenue trends over selected period. The graph will display daily, weekly or monthly sales data based on your selection.</p>
                                <button class="btn btn-primary w-100" id="viewSalesReportBtn">View Detailed Sales Report</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="mb-0">Top Products</h5>
                            </div>
                            <div class="card-body">
                                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" 
                                     alt="Product Performance" class="report-img">
                                <p class="text-muted">Product performance analysis showing top selling items by quantity and revenue. The visualization helps identify best performing products.</p>
                                <button class="btn btn-primary w-100" id="viewProductsReportBtn">View Product Performance Report</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Detailed Reports</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Orders</th>
                                        <th>Revenue</th>
                                        <th>New Customers</th>
                                        <th>Avg. Order Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Today</td>
                                        <td>12</td>
                                        <td>₹5,432.00</td>
                                        <td>3</td>
                                        <td>₹452.67</td>
                                    </tr>
                                    <tr>
                                        <td>Yesterday</td>
                                        <td>18</td>
                                        <td>₹8,765.00</td>
                                        <td>5</td>
                                        <td>₹486.94</td>
                                    </tr>
                                    <tr>
                                        <td>This Week</td>
                                        <td>87</td>
                                        <td>₹42,109.00</td>
                                        <td>23</td>
                                        <td>₹484.01</td>
                                    </tr>
                                    <tr>
                                        <td>This Month</td>
                                        <td>342</td>
                                        <td>₹167,890.00</td>
                                        <td>89</td>
                                        <td>₹490.91</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Promotions Tab -->
            <div class="tab-content <?= $current_tab == 'promotions' ? 'active' : '' ?>" id="promotions">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-bullhorn me-2"></i> Promotions</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPromotionModal">
                        <i class="fas fa-plus me-1"></i> Create Promotion
                    </button>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Active Promotions</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Promotion</th>
                                        <th>Discount</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Summer Sale</td>
                                        <td>20% OFF</td>
                                        <td>15 Jun 2023</td>
                                        <td>15 Jul 2023</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-action btn-primary view-promotion-btn" 
                                                    data-promo-name="Summer Sale" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-action btn-success edit-promotion-btn" 
                                                    data-promo-name="Summer Sale" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>New Customer Offer</td>
                                        <td>15% OFF</td>
                                        <td>1 Jan 2023</td>
                                        <td>31 Dec 2023</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-action btn-primary view-promotion-btn" 
                                                    data-promo-name="New Customer Offer" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-action btn-success edit-promotion-btn" 
                                                    data-promo-name="New Customer Offer" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inventory Tab -->
            <div class="tab-content <?= $current_tab == 'inventory' ? 'active' : '' ?>" id="inventory">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-warehouse me-2"></i> Inventory Management</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInventoryModal">
                        <i class="fas fa-plus me-1"></i> Add Stock
                    </button>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Current Inventory</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>SKU</th>
                                        <th>Current Stock</th>
                                        <th>Reorder Level</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Organic Bananas</td>
                                        <td>BAN-001</td>
                                        <td>120</td>
                                        <td>50</td>
                                        <td><span class="badge bg-success">In Stock</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-action btn-primary view-inventory-btn" 
                                                    data-sku="BAN-001" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-action btn-success edit-inventory-btn" 
                                                    data-sku="BAN-001" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shimla Apples</td>
                                        <td>APP-002</td>
                                        <td>45</td>
                                        <td>30</td>
                                        <td><span class="badge bg-success">In Stock</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-action btn-primary view-inventory-btn" 
                                                    data-sku="APP-002" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-action btn-success edit-inventory-btn" 
                                                    data-sku="APP-002" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Organic Honey</td>
                                        <td>HON-003</td>
                                        <td>12</td>
                                        <td>15</td>
                                        <td><span class="badge bg-warning">Low Stock</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-action btn-primary view-inventory-btn" 
                                                    data-sku="HON-003" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-action btn-success edit-inventory-btn" 
                                                    data-sku="HON-003" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Tab -->
            <div class="tab-content <?= $current_tab == 'settings' ? 'active' : '' ?>" id="settings">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-cog me-2"></i> Settings</h2>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Store Information</h5>
                            </div>
                            <div class="card-body">
                                <form id="storeSettingsForm">
                                    <div class="mb-3">
                                        <label class="form-label">Store Name</label>
                                        <input type="text" class="form-control" value="GreenKart">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Store Email</label>
                                        <input type="email" class="form-control" value="info@greenkart.com">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Store Phone</label>
                                        <input type="tel" class="form-control" value="+91 9876543210">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Store Address</label>
                                        <textarea class="form-control" rows="3">123 Farm Fresh Lane, Organic City</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Administrator Settings</h5>
                            </div>
                            <div class="card-body">
                                <form id="adminSettingsForm">
                                    <div class="mb-3">
                                        <label class="form-label">Admin Email</label>
                                        <input type="email" class="form-control" value="admin@greenkart.com">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Change Password</label>
                                        <input type="password" class="form-control" placeholder="New Password">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Confirm Password">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header bg-danger text-white">
                                <h5 class="mb-0">Danger Zone</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Clear All Data</label>
                                    <p class="text-muted small">This will permanently delete all data from the system.</p>
                                    <button class="btn btn-outline-danger" id="clearDataBtn">Clear Data</button>
                                </div>
                                <div>
                                    <label class="form-label">Reset System</label>
                                    <p class="text-muted small">Reset the system to factory settings.</p>
                                    <button class="btn btn-outline-danger" id="resetSystemBtn">Reset System</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Add Order Modal -->
    <div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="admin.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addOrderModalLabel">Add New Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Customer Email</label>
                            <input type="email" name="customer_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Customer Phone</label>
                            <input type="tel" name="customer_phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Price</label>
                            <input type="number" step="0.01" name="product_price" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select name="payment_method" class="form-select" required>
                                <option value="Cash on Delivery">Cash on Delivery</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="UPI">UPI</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="add_order" class="btn btn-primary">Add Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="admin.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Price</label>
                            <input type="number" step="0.01" name="product_price" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Customer Modal -->
    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="admin.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Customer Email</label>
                            <input type="email" name="customer_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Customer Phone</label>
                            <input type="tel" name="customer_phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="add_customer" class="btn btn-primary">Add Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Promotion Modal -->
    <div class="modal fade" id="addPromotionModal" tabindex="-1" aria-labelledby="addPromotionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPromotionModalLabel">Create New Promotion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Promotion Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Discount Type</label>
                        <select class="form-select">
                            <option>Percentage</option>
                            <option>Fixed Amount</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Discount Value</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Applicable Products</label>
                        <select class="form-select" multiple>
                            <option>All Products</option>
                            <?php foreach ($products as $product): ?>
                                <option><?= htmlspecialchars($product['product_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="createPromotionBtn">Create Promotion</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Inventory Modal -->
    <div class="modal fade" id="addInventoryModal" tabindex="-1" aria-labelledby="addInventoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addInventoryModalLabel">Add Stock to Inventory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Product</label>
                        <select class="form-select">
                            <?php foreach ($products as $product): ?>
                                <option><?= htmlspecialchars($product['product_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SKU</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity to Add</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Reorder Level</label>
                        <input type="number" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="addStockBtn">Add Stock</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Order Modal -->
    <div class="modal fade" id="viewOrderModal" tabindex="-1" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewOrderModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="orderDetailsContent">
                    <!-- Order details will be loaded here via JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Order Modal -->
    <div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="admin.php" method="POST">
                    <input type="hidden" name="order_id" id="editOrderId">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOrderModalLabel">Edit Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="editOrderContent">
                        <!-- Edit form will be loaded here via JavaScript -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_order" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Status update functionality
        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', function() {
                this.closest('form').submit();
            });
        });
        
        // Tab switching functionality
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.getElementById(tabName).classList.add('active');
        }
        
        // Image error fallback
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('img').forEach(img => {
                img.onerror = function() {
                    this.src = '<?= getProductImage("default", $productImageMap) ?>';
                };
            });
            
            // Initialize modals
            const viewOrderModal = new bootstrap.Modal(document.getElementById('viewOrderModal'));
            const editOrderModal = new bootstrap.Modal(document.getElementById('editOrderModal'));
            
            // View order button click handler
            document.querySelectorAll('.view-order-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-order-id');
                    // In a real application, you would fetch order details via AJAX
                    document.getElementById('orderDetailsContent').innerHTML = `
                        <h6>Order #${orderId}</h6>
                        <p>Loading order details...</p>
                    `;
                    viewOrderModal.show();
                    
                    // Simulate loading data
                    setTimeout(() => {
                        document.getElementById('orderDetailsContent').innerHTML = `
                            <h6>Order #${orderId}</h6>
                            <div class="mb-3">
                                <strong>Customer:</strong> John Doe<br>
                                <strong>Email:</strong> john@example.com<br>
                                <strong>Phone:</strong> 9876543210
                            </div>
                            <div class="mb-3">
                                <strong>Product:</strong> Organic Bananas<br>
                                <strong>Quantity:</strong> 2<br>
                                <strong>Price:</strong> ₹120.00<br>
                                <strong>Total:</strong> ₹240.00
                            </div>
                            <div class="mb-3">
                                <strong>Order Date:</strong> 15 Jun 2023<br>
                                <strong>Status:</strong> <span class="badge bg-warning">Pending</span><br>
                                <strong>Payment Method:</strong> Cash on Delivery
                            </div>
                            <div class="mb-3">
                                <strong>Shipping Address:</strong><br>
                                123 Main Street, Bangalore, Karnataka 560001
                            </div>
                        `;
                    }, 500);
                });
            });
            
            // Edit order button click handler
            document.querySelectorAll('.edit-order-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-order-id');
                    document.getElementById('editOrderId').value = orderId;
                    
                    // In a real application, you would fetch order details via AJAX
                    document.getElementById('editOrderContent').innerHTML = `
                        <div class="mb-3">
                            <label class="form-label">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" value="John Doe" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Customer Email</label>
                            <input type="email" name="customer_email" class="form-control" value="john@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Customer Phone</label>
                            <input type="tel" name="customer_phone" class="form-control" value="9876543210" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control" value="Organic Bananas" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Price</label>
                            <input type="number" step="0.01" name="product_price" class="form-control" value="120.00" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" value="2" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select name="payment_method" class="form-select" required>
                                <option value="Cash on Delivery" selected>Cash on Delivery</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="UPI">UPI</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Pending" selected>Pending</option>
                                <option value="Processing">Processing</option>
                                <option value="Shipped">Shipped</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    `;
                    editOrderModal.show();
                });
            });
            
            // View product button click handler
            document.querySelectorAll('.view-product-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productName = this.getAttribute('data-product-name');
                    alert(`Viewing product: ${productName}`);
                });
            });
            
            // Edit product button click handler
            document.querySelectorAll('.edit-product-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productName = this.getAttribute('data-product-name');
                    const productPrice = this.getAttribute('data-product-price');
                    alert(`Editing product: ${productName} with price ${productPrice}`);
                });
            });
            
            // Product stats button click handler
            document.querySelectorAll('.product-stats-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productName = this.getAttribute('data-product-name');
                    alert(`Showing stats for product: ${productName}`);
                });
            });
            
            // View customer button click handler
            document.querySelectorAll('.view-customer-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const customerEmail = this.getAttribute('data-customer-email');
                    alert(`Viewing customer: ${customerEmail}`);
                });
            });
            
            // Edit customer button click handler
            document.querySelectorAll('.edit-customer-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const customerName = this.getAttribute('data-customer-name');
                    const customerEmail = this.getAttribute('data-customer-email');
                    const customerPhone = this.getAttribute('data-customer-phone');
                    alert(`Editing customer: ${customerName} (${customerEmail}, ${customerPhone})`);
                });
            });
            
            // Message customer button click handler
            document.querySelectorAll('.message-customer-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const customerEmail = this.getAttribute('data-customer-email');
                    alert(`Messaging customer: ${customerEmail}`);
                });
            });
            
            // View promotion button click handler
            document.querySelectorAll('.view-promotion-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const promoName = this.getAttribute('data-promo-name');
                    alert(`Viewing promotion: ${promoName}`);
                });
            });
            
            // Edit promotion button click handler
            document.querySelectorAll('.edit-promotion-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const promoName = this.getAttribute('data-promo-name');
                    alert(`Editing promotion: ${promoName}`);
                });
            });
            
            // View inventory button click handler
            document.querySelectorAll('.view-inventory-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const sku = this.getAttribute('data-sku');
                    alert(`Viewing inventory for SKU: ${sku}`);
                });
            });
            
            // Edit inventory button click handler
            document.querySelectorAll('.edit-inventory-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const sku = this.getAttribute('data-sku');
                    alert(`Editing inventory for SKU: ${sku}`);
                });
            });
            
            // Create promotion button click handler
            document.getElementById('createPromotionBtn').addEventListener('click', function() {
                alert('Promotion created successfully!');
                bootstrap.Modal.getInstance(document.getElementById('addPromotionModal')).hide();
            });
            
            // Add stock button click handler
            document.getElementById('addStockBtn').addEventListener('click', function() {
                alert('Stock added successfully!');
                bootstrap.Modal.getInstance(document.getElementById('addInventoryModal')).hide();
            });
            
            // Export report button click handler
            document.getElementById('exportReportBtn').addEventListener('click', function() {
                const period = document.getElementById('reportPeriod').value;
                alert(`Exporting report for ${period}`);
            });
            
            // View sales report button click handler
            document.getElementById('viewSalesReportBtn').addEventListener('click', function() {
                alert('Showing detailed sales report');
            });
            
            // View products report button click handler
            document.getElementById('viewProductsReportBtn').addEventListener('click', function() {
                alert('Showing product performance report');
            });
            
            // Clear data button click handler
            document.getElementById('clearDataBtn').addEventListener('click', function() {
                if (confirm('Are you sure you want to clear all data? This cannot be undone!')) {
                    alert('All data has been cleared!');
                }
            });
            
            // Reset system button click handler
            document.getElementById('resetSystemBtn').addEventListener('click', function() {
                if (confirm('Are you sure you want to reset the system to factory settings? This cannot be undone!')) {
                    alert('System has been reset to factory settings!');
                }
            });
            
            // Store settings form submission
            document.getElementById('storeSettingsForm').addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Store settings saved successfully!');
            });
            
            // Admin settings form submission
            document.getElementById('adminSettingsForm').addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Admin settings updated successfully!');
            });
            
            // Dashboard search functionality
            document.getElementById('dashboardSearch').addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    alert(`Searching for: ${this.value}`);
                }
            });
        });
    </script>
</body>
</html>