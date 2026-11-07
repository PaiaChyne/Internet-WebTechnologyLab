<?php
include "auth.php";
require_login();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    check_csrf();
    $id = (int)$_POST["id"];
    $uid = (int)$_SESSION["user_id"];
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $uid);
    $stmt->execute();
}

header("Location: index.php?msg=deleted");
exit();
