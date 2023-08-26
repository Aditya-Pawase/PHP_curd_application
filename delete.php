<?php
include'database_connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM fast WHERE id=?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: view.php");
} else {
    echo "Error deleting record: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
