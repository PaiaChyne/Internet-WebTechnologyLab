<?php
include "auth.php";
if (isset($_SESSION["user_id"])) { header("Location: index.php"); exit(); }

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        $c = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $c->bind_param("s", $email);
        $c->execute();
        if ($c->get_result()->num_rows > 0) {
            $error = "That email is already registered.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $s = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?,?,?)");
            $s->bind_param("sss", $name, $email, $hash);
            $s->execute();

            session_regenerate_id(true);
            $_SESSION["user_id"] = $conn->insert_id;
            $_SESSION["user_name"] = $name;
            header("Location: index.php");
            exit();
        }
    }
}
$title = "Register";
include "header.php";
?>
<h1 class="center">Create your account</h1>
<div class="form-box">
    <?php if ($error) { ?><p class="error"><?php echo e($error); ?></p><?php } ?>
    <form method="POST">
        <label>Full name</label>
        <input type="text" name="name" required>
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Password</label>
        <input type="password" name="password" minlength="6" required>
        <button type="submit">Register</button>
    </form>
    <p>Already registered? <a href="login.php">Log in</a></p>
</div>
<?php include "footer.php"; ?>
