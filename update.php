<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $department = $_POST["department"];
    $designation = $_POST["designation"];
    $salary = $_POST["salary"];
    $joining_date = $_POST["joining_date"];


    $sql = "UPDATE employees SET
            name = ?,
            email = ?,
            phone = ?,
            department = ?,
            designation = ?,
            salary = ?,
            joining_date = ?
            WHERE id = ?";


    $stmt = mysqli_prepare($conn, $sql);


    mysqli_stmt_bind_param(
        $stmt,
        "sssssssi",
        $name,
        $email,
        $phone,
        $department,
        $designation,
        $salary,
        $joining_date,
        $id
    );


    if (mysqli_stmt_execute($stmt)) {

        echo "
        <script>

            alert('Employee updated successfully!');

            window.location.href = 'view.php';

        </script>
        ";

    } else {

        echo "Error updating employee: " . mysqli_error($conn);

    }


    mysqli_stmt_close($stmt);

}

mysqli_close($conn);

?>