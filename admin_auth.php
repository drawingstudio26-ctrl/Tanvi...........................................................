<?php
session_start();
header("Content-Type: application/json");

// Hardcoded admin credentials (in production, use database)
$admin_username = "admin";
$admin_password = "admin123"; // Change this in production!

$action = $_POST['action'] ?? '';

if ($action === 'login') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
    }
    
} elseif ($action === 'logout') {
    session_destroy();
    echo json_encode(['success' => true]);
    
} elseif ($action === 'check_auth') {
    echo json_encode(['logged_in' => isset($_SESSION['admin_logged_in'])]);
    
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
}
?>