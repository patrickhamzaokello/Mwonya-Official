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
    $covertarget_file = $target_dir . basename($_FILES["coverUpload"]["name"]);

    $dbtarget_file = $dbtarget_dir . basename($_FILES["fileUpload"]["name"]);
    $dbcovertarget_file = $dbtarget_dir . basename($_FILES["coverUpload"]["name"]);




    //Get username
    $artistname = $_POST['Artistname'];
    $selectOption = $_POST['taskOption'];
    $contentType = $_POST['artistType'];

    $email = $_POST['Artistemail'];
    $password = $_POST['Artistpassword'];
    $description = $_POST['Artistdescription'];



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
        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file) && move_uploaded_file($_FILES["coverUpload"]["tmp_name"], $covertarget_file)) {
            $sql = "INSERT INTO artists (name,email,password,profilephoto,coverimage,bio,genre,tag) VALUES ('$artistname','$email','$password','$dbtarget_file','$dbcovertarget_file','$description','$selectOption','$contentType')";
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