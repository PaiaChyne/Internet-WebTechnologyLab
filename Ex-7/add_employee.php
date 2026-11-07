<?php
require "auth.php";
require_role("admin");
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    check_csrf();
    $name = trim($_POST["name"]); $email = trim($_POST["email"]); $dept = trim($_POST["department"]);
    if (strlen($_POST["password"]) < 6) {
        $message = "Password must be at least 6 characters.";
    } else {
        $c = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $c->bind_param("s", $email); $c->execute();
        if ($c->get_result()->num_rows > 0) {
            $message = "That email is already registered.";
        } else {
            $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $s = $conn->prepare("INSERT INTO users (name,email,department,password,role,status) VALUES (?,?,?,?,'employee','approved')");
            $s->bind_param("ssss", $name, $email, $dept, $hash);
            $s->execute();
            flash("Employee added.");
            header("Location: dashboard.php"); exit();
        }
    }
}
$title = "Add employee";
include "header.php";
?>
<div class="container">
    <h1>Add employee</h1>
    <div class="form-box">
        <?php if ($message) { ?><p class="error"><?php echo e($message); ?></p><?php } ?>
        <form method="POST">
            <?php echo csrf_field(); ?>
            <label>Full name</label><input type="text" name="name" required>
            <label>Email</label><input type="email" name="email" required>
            <label>Department</label><input type="text" name="department" required>
            <label>Temporary password</label><input type="password" name="password" minlength="6" required>
            <button type="submit">Add employee</button>
        </form>
        <p><a href="dashboard.php">Back to dashboard</a></p>
    </div>
</div>
<?php include "footer.php"; ?>
