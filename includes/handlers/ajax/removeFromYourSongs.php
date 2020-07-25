<?php
include("../../config.php");

if(isset($_POST['username']) && isset($_POST['songId'])) {
    $username = $_POST['username'];
	$songId = $_POST['songId'];
    

	$query = mysqli_query($con, "DELETE FROM likedsongs WHERE username='$username' AND songId = '$songId' ");
}
else {
	echo "Username or SongId was not passed into removeFromYourSong.php";
}


?>