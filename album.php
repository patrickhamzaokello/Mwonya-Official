<?php
include("includes/includedFiles.php");

if (isset($_GET['id'])) {
  $albumId =  $_GET['id'];
} else {
  header("Location:index.php");
}

$album = new Album($con, $albumId);
$artist = $album->getArtist();

?>
<!-- headerends -->

<div class="overview__albums">

    <div class="overview__albums__head">

        <span class="section-title">Album</span>

        <span class="view-type">

            <i class="fa fa-list list active"></i>

            <i class="fa fa-th-large card"></i>

        </span>

    </div>

    <div class="entityInfo">
        <div class="leftSection">
            <img src="<?php echo $album->getArtworkPath(); ?>">
        </div>

        <div class="rightSection">
            <h2><?php echo $album->getTitle(); ?></h2>

            <p>ARTIST: <?php echo $artist->getName(); ?></p>

            <p> <?php echo $album->getNumberOfSongs(); ?> Songs</p>

            <button class="button-dark" onclick="playFirstSong()">
                <i class="ion-ios-play"></i>
                Play All
            </button>

        </div>
    </div>


    <div class="album">

        <div class='album__tracks'>

            <div class='tracks'>

                <div class='tracks__heading'>

                    <div class='tracks__heading__number'>#</div>

                    <div class='tracks__heading__title'>Song</div>

                    <div class='tracks__heading__length'>

                        <i class='ion-ios-stopwatch-outline'></i>

                    </div>

                    <div class='tracks__heading__popularity'>

                        <i class='ion-thumbsup'></i>

                    </div>

                </div>
                <?php


        $songIdArray = $album->getSongIds();

        $i = 1;

        foreach ($songIdArray as $songId) {

          $albumSong = new Song($con, $songId);
          $albumArtist = $albumSong->getArtist();

          echo "
                                <div class='track'>

                                  <div class='track__number'>$i</div>
        
                                  <div class='track__added'>
        
                                    <i class='ion-play playsong ' onclick='setTrack(\"" . $albumSong->getId() . "\",tempPlaylist, true)'></i>

                                  </div>

                                  <div class='track__added'>

                                    <input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
                                    <input type='hidden' class='artistId' value='" . $albumArtist->getId() . "'>


                                    <i class='ion-plus' onclick='addSongLiked(this)'></i>
       
                                  </div>
        
                                  <div class='track__title featured' >
                                  
                                    <span class='title' onclick='setTrack(\"" . $albumSong->getId() . "\",tempPlaylist, true)'>" . $albumSong->getTitle() . "</span>
                                    <span class='feature' value=\"" . $albumArtist->getId() . "\">" . $albumArtist->getName() . "</span>
                                    
                                  </div>
        
                                  <div class='track__more'>

                                     <input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
          
                                    <i class='ion-more' onclick='showOptionsMenu(this)'></i>
          
                                  </div>
                                
                                  <div class='track__length'>" . $albumSong->getDuration() . "</div>
                                  
                                  <div class='track__popularity'>
                                  
                                    <i class='ion-arrow-graph-up-right'></i>
                                    
                                  </div>
        
                                </div> ";

          $i = $i + 1;
        }

        ?>

                <script>
                var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
                tempPlaylist = JSON.parse(tempSongIds);
                // console.log(tempPlaylist);

                $(".track__title .feature").attr("onclick", "openPage('artist.php?id=" +
                    <?php echo $albumArtist->getId() ?> + "')");
                </script>


            </div>

        </div>

    </div>

</div>

<!-- options menu -->

<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>