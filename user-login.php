<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/user-login.css">
    <title>Street Hustler - User Login</title>
    <link rel="icon" href="Pictures/logo-white.jpg">
</head>
<body>
<header>
    <img class="logo-header" src="Pictures/logo.jpg" alt="Street Hustler Logo">
    <h1 class="business-name">Street Hustler</h1>
    <a class="a-link" href="index.html"><p class="back">Back</p></a>
</header>

<div class="form-container">
    <form method="post">
        <div class="main-content">
            <div>
                <img class="profile" src="Pictures/profile.jpg" alt="Profile Picture">
            </div>
            <div class="content">
                <input name="email" class="email" type="email" placeholder="Email" required>
                <input name="password" class="password" type="password" placeholder="Password" required>
                <button name="login" value="login" class="login-button">Login</button>
            </div>
        </div>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    require_once "database.php";
    
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn1, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user["password"])) {
        header("Location: user_home.php");
        exit();
    } else {
        
        header("Location: index.html");
        exit();
    }
}
?>
</body>
</html>
