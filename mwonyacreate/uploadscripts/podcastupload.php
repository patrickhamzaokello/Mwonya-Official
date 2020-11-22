<?php

// Database connection
// include("config/database.php");

function sanitizeFormUsername($inputText)
{
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    return $inputText;
}



if (isset($_POST["submit"])) {
    $target_dir = "../assets/images/podcastalbumartwork/";
    $dbtarget_dir = "assets/images/podcastalbumartwork/";


    $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
    $dbtarget_file = $dbtarget_dir . basename($_FILES["fileUpload"]["name"]);


    $albumtitle = $_POST['AlbumTitle'];
    $selectArtist = $_POST['artistselect'];
    $selectGenre = $_POST['genreselect'];
    $description = $_POST['description'];
    $tag = $_POST['tagname'];


    // Get file extension
    $imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Allowed file types
    $allowd_file_ext = array("jpg", "jpeg", "png");


    if (!file_exists($_FILES["fileUpload"]["tmp_name"])) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "Select image to upload."
        );
    } else if (!in_array($imageExt, $allowd_file_ext)) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "Allowed file formats .jpg, .jpeg and .png."
        );
    } else if ($_FILES["fileUpload"]["size"] > 80097152) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "File is too large. File size should be less than 2 megabytes."
        );
    } else if (file_exists($target_file)) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "File already exists."
        );
    } else {
        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO albums (title,artist,genre,artworkPath,tag,description) VALUES ('$albumtitle','$selectArtist','$selectGenre','$dbtarget_file','$tag','$description')";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute()) {
                $resMessage = array(
                    "status" => "alert-success",
                    "message" => "Image uploaded successfully."
                );
            }
        } else {
            $resMessage = array(
                "status" => "alert-danger",
                "message" => "Image coudn't be uploaded."
            );
        }
    }
}