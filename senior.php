<?php
require_once "db_connect.php";

$sqlSeniorAnimals = "SELECT * FROM animals WHERE age > 8 AND adoption_status = 'Available'";
$resultSeniorAnimals = mysqli_query($connect, $sqlSeniorAnimals);

$layout = "";

if (mysqli_num_rows($resultSeniorAnimals) > 0) {
    while ($rowSeniorAnimal = mysqli_fetch_assoc($resultSeniorAnimals)) {
        $animalCard = "<div class='col-md-4 mb-4'>";
        $animalCard .= "  <div class='card'>";
        $animalCard .= "    <img src='{$rowSeniorAnimal["photo"]}' class='card-img-top' alt='Animal Photo'>";
        $animalCard .= "    <div class='card-body'>";
        $animalCard .= "      <h5 class='card-title'>{$rowSeniorAnimal["name"]}</h5>";
        $animalCard .= "      <p class='card-text'>Location: {$rowSeniorAnimal["location"]}</p>";
        $animalCard .= "      <p class='card-text'>Description: {$rowSeniorAnimal["description"]}</p>";
        $animalCard .= "      <p class='card-text'>Size: {$rowSeniorAnimal["size"]}</p>";
        $animalCard .= "      <p class='card-text'>Age: {$rowSeniorAnimal["age"]}</p>";
        $animalCard .= "      <p class='card-text'>Vaccinated: " . ($rowSeniorAnimal["vaccinated"] ? 'Yes' : 'No') . "</p>";
        $animalCard .= "      <p class='card-text'>Breed: {$rowSeniorAnimal["breed"]}</p>";
        $animalCard .= "      <p class='card-text'>Status: {$rowSeniorAnimal["adoption_status"]}</p>";
        $animalCard .= "      <a href='details.php?id={$rowSeniorAnimal["id"]}' class='btn btn-primary'>Show Details</a>";
        $animalCard .= "      <a href='adopt.php?animal_id={$rowSeniorAnimal["id"]}' class='btn btn-success'>Take me home</a>";
        $animalCard .= "    </div>";
        $animalCard .= "  </div>";
        $animalCard .= "</div>";

        $layout .= $animalCard;
    }
} else {
    $layout .= "<div class='col-md-12'>";
    $layout .= "  <p>No senior animals available for adoption.</p>";
    $layout .= "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Animals</title>
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-xs-1">
            <?= $layout ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
