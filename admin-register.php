<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/admin-register.css">
    <title>Street Hustler - Add Admin</title>
    <link rel="icon" href="Pictures/logo-white.jpg">
</head>
<body>
    <div class="header">
        Add Admin
    </div>

    <div class="dashboard-link">
        <a href="admin_dashboard.php" class="go-to-dashboard">Go to Admin Dashboard</a>
    </div>

    <form method="post">
        <div class="main-div">  
            <input name="fullname" class="fullname" type="text" placeholder="Fullname" required>
            <input name="email" class="email" type="email" placeholder="Email" required>
            <input name="password" class="password" type="password" placeholder="Password" required>
            <input name="confirmpass" class="confirm-password" type="password" placeholder="Confirm Password" required>
            <button name="register" value="register" class="submit-button">Submit</button>

            <?php
                if (isset($_POST["register"])) {
                    $fullname = $_POST["fullname"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $confirmpassword = $_POST["confirmpass"];
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $errors = array();
                    
                    if (empty($fullname) OR empty($email) OR empty($password) OR empty($confirmpassword)) {
                        array_push($errors, "ALL FIELDS ARE REQUIRED");
                    }
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        array_push($errors, "Email is not valid");
                    }
                    if (strlen($password) < 8) {
                        array_push($errors, "Password must be at least 8 characters long");
                    }
                    if ($password !== $confirmpassword) {
                        array_push($errors, "Password does not match");
                    }

                    require_once "database.php";
                    $sql = "SELECT * FROM admins WHERE email = '$email'";
                    $result = mysqli_query($conn1, $sql);
                    $rowCount = mysqli_num_rows($result);
                    if ($rowCount > 0) {
                        array_push($errors, "Email already exists!");
                    }

                    if (count($errors) > 0) {
                        foreach ($errors as $error) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    } else {
                        require_once "database.php";
                        $sql = "INSERT INTO admins (fullname, email, password) VALUES (?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn1);
                        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                        if ($prepareStmt) {
                            mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $passwordHash);
                            mysqli_stmt_execute($stmt);
                            echo "<div class='alert alert-success'>You are registered successfully.</div>";
                        } else {
                            die("something went wrong");
                        }
                    }
                }
            ?>
        </div>
    </form>    
</body>
</html>
