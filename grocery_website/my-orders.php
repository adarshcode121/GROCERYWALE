<?php
session_start(); // Start session at the very beginning

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

include 'config.php';
include './Nav/Manu.php';

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    echo "<p style='text-align:center; color:red;'>Please log in to view your orders.</p>";
    exit;
}

// Fetch user orders
$order_query = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY order_date DESC";
$result = mysqli_query($conn, $order_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        padding-top: 60px;
        text-align: center;
    }

    .container {
        width: 90%;
        max-width: 1200px;
        margin: 30px auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .orders-wrapper {
        width: 100%;
    }

    .orders-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        padding: 20px 0;
    }

    .order {
    flex: 0 0 calc(33.33% - 20px);
    width: 300px;
    min-height: 320px; /* ⬅️ Yeh line add karo ya badhao */
    padding: 15px;
    border-radius: 8px;
    background: #fafafa;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    text-align: left;
}


    .order:nth-child(even) {
        background: #f0f8ff;
    }

    .status {
        padding: 5px 12px;
        border-radius: 5px;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 12px;
        position: absolute;
        bottom: 10px;
        left: 15px;
    }

    .status.Pending {
        background: #ffc107;
        color: #fff;
    }

    .status.Processing {
        background: #17a2b8;
        color: #fff;
    }

    .status.Shipped {
        background: #007bff;
        color: #fff;
    }

    .status.Delivered {
        background: #28a745;
        color: #fff;
    }

    .status.Cancelled {
        background: #dc3545;
        color: #fff;
    }

    .cancel-btn {
        padding: 5px 12px;
        border-radius: 5px;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 12px;
        position: absolute;
        bottom: 10px;
        right: 15px;
        background: #dc3545;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .head_name {
        margin-left: 450px;
    }
</style>

</head>

<body>
    <div class="container">
        <h2 class="head_name">My Orders</h2>
    </div>

    <div class="container orders-wrapper">
        <div class="orders-container">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($order = mysqli_fetch_assoc($result)): ?>
                    <div class="order">
                        <div class="order-info">
                            <h3><?php echo htmlspecialchars($order['product_name']); ?></h3>
                            <p>Quantity: <?php echo htmlspecialchars($order['quantity']); ?></p>
                            <p>Total Price: ₹<?php echo htmlspecialchars($order['total_price']); ?></p>
                            <p class="order-date">Ordered on: <?php echo date('d M Y, H:i A', strtotime($order['order_date'])); ?></p>
                            <p>Payment ID: <?php echo htmlspecialchars($order['payment_id']); ?></p>
                            <p>Payment Status: <?php echo htmlspecialchars($order['payment_status']); ?></p>
                        </div>
                        <span class="status <?php echo htmlspecialchars($order['status']); ?>">
                            <?php echo htmlspecialchars($order['status']); ?>
                        </span>
                        <?php if ($order['status'] != 'Cancelled' && $order['status'] != 'Delivered'): ?>
                            <form method="POST" action="cancel_order.php" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <button type="submit" class="cancel-btn">Cancel</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="text-align:center; color:#555;">No orders found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function scrollProducts(scrollValue) {
            document.getElementById("productContainer").scrollBy({
                left: scrollValue,
                behavior: "smooth"
            });
        }
    </script>

    <?php include "./Nav/footer.php"; ?>
</body>

</html>
