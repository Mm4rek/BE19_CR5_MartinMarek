<?php
function fileUpload($picture, $source = "user") {
    if ($picture["error"] == 4) {
        // No file has been chosen, set default picture name
        $pictureName = "avatar.png";

        if ($source == "product") {
            $pictureName = "product.png";
        }

        $message = "No picture has been chosen, but you can upload an image later :)";
    } else {
        // Check if the selected file is an image
        $checkIfImage = getimagesize($picture["tmp_name"]);
        if ($checkIfImage) {
            $message = "Ok";
        } else {
            $message = "Not an image";
        }
    }

    if ($message == "Ok") {
        // Get the extension of the image
        $ext = strtolower(pathinfo($picture["name"], PATHINFO_EXTENSION));
        // Generate a random filename
        $pictureName = uniqid("") . "." . $ext;
        // Set the destination path to save the file
        $destination = "pictures/{$pictureName}";

        if ($source == "product") {
            $destination = "../pictures/{$pictureName}";
        }

        // Move the uploaded file to the destination folder
        move_uploaded_file($picture["tmp_name"], $destination);
    } elseif ($message == "Not an image") {
        // If the selected file is not an image, set default picture name
        $pictureName = "avatar.png";
        $message = "The file you selected is not an image, you can upload a picture later";
    }

    return [$pictureName, $message]; // Returning the name of the picture and the message
}
?>