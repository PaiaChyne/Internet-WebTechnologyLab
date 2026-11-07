<?php
session_start();

if (!isset($_SESSION["name"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav>
    <a href="index.php">Home</a>
    <a href="dashboard.php">Dashboard</a>
    <a href="courses.php">Courses</a>
    <a href="about.php">About Us</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="container">

    <h1>Courses Offered</h1>

    <p>Here are the courses provided by the Department of Computer Applications:</p>

    <div class="cards">

        <div class="card">
            <h2>MCA</h2>
            <p>Master of Computer Applications</p>
        </div>

        <div class="card">
            <h2>Web Technology</h2>
            <p>HTML, CSS, JavaScript, PHP and Web Development</p>
        </div>

        <div class="card">
            <h2>Database Management</h2>
            <p>Database concepts, SQL and MySQL</p>
        </div>

        <div class="card">
            <h2>Artificial Intelligence</h2>
            <p>Introduction to AI and Machine Learning</p>
        </div>

        <div class="card">
            <h2>Computer Networks</h2>
            <p>Networking concepts and communication technologies</p>
        </div>

        <div class="card">
            <h2>Software Engineering</h2>
            <p>Software development methods and project management</p>
        </div>

    </div>

</div>

<footer>
    © 2026 Department of Computer Applications
</footer>

</body>
</html>