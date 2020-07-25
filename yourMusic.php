<?php include("includes/includedFiles.php"); ?>

<div class="overview__albums">
              
    <div class="overview__albums__head">
  
        <h2 class="pageHeadingBig">Playlist</h2>
    
        <span class="view-type">
        
        <i class="fa fa-list list active"></i>
        
        <i class="fa fa-th-large card"></i>
        
        </span>
    
    </div>

    <div class="album">


        <div class="gridViewContainer">

            <div class="buttonItems">
                <button class="button green" onclick="createPlaylist()"> New Playlist</button>
            </div>

             <?php

                $username = $userLoggedIn->getUsername();

                $playlistQuery = mysqli_query($con, "SELECT * FROM playlists where owner ='$username'");

                if(mysqli_num_rows($playlistQuery) == 0){
                    echo "<span class='noResults'>You Don't have any Playlist. Create New Ones</span>";
                }

                while($row = mysqli_fetch_array($playlistQuery)) {

                    $playlist = new Playlist($con, $row);

                echo "<div class='gridViewItem' role='link' tabindex='0' onclick='openPage(\"playlist.php?id=".$playlist->getId()."\")'>

                        <img src='assets/images/bg.jpg'>

                        <div class='gridViewInfo'>"
                            .$playlist->getName().
                        "</div> 
                     
                    
                    </div>";
                }

            ?>        



   
        </div>

    </div>

</div>