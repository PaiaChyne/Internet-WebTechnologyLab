<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? "Nexora"); ?> | Nexora Technologies</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="navbar">
        <a href="index.php" class="logo">
            <div class="logo-box">N</div>
            <div><h2>Nexora</h2><span>Technologies</span></div>
        </a>
        <nav>
            <a href="index.php">Home</a>
            <?php if (isset($_SESSION["id"])) { ?>
                <a href="dashboard.php">Dashboard</a>
                <a href="profile.php">My Profile</a>
                <a href="logout.php">Logout</a>
            <?php } else { ?>
                <a href="register.php">Registration</a>
                <a href="login.php">Login</a>
            <?php } ?>
        </nav>
        <?php if (isset($_SESSION["name"])) { ?>
            <span class="top-button"><?php echo e($_SESSION["name"]); ?></span>
        <?php } else { ?>
            <a href="register.php" class="top-button">Get Started</a>
        <?php } ?>
    </div>
</header>
