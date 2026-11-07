<?php
include "auth.php";
require_login();

$uid = (int)$_SESSION["user_id"];
$stmt = $conn->prepare("SELECT * FROM contacts WHERE user_id = ? ORDER BY name");
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();

$msgs = ["added" => "Contact added.", "updated" => "Contact updated.", "deleted" => "Contact deleted."];
$msg = $msgs[$_GET["msg"] ?? ""] ?? "";

$title = "My contacts";
include "header.php";
?>

<h1>My contacts <small><?php echo $result->num_rows; ?> saved</small></h1>

<?php if ($msg) { ?><p class="message"><?php echo $msg; ?></p><?php } ?>

<div class="toolbar">
    <input type="search" id="search" placeholder="Search by name, phone or email">
</div>

<table class="searchable">
    <thead>
        <tr><th>Name</th><th>Phone</th><th>Email</th><th>Address</th><th>Actions</th></tr>
    </thead>
    <tbody>
    <?php if ($result->num_rows == 0) { ?>
        <tr><td colspan="5" class="empty">No contacts yet. Click "+ New contact" to add one.</td></tr>
    <?php } while ($c = $result->fetch_assoc()) { ?>
        <tr>
            <td>
                <span class="avatar"><?php echo e(strtoupper(mb_substr($c["name"], 0, 1))); ?></span>
                <?php echo e($c["name"]); ?>
            </td>
            <td><?php echo e($c["phone"]); ?></td>
            <td><?php echo e($c["email"]); ?></td>
            <td><?php echo e($c["address"]); ?></td>
            <td class="actions">
                <a class="btn-sm" href="contact_form.php?id=<?php echo (int)$c["id"]; ?>">Edit</a>
                <form method="POST" action="delete.php" data-confirm="Delete this contact?">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo (int)$c["id"]; ?>">
                    <button class="btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php include "footer.php"; ?>
