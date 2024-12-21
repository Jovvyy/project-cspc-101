<?php
    include 'database.php';  
    $display_message = '';

    if (isset($_POST['login'])) {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_FILES['product_image']['name'];
        $product_image_temp_name = $_FILES['product_image']['tmp_name'];
        $product_image_folder = 'Pictures/'.$product_image;

        $insert_query = mysqli_query($conn2, "INSERT INTO `product` (name, price, image) VALUES ('$product_name', '$product_price', '$product_image')")
            or die("Insert query failed");

        if ($insert_query) {
            move_uploaded_file($product_image_temp_name, $product_image_folder);
            $display_message = 'Product inserted successfully!';
            $message_type = 'success';  
        } else {
            $display_message = 'There was an error inserting the product.';
            $message_type = 'error';  
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/add-product.css">
    <link rel="icon" href="Pictures/logo-white.jpg">
    <title>Street Hustler - Add Product</title>
</head>
<body>  
    <header>
        <h1>Add Product</h1>
    </header>

    <nav>
        <a href="admin_dashboard.php" class="back-link">Back to Dashboard</a>
    </nav>

    <div class="main-container">
        <form action="" method="post" enctype="multipart/form-data" class="product-form">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" id="product_name" placeholder="Enter Product Name" required>
            </div>
            <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="number" name="product_price" id="product_price" min="0" placeholder="Enter Product Price" required>
            </div>
            <div class="form-group">
                <label for="product_image">Product Image</label>
                <input type="file" name="product_image" id="product_image" accept="image/png, image/jpg, image/jpeg" required>
            </div>
            <button type="submit" name="login" class="submit-btn">Add Product</button>

            <?php
                if ($display_message != '') {
                    echo "<div class='display_message $message_type'>
                            <span>$display_message</span>
                            <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
                          </div>";
                }
            ?>
        </form>
    </div>
</body> 
</html>

