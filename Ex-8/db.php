<?php
$conn = new mysqli("localhost", "root", "", "contact_db");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

function e($s) { return htmlspecialchars($s ?? "", ENT_QUOTES, "UTF-8"); }
