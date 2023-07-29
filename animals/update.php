<?php
require_once "../db_connect.php";

if (isset($_GET["id"])) {
    $animal_id = $_GET["id"];

    // Fetch animal details from the database
    $sqlAnimal = "SELECT * FROM animals WHERE id = $animal_id";
    $resultAnimal = mysqli_query($connect, $sqlAnimal);
    $rowAnimal = mysqli_fetch_assoc($resultAnimal);

    // Handle form submission for updating animal details
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST["name"];
        $location = $_POST["location"];
        $description = $_POST["description"];
        $size = $_POST["size"];
        $age = $_POST["age"];
        $vaccinated = isset($_POST["vaccinated"]) ? 1 : 0;
        $breed = $_POST["breed"];
        $adoption_status = $_POST["adoption_status"];

        // Handle photo update
        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] === UPLOAD_ERR_OK) {
            $targetDir = "../pictures/"; // The folder path relative to the current file
            $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $extensions = array("jpg", "jpeg", "png", "gif");

            if (in_array($imageFileType, $extensions)) {
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
                    $photo = $targetFile;
                } else {
                    $message = "Error uploading photo.";
                }
            } else {
                $message = "Invalid file format. Allowed extensions: jpg, jpeg, png, gif.";
            }
        } else {
            // If no new photo is uploaded, keep the existing photo
            $photo = $rowAnimal['photo'];
        }

        // Update the animal details in the database
        $sqlUpdate = "UPDATE animals SET name='$name', photo='$photo', location='$location', description='$description', size='$size', age='$age', vaccinated=$vaccinated, breed='$breed', adoption_status='$adoption_status' WHERE id = $animal_id";

        if (mysqli_query($connect, $sqlUpdate)) {
            header("Location: index.php");
            exit();
        } else {
            $message = "Error updating animal: " . mysqli_error($connect);
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
    <title>Update Animal Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Animal Details</h2>
        <?php if (isset($message)) : ?>
            <div class="alert alert-danger"><?= $message ?></div>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required value="<?= $rowAnimal['name'] ?>">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" required value="<?= $rowAnimal['location'] ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= $rowAnimal['description'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="size" class="form-label">Size</label>
                <input type="text" class="form-control" id="size" name="size" value="<?= $rowAnimal['size'] ?>">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" value="<?= $rowAnimal['age'] ?>">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="vaccinated" name="vaccinated" <?php if ($rowAnimal['vaccinated'] == 1) echo "checked" ?>>
                <label class="form-check-label" for="vaccinated">Vaccinated</label>
            </div>
            <div class="mb-3">
                <label for="breed" class="form-label">Breed</label>
                <input type="text" class="form-control" id="breed" name="breed" value="<?= $rowAnimal['breed'] ?>">
            </div>
            <div class="mb-3">
                <label for="adoption_status" class="form-label">Adoption Status</label>
                <select class="form-control" id="adoption_status" name="adoption_status">
                    <option value="Available" <?php if ($rowAnimal['adoption_status'] == 'Available') echo "selected" ?>>Available</option>
                    <option value="Pending" <?php if ($rowAnimal['adoption_status'] == 'Pending') echo "selected" ?>>Pending</option>
                    <option value="Adopted" <?php if ($rowAnimal['adoption_status'] == 'Adopted') echo "selected" ?>>Adopted</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>


