<?php

include "db.php";

$sql = "SELECT * FROM employees ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Records</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f6f8;
            color: #333;
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 8px;
            color: #222;
        }

        .subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
        }

        .table-container {
            background: white;
            padding: 25px;
            border: 1px solid #e1e4e8;
            border-radius: 10px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #4a73e8;
            color: white;
            padding: 13px 10px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 12px 10px;
            border-bottom: 1px solid #e5e5e5;
            font-size: 14px;
        }

        tr:hover {
            background: #f8f9fb;
        }

        .actions {
            white-space: nowrap;
        }

        .edit-btn,
        .delete-btn {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .edit-btn {
            background: #e8f0ff;
            color: #315ec7;
        }

        .edit-btn:hover {
            background: #d8e5ff;
        }

        .delete-btn {
            background: #ffe8e8;
            color: #d33;
            margin-left: 5px;
        }

        .delete-btn:hover {
            background: #ffd5d5;
        }

        .add-btn {
            display: block;
            width: 200px;
            margin: 25px auto 0;
            padding: 12px;
            text-align: center;
            background: #4a73e8;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
        }

        .add-btn:hover {
            background: #3d61c7;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Employee Records</h1>

    <p class="subtitle">
        Manage employee information
    </p>

    <div class="table-container">

        <table>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Salary</th>
                <th>Joining Date</th>
                <th>Actions</th>
            </tr>

            <?php

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {

            ?>

            <tr>

                <td>
                    <?php echo $row["id"]; ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["name"]); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["email"]); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["phone"]); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["department"]); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["designation"]); ?>
                </td>

                <td>
                    ₹<?php echo htmlspecialchars($row["salary"]); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["joining_date"]); ?>
                </td>

                <td class="actions">

                    <a
                        href="edit.php?id=<?php echo $row['id']; ?>"
                        class="edit-btn"
                    >
                        Edit
                    </a>

                    <a
                        href="delete.php?id=<?php echo $row['id']; ?>"
                        class="delete-btn"
                        onclick="return confirm('Are you sure you want to delete this employee?');"
                    >
                        Delete
                    </a>

                </td>

            </tr>

            <?php

                }

            } else {

                echo "
                <tr>
                    <td colspan='9' style='text-align:center;'>
                        No employee records found.
                    </td>
                </tr>";

            }

            ?>

        </table>

    </div>

    <a href="index.php" class="add-btn">
        + Add New Employee
    </a>

</div>

</body>

</html>

<?php

mysqli_close($conn);

?>