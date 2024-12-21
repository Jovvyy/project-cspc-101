<?php
include 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $result = mysqli_query($conn2, "SELECT * FROM `product` WHERE id = $id");
    $product = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];

        
        if (!empty($image)) {
            $target = "Pictures/" . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
        } else {
            $image = $product['image'];
        }

       
        $update_query = "UPDATE `product` SET name = '$name', price = '$price', image = '$image' WHERE id = $id";
        if (mysqli_query($conn2, $update_query)) {
            header('Location: view_product.php');
            exit();
        } else {
            echo "Error updating product: " . mysqli_error($conn2);
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
    <link rel="stylesheet" href="CSS/edit_product.css">
    <title>Edit Product</title>
</head>
<body>
    <div class="header">Edit Product</div>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data" class="form">
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="price">Product Price:</label>
                <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="image">Product Image:</label>
                <input type="file" id="image" name="image">
                <div class="image-preview">
                    Current Image:
                    <?php if (!empty($product['image'])) { ?>
                        <img src="Pictures/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
                    <?php } else { ?>
                        <span>No Image</span>
                    <?php } ?>
                </div>
            </div>
            
            <div class="form-buttons">
                <button type="submit" class="btn save-btn">Save Changes</button>
                <a href="view_product.php" class="btn cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
