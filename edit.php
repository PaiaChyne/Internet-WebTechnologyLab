<?php

include "db.php";

if (!isset($_GET["id"])) {
    die("Employee ID not provided.");
}

$id = $_GET["id"];

$sql = "SELECT * FROM employees WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$employee = mysqli_fetch_assoc($result);

if (!$employee) {
    die("Employee not found.");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Employee</title>

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
        }

        .page {
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 40px 20px;
        }

        .form-card {
            width: 100%;
            max-width: 700px;

            background: white;

            padding: 35px 40px;

            border: 1px solid #e1e4e8;

            border-radius: 10px;

            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;

            font-size: 26px;

            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;

            color: #777;

            font-size: 14px;

            margin-bottom: 30px;
        }

        .section {
            margin-bottom: 25px;
        }

        .section h2 {
            font-size: 17px;

            padding-bottom: 10px;

            margin-bottom: 20px;

            border-bottom: 1px solid #e5e5e5;
        }

        .form-row {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;

            font-size: 14px;

            font-weight: 600;

            margin-bottom: 7px;

            color: #444;
        }

        input,
        select {

            width: 100%;

            height: 42px;

            padding: 0 12px;

            border: 1px solid #d2d6da;

            border-radius: 6px;

            font-size: 14px;

            outline: none;
        }

        input:focus,
        select:focus {
            border-color: #4a73e8;

            box-shadow:
                0 0 0 3px rgba(74,115,232,0.10);
        }

        .update-btn {

            width: 100%;

            height: 44px;

            border: none;

            border-radius: 6px;

            background: #4a73e8;

            color: white;

            font-size: 14px;

            font-weight: 600;

            cursor: pointer;
        }

        .update-btn:hover {
            background: #3d61c7;
        }

        .back-btn {

            display: block;

            width: 100%;

            height: 44px;

            line-height: 44px;

            margin-top: 10px;

            text-align: center;

            text-decoration: none;

            background: #f1f3f5;

            color: #444;

            border-radius: 6px;

            font-size: 14px;

            font-weight: 600;
        }

        .back-btn:hover {
            background: #e3e6e9;
        }

        @media (max-width: 650px) {

            .form-card {
                padding: 25px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

        }

    </style>

</head>

<body>

<div class="page">

    <div class="form-card">

        <h1>Edit Employee</h1>

        <p class="subtitle">
            Update employee information
        </p>


        <form action="update.php" method="POST">

            <!-- Hidden ID -->

            <input
                type="hidden"
                name="id"
                value="<?php echo $employee['id']; ?>"
            >


            <!-- Personal Information -->

            <div class="section">

                <h2>Personal Information</h2>

                <div class="form-group">

                    <label>Employee Name</label>

                    <input
                        type="text"
                        name="name"
                        value="<?php echo htmlspecialchars($employee['name']); ?>"
                        required
                    >

                </div>


                <div class="form-row">

                    <div class="form-group">

                        <label>Email Address</label>

                        <input
                            type="email"
                            name="email"
                            value="<?php echo htmlspecialchars($employee['email']); ?>"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>Phone Number</label>

                        <input
                            type="text"
                            name="phone"
                            value="<?php echo htmlspecialchars($employee['phone']); ?>"
                            required
                        >

                    </div>

                </div>

            </div>


            <!-- Employment Information -->

            <div class="section">

                <h2>Employment Information</h2>


                <div class="form-row">

                    <div class="form-group">

                        <label>Department</label>

                        <select name="department" required>

                            <option value="IT"
                                <?php if ($employee['department'] == 'IT') echo 'selected'; ?>>
                                IT
                            </option>

                            <option value="HR"
                                <?php if ($employee['department'] == 'HR') echo 'selected'; ?>>
                                Human Resources
                            </option>

                            <option value="Finance"
                                <?php if ($employee['department'] == 'Finance') echo 'selected'; ?>>
                                Finance
                            </option>

                            <option value="Marketing"
                                <?php if ($employee['department'] == 'Marketing') echo 'selected'; ?>>
                                Marketing
                            </option>

                            <option value="Sales"
                                <?php if ($employee['department'] == 'Sales') echo 'selected'; ?>>
                                Sales
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label>Designation</label>

                        <input
                            type="text"
                            name="designation"
                            value="<?php echo htmlspecialchars($employee['designation']); ?>"
                            required
                        >

                    </div>

                </div>


                <div class="form-row">

                    <div class="form-group">

                        <label>Salary</label>

                        <input
                            type="number"
                            name="salary"
                            value="<?php echo htmlspecialchars($employee['salary']); ?>"
                            step="0.01"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>Joining Date</label>

                        <input
                            type="date"
                            name="joining_date"
                            value="<?php echo htmlspecialchars($employee['joining_date']); ?>"
                            required
                        >

                    </div>

                </div>

            </div>


            <button
                type="submit"
                class="update-btn"
            >
                Update Employee
            </button>


            <a
                href="view.php"
                class="back-btn"
            >
                Cancel
            </a>

        </form>

    </div>

</div>

</body>

</html>

<?php

mysqli_close($conn);

?>