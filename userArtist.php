<?php
include("includes/includedFiles.php");


$likedsong = new LikedSong($con, $userLoggedIn->getUsername());
$owner = new User($con, $likedsong->getOwner());

?>

<!-- headerends -->

<div class="overview__albums">

  <div class="overview__albums__head">

    <span class="section-title">Your Fav Artists</span>

    <span class="view-type">

      <i class="fa fa-list list active"></i>

      <i class="fa fa-th-large card"></i>

    </span>

  </div>




  <div class="album">

    <div class='album__tracks'>

      <div class='tracks'>

        <div class='tracks__heading'>

          <div class='tracks__heading__number'>#</div>

          <div class='tracks__heading__title'>Artist</div>



        </div>
        <?php


        $artistIdArray = $likedsong->getArtistIds();

        $i = 1;

        foreach ($artistIdArray as $artistid) {

          $artist = new Artist($con, $artistid);

          echo "
                                <div class='track'>

                                  <div class='track__number'>$i</div>
        
        
                                  <div class='track__title featured'>
                                  
                                    <span class='titles' role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artist->getId() . "\")'>" . $artist->getName() . "</span>
                                    
                                  </div>
        
                                </div> ";

          $i = $i + 1;
        }

        ?>




      </div>

    </div>

  </div>

</div>