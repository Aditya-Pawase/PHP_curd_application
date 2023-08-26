<?php
include'database_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "UPDATE fast SET name=?, description=?, price=? WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssdi", $name, $description, $price, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: view.php");
    } else {
        echo "Error updating record: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM fast WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Application - Update Item</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Item</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
            <textarea name="description"><?php echo $row['description']; ?></textarea>
            <input type="number" name="price" value="<?php echo $row['price']; ?>" step="0.01" required>
            <button type="submit">Update Item</button>
        </form>
    </div>
</body>
</html>
