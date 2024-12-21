<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/contact.css">
    <link rel="icon" href="Pictures/logo-white.jpg">
    <title>Street Hustler - Contact</title>
</head>
<body>

<header>
    <div class="Logo-BusinessName-div">
        <img class="logo-header" src="Pictures/logo.jpg" alt="Logo">
        <h1 class="business-name"><i>Street Hustler</i></h1>
    </div>
    <a href="user_home.php" class="home-link">Home</a>
</header>

<main>
    <section class="contact-form-section">
        <div class="contact-form-container">
            <h2 class="contact-form-title">Leave a Message</h2>
            <form method="post">
                <input name="name" class="input-field" type="text" placeholder="Your Name" required>
                <input name="email" class="input-field" type="email" placeholder="Your Email" required>
                <input name="number" class="input-field" type="text" placeholder="Your Phone Number" required>
                <textarea name="message" class="input-field" placeholder="Your Message" required></textarea>
                <button name="submit" value="submit" class="submit-button">Submit</button>
            </form>
        </div>
    </section>

    <section class="contact-detail-section">
        <h2 class="contact-detail-title">Contact Details</h2>
        <div class="contact-details">
            <div class="contact-item">
                <img class="contact-icon" src="Pictures/address-icon.jpg" alt="Address Icon">
                <div>
                    <p class="contact-label">Address</p>
                    <p class="contact-info">Pasonanca, Zamboanga City</p>
                </div>
            </div>
            <div class="contact-item">
                <img class="contact-icon" src="Pictures/phone-icon.jpg" alt="Phone Icon">
                <div>
                    <p class="contact-label">Phone Number</p>
                    <p class="contact-info">09756304967</p>
                </div>
            </div>
            <div class="contact-item">
                <img class="contact-icon" src="Pictures/contact-us-icon.jpg" alt="Email Icon">
                <div>
                    <p class="contact-label">Email</p>
                    <p class="contact-info">delatorrejovin7@gmail.com</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
    include('database.php');
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $message = $_POST['message'];

        $query = mysqli_query($conn1, "INSERT INTO feedback (name, email, phonenumber, message) 
         VALUES ('$name', '$email', '$number', '$message')");
        if ($query) {
            echo "<script>alert('Message Sent!');</script>";
        } else {
            echo "<script>alert('Error submitting your message.');</script>";
        }
    }
?>

</body>
</html>
