<?php
require_once "../db_connect.php";

session_start();

if (isset($_SESSION["user"])) {
    header("Location: ../home.php");
    exit();
}

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../login.php");
    exit();
}

function displayAnimals($result) {
    $layout = "";

    if (mysqli_num_rows($result) > 0) {
        while ($rowAnimal = mysqli_fetch_assoc($result)) {
            $animalCard = "<div class='col-md-4 mb-4'>";
            $animalCard .= "  <div class='card'>";
            $animalCard .= "    <img src='{$rowAnimal["photo"]}' class='card-img-top' alt='Animal Photo'>";
            $animalCard .= "    <div class='card-body'>";
            $animalCard .= "      <h5 class='card-title'>{$rowAnimal["name"]}</h5>";
            $animalCard .= "      <p class='card-text'>Location: {$rowAnimal["location"]}</p>";
            $animalCard .= "      <p class='card-text'>Description: {$rowAnimal["description"]}</p>";
            $animalCard .= "      <p class='card-text'>Size: {$rowAnimal["size"]}</p>";
            $animalCard .= "      <p class='card-text'>Age: {$rowAnimal["age"]}</p>";
            $animalCard .= "      <p class='card-text'>Vaccinated: " . ($rowAnimal["vaccinated"] ? 'Yes' : 'No') . "</p>";
            $animalCard .= "      <p class='card-text'>Breed: {$rowAnimal["breed"]}</p>";
            $animalCard .= "      <p class='card-text'>Status: {$rowAnimal["adoption_status"]}</p>";
            $animalCard .= "      <a href='update.php?id={$rowAnimal["id"]}' class='btn btn-primary'>Update</a>";
            $animalCard .= "      <a href='delete.php?id={$rowAnimal["id"]}' class='btn btn-success'>Delete</a>";
            $animalCard .= "    </div>";
            $animalCard .= "  </div>";
            $animalCard .= "</div>";

            $layout .= $animalCard;
        }
    } else {
        $layout .= "<div class='col-md-12'>";
        $layout .= "  <p>No animals available.</p>";
        $layout .= "</div>";
    }

    return $layout;
}

$sqlAvailableAnimals = "SELECT * FROM animals WHERE adoption_status = 'Available'";
$resultAvailableAnimals = mysqli_query($connect, $sqlAvailableAnimals);

$sqlAdoptedAnimals = "SELECT * FROM animals WHERE adoption_status = 'Adopted'";
$resultAdoptedAnimals = mysqli_query($connect, $sqlAdoptedAnimals);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create.php">Create Animal for Adoption</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="senior.php">Senior</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2>Available Animals</h2>
    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-xs-1">
        <?= displayAnimals($resultAvailableAnimals) ?>
    </div>
</div>

<div class="container mt-5">
    <h2>Adopted Animals</h2>
    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-xs-1">
        <?= displayAnimals($resultAdoptedAnimals) ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
