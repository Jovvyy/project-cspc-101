<?php
include 'database.php'; 
session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image']; 
    $product_quantity = 1;

   
    $product_exists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product_id) {
            $item['quantity']++;
            $product_exists = true;
            break;
        }
    }

    if (!$product_exists) {
        $_SESSION['cart'][] = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'image' => $product_image,  
            'quantity' => $product_quantity
        ];
    }
}


$total_cart_items = array_sum(array_column($_SESSION['cart'], 'quantity'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street Hustler - Shop</title>
    <link rel="stylesheet" href="CSS/shop.css">
    <link rel="icon" href="Pictures/logo-white.jpg">
</head>
<body>
    <header>
        <div class="header-left">
            <img src="Pictures/logo.jpg" alt="Logo" class="logo">
            <h1 class="business-name"><i>Street Hustler</i></h1>
        </div>
        <div class="header-right">
            <a href="user_home.php" class="nav-link">Home</a>
            <a href="cart.php" class="cart-icon">
                <img src="Pictures/cart-icon.png" alt="Cart">
                <span class="cart-count"><?php echo $total_cart_items; ?></span> 
            </a>
        </div>
    </header>

    <main>
        <div class="product-container">
            <?php
            
            $fetch_products = mysqli_query($conn2, "SELECT * FROM `product`");

            if (mysqli_num_rows($fetch_products) > 0) {
                while ($product = mysqli_fetch_assoc($fetch_products)) {
            ?>
            <div class="product-card">
                <img src="Pictures/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p>₱<?php echo htmlspecialchars(number_format($product['price'], 2)); ?></p>
                <form action="" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $product['image']; ?>"> 
                    <button type="submit" name="add_to_cart" class="add-to-cart-btn">Add to Cart</button>
                </form>
            </div>
            <?php
                }
            } else {
                echo "<p>No products available in the shop.</p>";
            }
            ?>
        </div>
    </main>
</body>
</html>
