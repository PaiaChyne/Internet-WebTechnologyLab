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
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 30px;
            background: #f4f6f9;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        .table-container {
            overflow-x: auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #667eea;
            color: white;
            padding: 13px;
        }

        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background: #f5f5f5;
        }

        .back {
            display: block;
            width: 200px;
            text-align: center;
            margin: 25px auto;
            padding: 12px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }

    </style>

</head>

<body>

<h1>Employee Records</h1>

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
    </tr>

    <?php

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

    ?>

    <tr>

        <td><?php echo $row["id"]; ?></td>

        <td><?php echo htmlspecialchars($row["name"]); ?></td>

        <td><?php echo htmlspecialchars($row["email"]); ?></td>

        <td><?php echo htmlspecialchars($row["phone"]); ?></td>

        <td><?php echo htmlspecialchars($row["department"]); ?></td>

        <td><?php echo htmlspecialchars($row["designation"]); ?></td>

        <td>₹<?php echo htmlspecialchars($row["salary"]); ?></td>

        <td><?php echo htmlspecialchars($row["joining_date"]); ?></td>

    </tr>

    <?php

        }

    } else {

        echo "<tr><td colspan='8'>No employee records found.</td></tr>";

    }

    ?>

</table>

</div>

<a href="index.php" class="back">Add New Employee</a>

</body>
</html>

<?php

mysqli_close($conn);

?>