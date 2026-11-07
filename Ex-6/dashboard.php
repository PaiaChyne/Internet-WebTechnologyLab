<?php

session_start();

if (!isset($_SESSION["name"])) {
    header("Location: login.php");
    exit();
}

$name = $_SESSION["name"];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav>
    <a href="index.php">Home</a>
    <a href="dashboard.php">Dashboard</a>
    <a href="about.php">About Us</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="container">

    <h1>Student Dashboard</h1>

    <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>

    <p>
        You have successfully logged in to the
        Department of Computer Applications website.
    </p>

    <div class="cards">

        <div class="card">
            <h2>Courses</h2>
            <p>View your registered student information.</p>
            <a href="courses.php" class="card-button">View Courses</a>
        </div>

        <div class="card">
            <h2>Department</h2>
            <p>Explore information about the department.</p>
        </div>

        <div class="card">
            <h2>Academic</h2>
            <p>Access department-related academic information.</p>
        </div>

    </div>

</div>

<footer>
    © 2026 Department of Computer Applications
</footer>

</body>
</html>