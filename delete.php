<?php

include "db.php";


if (!isset($_GET["id"])) {

    die("Employee ID not provided.");

}


$id = $_GET["id"];


$sql = "DELETE FROM employees WHERE id = ?";


$stmt = mysqli_prepare($conn, $sql);


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);


if (mysqli_stmt_execute($stmt)) {

    echo "
    <script>

        alert('Employee deleted successfully!');

        window.location.href = 'view.php';

    </script>
    ";

} else {

    echo "Error deleting employee: " . mysqli_error($conn);

}


mysqli_stmt_close($stmt);

mysqli_close($conn);

?>