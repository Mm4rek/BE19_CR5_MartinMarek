<?php
require_once "../db_connect.php";

session_start();

if (isset($_SESSION["user"])) {
    header("Location: ../home.php");
}

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../login.php");
}

// Retrieve the animal ID from the URL parameter
if (!isset($_GET["x"])) {
    echo "Animal ID is missing.";
    exit;
}

$id = $_GET["x"];
echo "ID: " . $_GET["x"];

// Add a check for valid numeric ID to prevent SQL injection
if (!is_numeric($id)) {
    echo "Invalid Animal ID.";
    exit;
}

$sql = "SELECT * FROM `animals` WHERE `id` = $id";
$result = mysqli_query($connect, $sql);
if (!$connect) {
    die("Database connection error: " . mysqli_connect_error());
}
if (!$result) {
    echo "Error fetching animal details: " . mysqli_error($connect);
    exit;
}

$row = mysqli_fetch_assoc($result);

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
        <a href="details.php?x=<?= $row["id"] ?>" class="btn btn-success">View Details</a>
        <a href="home.php" class="btn btn-primary mt-3">Back to Home</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
