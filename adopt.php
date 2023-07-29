<?php
require_once "db_connect.php";

session_start();

if (!isset($_SESSION["user"])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET["animal_id"])) {
    $animal_id = $_GET["animal_id"];

    // Fetch animal details from the database
    $sqlAnimal = "SELECT * FROM animals WHERE id = $animal_id";
    $resultAnimal = mysqli_query($connect, $sqlAnimal);
    $rowAnimal = mysqli_fetch_assoc($resultAnimal);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $user_id = $_SESSION["user"];
        $adoption_date = $_POST["adoption_date"];

        // Insert the adoption record into the database
        $sqlInsert = "INSERT INTO pet_adoption (user_id, pet_id, adoption_date) VALUES ($user_id, $animal_id, '$adoption_date')";
        if (mysqli_query($connect, $sqlInsert)) {
            $notice = "Adoption successful!";
        } else {
            $notice = "Error: " . mysqli_error($connect);
        }
    }
} else {
    header("Location: senior.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Adoption Form</h2>
        <?php if (isset($notice)) : ?>
            <div class="alert alert-success"><?= $notice ?></div>
            <a href="../home.php" class="btn btn-secondary">Back to Home</a>
        <?php else : ?>
            <form method="POST">
                <input type="hidden" name="pet_id" value="<?= $animal_id ?>">
                <div class="mb-3">
                    <label for="animal_name" class="form-label">Animal Name</label>
                    <input type="text" class="form-control" id="animal_name" name="animal_name" value="<?= $rowAnimal['name'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="adoption_date" class="form-label">Adoption Date</label>
                    <input type="date" class="form-control" id="adoption_date" name="adoption_date" required>
                </div>
                <button type="submit" class="btn btn-primary">Take me home</button>
                <a href="senior.php" class="btn btn-secondary">Cancel</a>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
