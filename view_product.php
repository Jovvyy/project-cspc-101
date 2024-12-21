<?php
    include 'database.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="CSS/view_product.css">
        <link rel="icon" href="Pictures/logo-white.jpg">
        <title>Street Hustler - View Product</title>
    </head>

    <body>
        <div class="header">
            View Product
        </div>

        <div class="back-btn-container">
            <a href="admin_dashboard.php"><button class="back-btn">Back to Admin Dashboard</button></a>
        </div>


        <div class="container">
            <section class="display-product">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $display_product = mysqli_query($conn2, "SELECT * FROM `product`");

                        if (mysqli_num_rows($display_product) > 0) {
                            $counter = 1; 
                            while ($row = mysqli_fetch_assoc($display_product)) {
                        ?>
                        <tr>
                            <td><?php echo $counter++; ?></td>
                            <td>
                                <?php if (!empty($row['image'])) { ?>
                                    <img src="Pictures/<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                                <?php } else { ?>
                                    <span>No Image</span>
                                <?php } ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>"><button class="edit-btn">Edit</button></a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');"><button class="delete-btn">Delete</button></a>

                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                            
                            echo '<tr><td colspan="5">No Products Available</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </body>
</html>
