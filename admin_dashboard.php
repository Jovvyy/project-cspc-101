<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/admin_dashboard.css">
    <link rel="icon" href="Pictures/logo-white.jpg">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="wrapper">
        <header>
            <h1>Admin Dashboard</h1>
        </header>

        <div class="main-content">
            <div class="card">
                <a href="admin-order.php"><button class="card-btn">Orders</button></a>
            </div>
            <div class="card">
                <a href="add-product.php"><button class="card-btn">Add Product</button></a>
            </div>
            <div class="card">
                <a href="view_product.php"><button class="card-btn">View Product</button></a>
            </div>
            <div class="card">
                <a href="feedback.php"><button class="card-btn">Customer Feedback</button></a>
            </div>
            <div class="card">
                <a href="registered_users.php"><button class="card-btn">Users</button></a>
            </div>
            <div class="card">
                <a href="admin-register.php"><button class="card-btn">Add Admin</button></a>
            </div>
            <div class="logout-wrapper">
                <a href="logout.php"><button class="logout-btn">Logout</button></a>
            </div>
        </div>
    </div>
</body>
</html>
