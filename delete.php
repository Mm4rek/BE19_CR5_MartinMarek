<?php
require_once "../db_connect.php";

if (isset($_GET["id"])) {
    $user_id = $_GET["id"];

    // Fetch user details from the database
    $sqlUser = "SELECT * FROM users WHERE id = $user_id";
    $resultUser = mysqli_query($connect, $sqlUser);
    $rowUser = mysqli_fetch_assoc($resultUser);

    // Handle form submission for deleting the user
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Check if the user's picture exists
        if (file_exists($rowUser['picture'])) {
            // Delete the user's picture from the "pictures" folder
            unlink($rowUser['picture']);
        }

        $sqlDelete = "DELETE FROM users WHERE id = $user_id";

        if (mysqli_query($connect, $sqlDelete)) {
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Error deleting user: " . mysqli_error($connect);
        }
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Delete User</h2>
    <?php if (isset($message)) : ?>
        <div class="alert alert-danger"><?= $message ?></div>
    <?php endif; ?>
    <p>Are you sure you want to delete the user: <strong><?= $rowUser['first_name'] ?></strong>?</p>
    <form method="POST">
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

