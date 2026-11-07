<?php
require "auth.php";
require_login();

$isAdmin = $_SESSION["role"] === "admin";
$show = $isAdmin ? "employee" : "admin";   // admin sees employees, employee sees admins

$stats = $conn->query(
    "SELECT SUM(role='employee') AS emp, SUM(role='admin') AS adm,
            COUNT(DISTINCT department) AS dept FROM users"
)->fetch_assoc();

$stmt = $conn->prepare("SELECT id,name,email,department FROM users WHERE role = ? AND status = 'approved' ORDER BY name");
$stmt->bind_param("s", $show);
$stmt->execute();
$rows = $stmt->get_result();

/* Employees awaiting approval (admin only) */
$pending = null;
if ($isAdmin) {
    $pending = $conn->query("SELECT id,name,email,department FROM users WHERE role='employee' AND status='pending' ORDER BY name");
}

$title = "Dashboard";
include "header.php";
?>
<div class="container">
    <h1>Hello, <?php echo e($_SESSION["name"]); ?> <strong><?php echo strtoupper($_SESSION["role"]); ?></strong></h1>

    <?php if (!empty($_SESSION["flash"])) { ?>
        <p class="message"><?php echo e($_SESSION["flash"]); unset($_SESSION["flash"]); ?></p>
    <?php } ?>

    <div class="stats">
        <div class="stat"><span><?php echo (int)$stats["emp"]; ?></span>Employees</div>
        <div class="stat"><span><?php echo (int)$stats["adm"]; ?></span>Admins</div>
        <div class="stat"><span><?php echo (int)$stats["dept"]; ?></span>Departments</div>
    </div>

    <?php if ($isAdmin && $pending->num_rows > 0) { ?>
    <h2>Pending Approvals <span class="badge"><?php echo $pending->num_rows; ?></span></h2>
    <table class="searchable">
        <thead><tr><th>Name</th><th>Email</th><th>Department</th><th>Action</th></tr></thead>
        <tbody>
        <?php while ($p = $pending->fetch_assoc()) { ?>
            <tr>
                <td><?php echo e($p["name"]); ?></td>
                <td><?php echo e($p["email"]); ?></td>
                <td><?php echo e($p["department"]); ?></td>
                <td class="actions">
                    <form method="POST" action="approve_user.php">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo (int)$p["id"]; ?>">
                        <input type="hidden" name="action" value="approve">
                        <button class="btn-sm" type="submit">Approve</button>
                    </form>
                    <form method="POST" action="approve_user.php" data-confirm="Reject this registration?">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo (int)$p["id"]; ?>">
                        <input type="hidden" name="action" value="reject">
                        <button class="btn-sm btn-danger" type="submit">Reject</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <hr>
    <?php } ?>

    <h2><?php echo $isAdmin ? "Employee details" : "Admin details"; ?></h2>

    <div class="toolbar">
        <input type="search" id="search" placeholder="Search by name, email or department">
        <?php if ($isAdmin) { ?><a class="button" href="add_employee.php">+ Add employee</a><?php } ?>
    </div>

    <table class="searchable">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Department</th><?php if ($isAdmin) echo "<th>Actions</th>"; ?></tr>
        </thead>
        <tbody>
        <?php if ($rows->num_rows == 0) { ?>
            <tr><td colspan="5" class="empty">No <?php echo $show; ?>s yet.</td></tr>
        <?php } while ($r = $rows->fetch_assoc()) { ?>
            <tr>
                <td><?php echo (int)$r["id"]; ?></td>
                <td><?php echo e($r["name"]); ?></td>
                <td><?php echo e($r["email"]); ?></td>
                <td><?php echo e($r["department"]); ?></td>
                <?php if ($isAdmin) { ?>
                <td class="actions">
                    <a class="btn-sm" href="edit_employee.php?id=<?php echo (int)$r["id"]; ?>">Edit</a>
                    <form method="POST" action="delete_employee.php" data-confirm="Delete this employee?">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo (int)$r["id"]; ?>">
                        <button class="btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </td>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php include "footer.php"; ?>
