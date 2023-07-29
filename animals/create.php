<?php
require_once "../db_connect.php";

session_start();

if (isset($_SESSION["user"])) {
    header("Location: ../home.php");
}

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../login.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle form submission for creating a new animal
    $name = $_POST["name"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $size = $_POST["size"];
    $age = $_POST["age"];
    $vaccinated = isset($_POST["vaccinated"]) ? 1 : 0;
    $breed = $_POST["breed"];
    $adoption_status = $_POST["adoption_status"];

    // Handle photo upload
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] === UPLOAD_ERR_OK) {
        $targetDir = "../pictures/"; // The folder path relative to the current file
        $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $extensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $extensions)) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
                $photo = $targetFile;

                // Insert the animal details into the database
                $sqlInsert = "INSERT INTO animals (name, photo, location, description, size, age, vaccinated, breed, adoption_status) VALUES ('$name', '$photo', '$location', '$description', '$size', '$age', $vaccinated, '$breed', '$adoption_status')";

                if (mysqli_query($connect, $sqlInsert)) {
                    header("Location: index.php");
                    exit();
                } else {
                    $message = "Error creating animal: " . mysqli_error($connect);
                }
            } else {
                $message = "Error uploading photo.";
            }
        } else {
            $message = "Invalid file format. Allowed extensions: jpg, jpeg, png, gif.";
        }
    } else {
        $message = "Error uploading photo.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Animal for Adoption</title>
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
                        <a class="nav-link" href="index.php">Animals for Adoption</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="senior.php">Senior</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Create Animal for Adoption</h2>
        <?php if (isset($message)) : ?>
            <div class="alert alert-danger"><?= $message ?></div>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="size" class="form-label">Size</label>
                <input type="text" class="form-control" id="size" name="size">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="vaccinated" name="vaccinated">
                <label class="form-check-label" for="vaccinated">Vaccinated</label>
            </div>
            <div class="mb-3">
                <label for="breed" class="form-label">Breed</label>
                <input type="text" class="form-control" id="breed" name="breed">
            </div>
            <div class="mb-3">
                <label for="adoption_status" class="form-label">Adoption Status</label>
                <select class="form-control" id="adoption_status" name="adoption_status">
                    <option value="Available">Available</option>
                    <option value="Pending">Pending</option>
                    <option value="Adopted">Adopted</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
