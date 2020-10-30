<?php

// Database connection
include("config/database.php");

function sanitizeFormUsername($inputText)
{
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    return $inputText;
}

//Our select statement. This will retrieve the data that we want.
$sqlgenre = "SELECT id, name FROM genres";

//Prepare the select statement.
$stmtgrenre = $conn->prepare($sqlgenre);

//Execute the statement.
$stmtgrenre->execute();

//Retrieve the rows using fetchAll.
$genres = $stmtgrenre->fetchAll();

if (isset($_POST["submit"])) {
    $target_dir = "../assets/images/artistprofiles/";
    $dbtarget_dir = "assets/images/artistprofiles/";

    $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
    $dbtarget_file = $dbtarget_dir . basename($_FILES["fileUpload"]["name"]);


    //Get username
    $artistname = $_POST['Artistname'];
    $selectOption = $_POST['taskOption'];

    // Get file extension
    $imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Allowed file types
    $allowd_file_ext = array("jpg", "jpeg", "png", "mp3");


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
            $sql = "INSERT INTO artists (name,profilephoto,genre) VALUES ('$artistname','$dbtarget_file','$selectOption')";
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