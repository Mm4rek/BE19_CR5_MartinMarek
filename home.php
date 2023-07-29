<?php
session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
    exit();
}

require_once "db_connect.php";

$sqlUser = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
$resultUser = mysqli_query($connect, $sqlUser);
$rowUser = mysqli_fetch_assoc($resultUser);

$sqlAnimals = "SELECT * FROM animals WHERE adoption_status = 'Available'";
$resultAnimals = mysqli_query($connect, $sqlAnimals);

$layout = "";

if (mysqli_num_rows($resultAnimals) > 0) {
    while ($rowAnimal = mysqli_fetch_assoc($resultAnimals)) {
        $animalCard = "<div class='col-md-4 mb-4'>";
        $animalCard .= "  <div class='card'>";
        $animalCard .= "    <img src='{$rowAnimal["photo"]}' class='card-img-top' alt='Animal Photo'>";
        $animalCard .= "    <div class='card-body'>";
        $animalCard .= "      <h5 class='card-title'>{$rowAnimal["name"]}</h5>";
        $animalCard .= "      <p class='card-text'>Location: {$rowAnimal["location"]}</p>";
        $animalCard .= "      <a href='details.php?id={$rowAnimal["id"]}' class='btn btn-primary'>Show Details</a>";
        $animalCard .= "    <a href='adopt.php?animal_id={$rowAnimal['id']}' class='btn btn-success'>Take me home</a>";
        $animalCard .= "    </div>";
        $animalCard .= "  </div>";
        $animalCard .= "</div>";

        $layout .= $animalCard;
    }
} else {
    $layout .= "<div class='col-md-12'>";
    $layout .= "  <p>No animals available for adoption.</p>";
    $layout .= "</div>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?= $rowUser["first_name"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<h2 class="text-center">Welcome <?= $rowUser["first_name"] . " " . $rowUser["last_name"] ?></h2>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="pictures/<?= $rowUser["picture"] ?>" alt="user pic" width="30" height="24">
        </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="senior.php">Senior</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="update.php?id=<?= $rowUser["id"] ?>">Edit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php?logout">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="container mt-5">
        <h2>Animals Available for Adoption</h2>
        <div class="row">
            <?= $layout ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
