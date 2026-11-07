<?php

session_start();
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user["password"])) {

            $_SESSION["name"] = $user["name"];

            header("Location: dashboard.php");
            exit();

        } else {
            $message = "Incorrect password.";
        }

    } else {
        $message = "User not found.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
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

        <h2>Student Login</h2>

        <?php if ($message != "") { ?>
            <p class="message">
                <?php echo $message; ?>
            </p>
        <?php } ?>

        <form method="POST">

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>

        </form>

    </div>

</div>

</body>
</html>