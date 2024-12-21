<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/feedback.css">
    <title>Customer Feedback</title>
    <link rel="icon" href="Pictures/logo-white.jpg">
</head>
<body>
    <div class="header">
        <h1>Customer Feedback</h1>
    </div>
    <div class="nav">
        <a href="admin_dashboard.php" class="dashboard-link">Back to Admin Dashboard</a>
    </div>
    <div class="table-container">
        <table class="feedback-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   include 'database.php';

                   $sql = "SELECT name, message FROM feedback";
                   $result = $conn1-> query ($sql);

                   if ($result-> num_rows > 0) {
                       while ($row = $result-> fetch_assoc()) {
                           echo "<tr>
                                   <td>" . htmlspecialchars($row["name"]) . "</td>
                                   <td>" . htmlspecialchars($row["message"]) . "</td>
                                 </tr>";
                       }
                   } else {
                       echo "<tr><td colspan='2'>No feedback available.</td></tr>";
                   }

                   $conn1-> close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
