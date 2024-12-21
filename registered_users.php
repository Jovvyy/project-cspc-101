<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/registered_users.css">
    <title>Registered Users</title>
    <link rel="icon" href="Pictures/logo-white.jpg">
</head>
<body>
    <div class="header">
        Registered Users
    </div>

    <div class="center">
        <a href="admin_dashboard.php" class="back-link">Back to Admin Dashboard</a>
    </div>

    <table class="main">
        <tr>
            <th>Id</th>
            <th>Fullname</th>
            <th>Email</th>
        </tr>

        <?php
            include 'database.php';

            $sql = "SELECT id, fullname, email FROM users";
            $result = $conn1->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["fullname"] . "</td>
                            <td>" . $row["email"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No results found</td></tr>";
            }

            $conn1->close();
        ?>
    </table>
</body>
</html>
