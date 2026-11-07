<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? "Contacts"); ?> | ContactBook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="navbar">
        <a href="index.php" class="logo"><span class="logo-box">C</span> ContactBook</a>
        <div class="nav-right">
            <?php if (isset($_SESSION["user_id"])) { ?>
                <span class="user"><?php echo e($_SESSION["user_name"]); ?></span>
                <a href="contact_form.php" class="button">+ New contact</a>
                <a href="logout.php" class="link-light">Logout</a>
            <?php } else { ?>
                <a href="login.php" class="link-light">Login</a>
                <a href="register.php" class="button">Register</a>
            <?php } ?>
        </div>
    </div>
</header>
<main class="container">
