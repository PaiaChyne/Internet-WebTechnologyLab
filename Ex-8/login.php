<?php
include "auth.php";
if (isset($_SESSION["user_id"])) { header("Location: index.php"); exit(); }

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $_POST["email"]);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($_POST["password"], $user["password"])) {
        session_regenerate_id(true);
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];
        header("Location: index.php");
        exit();
    }
    $error = "Incorrect email or password.";
}
$title = "Login";
include "header.php";
?>
<h1 class="center">Welcome back</h1>
<div class="form-box">
    <?php if ($error) { ?><p class="error"><?php echo e($error); ?></p><?php } ?>
    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Log in</button>
    </form>
    <p>New here? <a href="register.php">Create an account</a></p>
</div>
<?php include "footer.php"; ?>
