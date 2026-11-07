<?php
require "auth.php";
require_role("admin");
$id = (int)($_GET["id"] ?? $_POST["id"] ?? 0);

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'employee'");
$stmt->bind_param("i", $id); $stmt->execute();
$emp = $stmt->get_result()->fetch_assoc();
if (!$emp) die("Employee not found.");

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    check_csrf();
    $name = trim($_POST["name"]); $email = trim($_POST["email"]); $dept = trim($_POST["department"]);

    $c = $conn->prepare("SELECT id FROM users WHERE email = ? AND id <> ?");
    $c->bind_param("si", $email, $id); $c->execute();
    if ($c->get_result()->num_rows > 0) {
        $message = "That email belongs to another user.";
    } else {
        $s = $conn->prepare("UPDATE users SET name=?, email=?, department=? WHERE id=? AND role='employee'");
        $s->bind_param("sssi", $name, $email, $dept, $id); $s->execute();
        flash("Employee updated.");
        header("Location: dashboard.php"); exit();
    }
    $emp["name"] = $name; $emp["email"] = $email; $emp["department"] = $dept;
}
$title = "Edit employee";
include "header.php";
?>
<div class="container">
    <h1>Edit employee</h1>
    <div class="form-box">
        <?php if ($message) { ?><p class="error"><?php echo e($message); ?></p><?php } ?>
        <form method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label>Full name</label><input type="text" name="name" value="<?php echo e($emp["name"]); ?>" required>
            <label>Email</label><input type="email" name="email" value="<?php echo e($emp["email"]); ?>" required>
            <label>Department</label><input type="text" name="department" value="<?php echo e($emp["department"]); ?>" required>
            <button type="submit">Save changes</button>
        </form>
        <p><a href="dashboard.php">Back to dashboard</a></p>
    </div>
</div>
<?php include "footer.php"; ?>
