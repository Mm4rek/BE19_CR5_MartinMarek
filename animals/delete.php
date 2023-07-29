<?php
require_once "../db_connect.php";

if (isset($_GET["id"])) {
    $animal_id = $_GET["id"];

    // Fetch animal details from the database
    $sqlAnimal = "SELECT * FROM animals WHERE id = $animal_id";
    $resultAnimal = mysqli_query($connect, $sqlAnimal);
    $rowAnimal = mysqli_fetch_assoc($resultAnimal);

    // Handle form submission for deleting the animal
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Check if the animal's photo exists
        if (file_exists($rowAnimal['photo'])) {
            // Delete the animal's photo from the "pictures" folder
            unlink($rowAnimal['photo']);
        }

        $sqlDelete = "DELETE FROM animals WHERE id = $animal_id";

        if (mysqli_query($connect, $sqlDelete)) {
            header("Location: index.php");
            exit();
        } else {
            $message = "Error deleting animal: " . mysqli_error($connect);
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Animal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Delete Animal</h2>
    <?php if (isset($message)) : ?>
        <div class="alert alert-danger"><?= $message ?></div>
    <?php endif; ?>
    <p>Are you sure you want to delete the animal: <strong><?= $rowAnimal['name'] ?></strong>?</p>
    <form method="POST">
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
