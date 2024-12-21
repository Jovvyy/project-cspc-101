USE your_database_name; -- Replace 'your_database_name' with the name of your database

-- Create the 'orders' table to store the order details
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT, -- Change this to the actual user ID column if you have one
    total_price DECIMAL(10, 2),
    status ENUM('Pending', 'Shipped', 'Completed') DEFAULT 'Pending'
);

-- Create the 'order_items' table to store the individual items in each order
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT, -- Change this to match your product ID
    quantity INT,
    price DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES orders(id) -- Link this table to 'orders'
);
