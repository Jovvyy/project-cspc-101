<?php
include 'database.php'; 
session_start();

if (isset($_GET['delete_order'])) {
    $order_id = $_GET['delete_order'];

    $delete_items_query = "DELETE FROM order_items WHERE order_id = $order_id";
    mysqli_query($conn2, $delete_items_query);

    $delete_query = "DELETE FROM orders WHERE id = $order_id";
    mysqli_query($conn2, $delete_query);

    header('Location: admin-order.php');
    exit();
}

if (isset($_GET['done_order'])) {
    $order_id = $_GET['done_order'];

    $done_query = "UPDATE orders SET status = 'Completed' WHERE id = $order_id";
    mysqli_query($conn2, $done_query);

    header('Location: admin-order.php');
    exit();
}

$order_query = "SELECT * FROM orders WHERE status IN ('Pending', 'Completed')"; 
$order_result = mysqli_query($conn2, $order_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
    <link rel="stylesheet" href="CSS/admin-order.css">
    <link rel="icon" href="Pictures/logo-white.jpg">
    <style>
        .done-btn {
            background-color: #4CAF50; 
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .done-btn:hover {
            background-color: #45a049;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #e53935;
        }
        .completed-order {
            background-color: #d4edda;
        }
        .pending-order {
            background-color: #fff3cd; 
        }
        img.product-image {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo-container">
                <img src="Pictures/logo.jpg" alt="Logo" class="logo">
                <h1 class="business-name"><i>Street Hustler</i></h1>
            </div>
            <div class="header-links">
                <a href="admin_dashboard.php" class="nav-link">Back To Dashboard</a>
            </div>
        </div>
    </header>

    <main>
        <h2>All Orders</h2>

        <div class="orders-container">
            <?php if (mysqli_num_rows($order_result) > 0): ?>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Items</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($order = mysqli_fetch_assoc($order_result)): ?>
                            <tr class="<?php echo $order['status'] == 'Completed' ? 'completed-order' : 'pending-order'; ?>">
                                <td><?php echo $order['id']; ?></td>
                                <td>₱<?php echo number_format($order['total_price'], 2); ?></td>
                                <td>
                                    <ul>
                                        <?php
                                        $order_id = $order['id'];
                                        $items_query = "SELECT product_id, quantity, price, product_image FROM order_items WHERE order_id = $order_id";
                                        $items_result = mysqli_query($conn2, $items_query);
                                        while ($item = mysqli_fetch_assoc($items_result)) {
                                            echo "<li>";

                                            echo "<img src='Pictures/products/" . $item['product_image'] . "' alt='" . $item['product_id'] . "' class='product-image'>";
                                            
                                            echo $item['quantity'] . " x " . $item['product_id'] . " at ₱" . number_format($item['price'], 2);
                                            echo "</li>";
                                        }
                                        ?>
                                    </ul>
                                </td>
                                <td><?php echo $order['status']; ?></td>
                                <td>
                                    <?php if ($order['status'] == 'Pending'): ?>
                                        <a href="admin-order.php?done_order=<?php echo $order['id']; ?>" class="done-btn" onclick="return confirm('Are you sure this order is done?');">Done</a>
                                    <?php endif; ?>
                                    <a href="admin-order.php?delete_order=<?php echo $order['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No orders available.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
