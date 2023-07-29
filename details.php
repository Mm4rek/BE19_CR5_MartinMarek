<?php
require_once "db_connect.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($connect, "SELECT * FROM animals WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 0) {
        // No animal found with the provided ID, handle the error gracefully
        $errorMessage = "Animal not found.";
    } else {
        $row = mysqli_fetch_assoc($result);
    }
} else {
    // Handle the case when the "id" parameter is not provided
    $errorMessage = "Animal ID not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <?php if (isset($errorMessage)) : ?>
            <div class="alert alert-danger"><?= $errorMessage ?></div>
        <?php else : ?>
            <h2>Animal Details</h2>
            <div class="card">
                <img src="<?= $row["photo"] ?>" class="card-img-top" alt="Animal Photo">
                <div class="card-body">
                    <h5 class="card-title"><?= $row["name"] ?></h5>
                    <p class="card-text">Location: <?= $row["location"] ?></p>
                    <p class="card-text">Description: <?= $row["description"] ?></p>
                    <p class="card-text">Size: <?= $row["size"] ?></p>
                    <p class="card-text">Age: <?= $row["age"] ?></p>
                    <p class="card-text">Vaccinated: <?= ($row["vaccinated"] ? 'Yes' : 'No') ?></p>
                    <p class="card-text">Breed: <?= $row["breed"] ?></p>
                    <p class="card-text">Adoption Status: <?= $row["adoption_status"] ?></p>
                </div>
            </div>
        <?php endif; ?>
        <a href="home.php" class="btn btn-primary mt-3">Back to Home</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
