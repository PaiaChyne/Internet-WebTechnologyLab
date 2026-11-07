<?php
require "auth.php";
require_login();
$id = (int)$_SESSION["id"];
$message = ""; $ok = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    check_csrf();
    $name = trim($_POST["name"]); $dept = trim($_POST["department"]);
    $s = $conn->prepare("UPDATE users SET name=?, department=? WHERE id=?");
    $s->bind_param("ssi", $name, $dept, $id); $s->execute();
    $_SESSION["name"] = $name;

    if ($_POST["password"] !== "") {
        if (strlen($_POST["password"]) < 6) { $message = "Password must be at least 6 characters."; }
        else {
            $h = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $p = $conn->prepare("UPDATE users SET password=? WHERE id=?");
            $p->bind_param("si", $h, $id); $p->execute();
        }
    }
    if (!$message) { $ok = true; $message = "Profile updated."; }
}
$stmt = $conn->prepare("SELECT name,email,department,role FROM users WHERE id = ?");
$stmt->bind_param("i", $id); $stmt->execute();
$me = $stmt->get_result()->fetch_assoc();

$title = "My profile";
include "header.php";
?>
<div class="container">
    <h1>My profile</h1>
    <div class="form-box">
        <?php if ($message) { ?><p class="<?php echo $ok ? "message" : "error"; ?>"><?php echo e($message); ?></p><?php } ?>
        <form method="POST">
            <?php echo csrf_field(); ?>
            <label>Full name</label><input type="text" name="name" value="<?php echo e($me["name"]); ?>" required>
            <label>Email</label><input type="email" value="<?php echo e($me["email"]); ?>" disabled>
            <label>Department</label><input type="text" name="department" value="<?php echo e($me["department"]); ?>" required>
            <label>New password (leave blank to keep)</label><input type="password" name="password">
            <button type="submit">Save profile</button>
        </form>
        <p><a href="dashboard.php">Back to dashboard</a></p>
    </div>
</div>
<?php include "footer.php"; ?>
