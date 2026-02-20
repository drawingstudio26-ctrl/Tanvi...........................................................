<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration for CONTACT FORM
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "greenkart_d";
$port = 3310;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Only process if it's a contact form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['action'])) {
    // Get and sanitize form data
    $name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? $conn->real_escape_string($_POST['phone']) : '';
    $subject = isset($_POST['subject']) ? $conn->real_escape_string($_POST['subject']) : '';
    $message = isset($_POST['message']) ? $conn->real_escape_string($_POST['message']) : '';

    // Validate required fields
    if (empty($name) || empty($email) || empty($message)) {
        die("Error: Please fill all required fields (Name, Email, Message)");
    }

    // Prepare and execute SQL
    $sql = "INSERT INTO contact_submissions (name, email, phone, subject, message, created_at) 
            VALUES (?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

    if ($stmt->execute()) {
        header("Location: index.php?success=1");
        exit();
    } else {
        die("Error: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>