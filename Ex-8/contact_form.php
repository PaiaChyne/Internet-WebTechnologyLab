<?php
include "auth.php";
require_login();

$uid = (int)$_SESSION["user_id"];
$id = (int)($_GET["id"] ?? $_POST["id"] ?? 0);
$contact = ["name" => "", "phone" => "", "email" => "", "address" => ""];
$error = "";

/* Edit mode: only load a contact that belongs to this user */
if ($id) {
    $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $uid);
    $stmt->execute();
    $contact = $stmt->get_result()->fetch_assoc();
    if (!$contact) die("Contact not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    check_csrf();
    $name    = trim($_POST["name"]);
    $phone   = trim($_POST["phone"]);
    $email   = trim($_POST["email"]);
    $address = trim($_POST["address"]);
    $contact = compact("name", "phone", "email", "address");

    if (!preg_match('/^[0-9+\- ]{7,20}$/', $phone)) {
        $error = "Enter a valid phone number (digits, +, - and spaces only).";
    } else {
        if ($id) {
            $stmt = $conn->prepare("UPDATE contacts SET name=?, phone=?, email=?, address=? WHERE id=? AND user_id=?");
            $stmt->bind_param("ssssii", $name, $phone, $email, $address, $id, $uid);
            $msg = "updated";
        } else {
            $stmt = $conn->prepare("INSERT INTO contacts (user_id, name, phone, email, address) VALUES (?,?,?,?,?)");
            $stmt->bind_param("issss", $uid, $name, $phone, $email, $address);
            $msg = "added";
        }
        $stmt->execute();
        header("Location: index.php?msg=$msg");
        exit();
    }
}

$title = $id ? "Edit contact" : "Add contact";
include "header.php";
?>

<h1 class="center"><?php echo $title; ?></h1>

<div class="form-box">
    <?php if ($error) { ?><p class="error"><?php echo e($error); ?></p><?php } ?>
    <form method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label>Full name</label>
        <input type="text" name="name" value="<?php echo e($contact["name"]); ?>" required>

        <label>Phone</label>
        <input type="tel" name="phone" value="<?php echo e($contact["phone"]); ?>" required>

        <label>Email (optional)</label>
        <input type="email" name="email" value="<?php echo e($contact["email"]); ?>">

        <label>Address (optional)</label>
        <input type="text" name="address" value="<?php echo e($contact["address"]); ?>">

        <button type="submit"><?php echo $id ? "Save changes" : "Add contact"; ?></button>
    </form>
    <p><a href="index.php">Back to contacts</a></p>
</div>

<?php include "footer.php"; ?>
