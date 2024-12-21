<?php
session_start(); // Start session for error/success messages
if (isset($_POST["register"])) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpass"];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $errors = array();

    // Validation checks
    if (empty($fullname) || empty($email) || empty($password) || empty($confirmpassword)) {
        array_push($errors, "All fields are required.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid.");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long.");
    }
    if ($password !== $confirmpassword) {
        array_push($errors, "Passwords do not match.");
    }

    // Check for existing email
    require_once "database.php";
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn1);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, "Email already exists!");
        }
    }

    
    if (count($errors) > 0) {
        $_SESSION["errors"] = $errors;
    } else {
        $sql = "INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)";
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $passwordHash);
            mysqli_stmt_execute($stmt);
            $_SESSION["success"] = "You are registered successfully.";
        } else {
            $_SESSION["errors"] = ["Something went wrong. Please try again."];
        }
    }
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/user-register.css">
    <title>Street Hustler - Sign Up</title>
    <link rel="icon" href="Pictures/logo-white.jpg">
</head>
<body>
    <header class="header">
        <img class="logo-header" src="Pictures/logo.jpg" alt="Street Hustler Logo">
        <h1 class="business-name">Street Hustler</h1>
        <a class="a-link" href="index.html"><p class="back">Back</p></a>
    </header>

    <main class="main-container">
        <form method="post" class="form">
            <?php
            if (isset($_SESSION["errors"])) {
                foreach ($_SESSION["errors"] as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
                unset($_SESSION["errors"]);
            }
            if (isset($_SESSION["success"])) {
                echo "<div class='alert alert-success'>" . $_SESSION["success"] . "</div>";
                unset($_SESSION["success"]);
            }
            ?>
            <h2 class="sign-up-header">Sign Up</h2>
            <input name="fullname" class="input-field" type="text" placeholder="Full Name" required>
            <input name="email" class="input-field" type="email" placeholder="Email" required>
            <input name="password" class="input-field" type="password" placeholder="Password" required minlength="8">
            <input name="confirmpass" class="input-field" type="password" placeholder="Confirm Password" required minlength="8">
            <button name="register" value="register" class="submit-button">Submit</button>
        </form>
    </main>
</body>
</html>
