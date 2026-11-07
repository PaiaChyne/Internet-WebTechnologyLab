<?php
require "auth.php";
if (isset($_SESSION["id"])) { header("Location: dashboard.php"); exit(); }

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $_POST["email"]);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($_POST["password"], $user["password"])) {

        if ($user["status"] !== "approved") {
            $message = "Your account is waiting for admin approval. Please try again later.";
        } else {
            session_regenerate_id(true);
            $_SESSION["id"] = $user["id"];
            $_SESSION["name"] = $user["name"];
            $_SESSION["role"] = $user["role"];
            header("Location: dashboard.php");
            exit();
        }
    } else {
        $message = "Incorrect email or password.";
    }
}
$title = "Login";
include "header.php";
?>
<div class="container">
    <h1>Welcome back</h1>
    <div class="form-box">
        <?php if ($message) { ?><p class="error"><?php echo e($message); ?></p><?php } ?>
        <form method="POST">
            <label>Email</label>
            <input type="email" name="email" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Log in</button>
        </form>
        <p>No account yet? <a href="register.php">Register</a></p>
    </div>
</div>
<?php include "footer.php"; ?>
