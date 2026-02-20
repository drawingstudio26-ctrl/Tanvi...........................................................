<?php
// Database connection
$conn = new mysqli("127.0.0.1", "root", "", "greenkart_d", 3310);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get values from POST
$name = $_POST['enquiryName'] ?? '';
$email = $_POST['enquiryEmail'] ?? '';
$phone = $_POST['enquiryPhone'] ?? '';
$subject = $_POST['enquirySubject'] ?? '';
$message = $_POST['enquiryMsg'] ?? '';

// Simple validation
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo "<script>alert('All fields are required.'); window.history.back();</script>";
    exit;
}

// Insert into ENQUIRIES table
$stmt = $conn->prepare("INSERT INTO ENQUIRIES (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

if ($stmt->execute()) {
    echo "<script>alert('Enquiry submitted successfully!'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Database error: " . $conn->error . "'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
