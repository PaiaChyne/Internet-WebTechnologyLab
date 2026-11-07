<?php
require "auth.php";
require_role("admin");
if ($_SERVER["REQUEST_METHOD"] !== "POST") { header("Location: dashboard.php"); exit(); }
check_csrf();

$id = (int)$_POST["id"];
$action = $_POST["action"] === "reject" ? "reject" : "approve";

if ($action === "approve") {
    $stmt = $conn->prepare("UPDATE users SET status='approved' WHERE id=? AND role='employee'");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    flash("Employee approved.");
} else {
    // Reject = remove the pending account so they can register again
    $stmt = $conn->prepare("DELETE FROM users WHERE id=? AND role='employee' AND status='pending'");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    flash("Employee registration rejected.");
}

header("Location: dashboard.php");
exit();
