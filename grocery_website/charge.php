<?php
include "config.php";
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_id = $_POST['razorpay_payment_id'] ?? '';
    $amount = $_POST['amount'] / 100; // Convert paise to rupees
    $name = $_POST['name'] ?? '';
    $address = $_POST['address'] ?? '';
    $email = $_POST['email'] ?? '';
    $products = json_decode($_POST['products'], true); // Decode JSON product data

    if (!$name || !$address || !$email || empty($products)) {
        echo "Invalid order details.";
        exit();
    }

    // Check if payment_id exists
    $payment_status = empty($payment_id) ? 'Failed' : 'Paid';
    $order_status = empty($payment_id) ? 'Cancelled' : 'Pending';

    // Debugging logs
    error_log("Payment ID: " . $payment_id);
    error_log("Payment Status: " . $payment_status);

    // Insert orders into the database for each product
    $stmt = $conn->prepare("INSERT INTO orders (user_id, name, address, email, product_name, quantity, total_price, payment_id, payment_status, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Statement preparation failed: " . $conn->error);
    }

    foreach ($products as $product) {
        $productName = $product['product_name'];
        $quantity = $product['quantity'];
        $stmt->bind_param("issssidsis", $user_id, $name, $address, $email, $productName, $quantity, $amount, $payment_id, $payment_status, $order_status);
        $stmt->execute();
    }

    // Get last inserted order ID (for email)
    $order_id = $conn->insert_id;

    // If payment is successful, clear the cart
    if ($payment_status === 'Paid') {
        $deleteCart = $conn->prepare("DELETE FROM cart WHERE u_id = ?");
        $deleteCart->bind_param("i", $user_id);
        $deleteCart->execute();
    }

    // Send email to user with order details
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Use Gmail's SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'demowork10001@gmail.com'; // Replace with your email
        $mail->Password = 'ahzkmvqzvvmhklok'; // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('demowork10001@gmail.com', 'E-commerce Website');
        $mail->addAddress($email, $name); // Add user's email address here

        // Order details in email
        $orderDetails = "<h2>Thank you for your purchase, $name!</h2>
            <p>Your payment has been successfully processed. Here are your order details:</p>
            <ul>
                <li><strong>Order ID:</strong> $order_id</li>
                <li><strong>Payment ID:</strong> $payment_id</li>
                <li><strong>Amount:</strong> ₹" . number_format($amount, 2) . "</li>
                <li><strong>Address:</strong> $address</li>
                <li><strong>Email:</strong> $email</li>
                <li><strong>Products:</strong></li>
                <ul>";

        foreach ($products as $product) {
            $orderDetails .= "<li>" . $product['product_name'] . " (Qty: " . $product['quantity'] . ")</li>";
        }

        $orderDetails .= "</ul></ul><p>Thank you for shopping with us!</p>";

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Order Confirmation - Payment Successful';
        $mail->Body = $orderDetails;

        $mail->send();
        error_log("Success: Email sent to user");
    } catch (Exception $e) {
        error_log("Error: Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }

    echo "success";
    $stmt->close();
    $conn->close();
}
?>