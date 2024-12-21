<?php
include 'database.php'; 
session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $remove_id) {
            unset($_SESSION['cart'][$key]);
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); 
}


$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'] * $item['quantity'];
}


if (isset($_GET['buy']) && $_GET['buy'] == 'true') {
    
    if (!empty($_SESSION['cart'])) {
        $user_id = 1; 
        $order_query = "INSERT INTO orders (user_id, total_price, status) VALUES ($user_id, $total_price, 'Pending')";
        mysqli_query($conn2, $order_query);
        $order_id = mysqli_insert_id($conn2); 

        
        foreach ($_SESSION['cart'] as $item) {
            $product_id = $item['id'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $order_item_query = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                                 VALUES ($order_id, $product_id, $quantity, $price)";
            mysqli_query($conn2, $order_item_query);
        }

        
        $_SESSION['order'] = $_SESSION['cart'];
        $_SESSION['total_price'] = $total_price;
        $_SESSION['cart'] = []; 

        header('Location: user-success.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="CSS/cart.css">
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
                <a href="cart.php" class="cart-icon">
                    <img src="Pictures/cart-icon.png" alt="Cart">
                    <span class="cart-count"><?php echo count($_SESSION['cart']); ?></span>
                </a>
            </div>
        </div>
    </header>

    <main>
    <h2>Your Cart</h2>

    <div class="cart-container">
        <?php if (count($_SESSION['cart']) > 0): ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <tr>
                            <td>
                                <img src="Pictures/<?php echo htmlspecialchars($item['image']); ?>" alt="Product Image" class="cart-image">
                            </td>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td>₱<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                            <td><a href="cart.php?remove=<?php echo $item['id']; ?>" class="remove-btn">Remove</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="cart-total">
                <h3>Total: ₱<?php echo number_format($total_price, 2); ?></h3>
                
                <a href="cart.php?buy=true" class="checkout-btn">Buy</a>
            </div>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>

    
        <div class="back-btn-container">
            <a href="shop.php" class="back-btn">Back to Shop</a>
        </div>
    </div>
</main>

</body>
</html>
