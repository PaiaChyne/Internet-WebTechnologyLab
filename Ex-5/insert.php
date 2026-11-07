<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $department = $_POST["department"];
    $designation = $_POST["designation"];
    $salary = $_POST["salary"];
    $joining_date = $_POST["joining_date"];

    $sql = "INSERT INTO employees 
            (name, email, phone, department, designation, salary, joining_date)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssssss",
        $name,
        $email,
        $phone,
        $department,
        $designation,
        $salary,
        $joining_date
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "
        <script>
            alert('Employee added successfully!');
            window.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);

?>