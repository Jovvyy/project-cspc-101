<?php
session_start();


if (isset($_SESSION['order'])) {
    $order_success = "Order successful! Your order is being prepared. Please wait. Thank you!";
    $order_details = $_SESSION['order'];
    $total_price = $_SESSION['total_price'];

    
    unset($_SESSION['order']);
    unset($_SESSION['total_price']);
} else {
    $order_success = "No orders placed yet.";
    $order_details = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="CSS/user-success.css">
    <link rel="icon" href="Pictures/logo-white.jpg">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo-container">
                <img src="Pictures/logo.jpg" alt="Logo" class="logo">
                <h1 class="business-name"><i>Street Hustler</i></h1>
            </div>
            <div class="header-links">
                <a href="user_home.php" class="nav-link">Home</a>
            </div>
        </div>
    </header>

    <main>
        <div class="confirmation-container">
            <h2 class="order-status"><?php echo $order_success; ?></h2>

            <?php if (!empty($order_details)): ?>
                <h3 class="order-details-heading">Order Details:</h3>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_details as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td>₱<?php echo number_format($item['price'], 2); ?></td>
                                <td><?php echo $item['quantity']; ?></td>
                                <td>₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h3 class="total-price">Total Price: ₱<?php echo number_format($total_price, 2); ?></h3>
            <?php endif; ?>

        </div>
    </main>

</body>
</html>
