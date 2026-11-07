<?php
require "auth.php";
$message = ""; $ok = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $department = trim($_POST["department"]);
    $password = $_POST["password"];
    $role = $_POST["role"] === "admin" ? "admin" : "employee";

    if (strlen($password) < 6) {
        $message = "Password must be at least 6 characters.";
    } elseif ($role === "admin" && ($_POST["admin_code"] ?? "") !== ADMIN_CODE) {
        $message = "Invalid admin code.";
    } else {
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        if ($check->get_result()->num_rows > 0) {
            $message = "That email is already registered.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $status = $role === "admin" ? "approved" : "pending"; // employees wait for admin approval
            $stmt = $conn->prepare("INSERT INTO users (name,email,department,password,role,status) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $name, $email, $department, $hash, $role, $status);
            $ok = $stmt->execute();
            $message = $ok
                ? ($status === "pending"
                    ? "Account created. An admin must approve it before you can log in."
                    : "Account created. You can now log in.")
                : "Registration failed.";
        }
    }
}
$title = "Registration";
include "header.php";
?>
<div class="container">
    <h1>Create your account</h1>
    <div class="form-box">
        <?php if ($message) { ?><p class="<?php echo $ok ? "message" : "error"; ?>"><?php echo e($message); ?></p><?php } ?>
        <form method="POST">
            <label>Full name</label>
            <input type="text" name="name" required>
            <label>Email</label>
            <input type="email" name="email" required>
            <label>Department</label>
            <input type="text" name="department" required>
            <label>Password</label>
            <input type="password" name="password" minlength="6" required>
            <label>Role</label>
            <select name="role" id="role" required>
                <option value="employee">Employee</option>
                <option value="admin">Admin</option>
            </select>
            <div id="code-box" style="display:none">
                <label>Admin code</label>
                <input type="password" name="admin_code">
            </div>
            <button type="submit">Register</button>
        </form>
        <p>Already registered? <a href="login.php">Log in</a></p>
    </div>
</div>
<?php include "footer.php"; ?>
