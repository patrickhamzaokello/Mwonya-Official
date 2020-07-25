<?php
include("../../config.php");

if(isset($_POST['songId']) && isset($_POST['artistId']) && isset($_POST['username'])) {

	$songId = $_POST['songId'];
	$artistId = $_POST['artistId'];
	$username = $_POST['username'];

	

	$orderIdQuery = mysqli_query($con, "SELECT IFNULL(max(songorder)+1, 1) AS songorder FROM likedsongs WHERE username ='$username'");
    
    $row = mysqli_fetch_array($orderIdQuery);

    $order = $row['songorder'];

    $query = mysqli_query($con, "INSERT INTO likedsongs (`songId`,`artistId`,`songorder`,`username`) VALUES('$songId','$artistId','$order','$username')");
	

}
else {
	echo "Song Id not specified by user";
}

?>