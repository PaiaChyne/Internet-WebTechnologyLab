<?php
require "auth.php";
require_role("admin");
if ($_SERVER["REQUEST_METHOD"] !== "POST") { header("Location: dashboard.php"); exit(); }
check_csrf();

$id = (int)$_POST["id"];
$stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role = 'employee'");
$stmt->bind_param("i", $id);
$stmt->execute();
flash("Employee deleted.");
header("Location: dashboard.php");
exit();
