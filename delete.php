<?php
include 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $result = mysqli_query($conn2, "SELECT * FROM `product` WHERE id = $id");
    $product = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $delete_query = "DELETE FROM `product` WHERE id = $id";
        if (mysqli_query($conn2, $delete_query)) {
            header('Location: view_product.php');
            exit();
        } else {
            echo "Error deleting product: " . mysqli_error($conn2);
        }
    }
} else {
    echo "No product ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/delete_product.css">
    <title>Delete Product</title>
</head>
<body>
    <div class="header">Delete Product</div>
    <div class="container">
        <div class="delete-confirmation">
            <h2>Are you sure you want to delete this product?</h2>
            <p><strong>Product Name:</strong> <?php echo htmlspecialchars($product['name']); ?></p>
            <p><strong>Product Price:</strong> <?php echo htmlspecialchars($product['price']); ?></p>
            <?php if (!empty($product['image'])) { ?>
                <img src="Pictures/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
            <?php } else { ?>
                <p><strong>Image:</strong> No Image Available</p>
            <?php } ?>

            <form action="" method="POST" class="form-container">
                <button type="submit" class="btn delete-btn">Yes, Delete</button>
                <a href="view_product.php" class="btn cancel-btn">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
