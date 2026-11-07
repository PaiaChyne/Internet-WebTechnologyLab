<?php

include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password)
            VALUES ('$name', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        $message = "Registration successful!";
    } else {
        $message = "Email already exists or registration failed.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>

<nav>
    <a href="index.php">Home</a>
    <a href="login.php">Login</a>
    <a href="register.php">Registration</a>
    <a href="about.php">About Us</a>
</nav>

<div class="container">

    <div class="form-box">

        <h2>Student Registration</h2>

        <?php if ($message != "") { ?>
            <p class="message success">
                <?php echo $message; ?>
            </p>
        <?php } ?>

        <form method="POST" onsubmit="return validateForm()">

            <label>Name</label>
            <input type="text" id="name" name="name">

            <label>Email</label>
            <input type="email" id="email" name="email">

            <label>Password</label>
            <input type="password" id="password" name="password">

            <button type="submit">Register</button>

        </form>

    </div>

</div>

</body>
</html>