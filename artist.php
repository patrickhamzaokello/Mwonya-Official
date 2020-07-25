<?php
include("includes/includedFiles.php");

if (isset($_GET['id'])) {
  $artistId =  $_GET['id'];
} else {
  header("Location:index.php");
}

$artist = new Artist($con, $artistId);

?>
<!-- headerends -->

<div class="artist__header">

  <div class="artist__info">

    <div class="profile__img">

      <img src="<?php echo $artist->getProfilePath(); ?>"/>

    </div>

    <div class="artist__info__meta">

      <div class="artist__info__type">Artist</div>

      <div class="artist__info__name"><?php echo $artist->getName(); ?></div>

      <div class="artist__info__actions">

        <button class="button-dark" onclick="playFirstSong()">
          <i class="ion-ios-play"></i>
          Play
        </button>

        <button class="button-light">Follow</button>

        <button class="button-light more">
          <i class="ion-ios-more"></i>
        </button>

      </div>

    </div>


  </div>

  <div class="artist__listeners">

  <?php

  $totalplaysquery = mysqli_query($con, "SELECT SUM(`plays`) AS totalplays FROM songs where `artist` = $artistId");
  $row = mysqli_fetch_array($totalplaysquery);


  echo " <div class='artist__listeners__count'>". $row['totalplays'] ."</div>  ";
    
  
  ?>

    <div class="artist__listeners__label">Monthly Listeners</div>

  </div>

  <div class="artist__navigation">

    <ul class="nav nav-tabs" role="tablist">

      <li role="presentation" class="active">
        <a href="#artist-overview" aria-controls="artist-overview" role="tab" data-toggle="tab">Overview</a>
      </li>

      <!--<li role="presentation">
                <a href="#artist-about" aria-controls="artist-about" role="tab" data-toggle="tab">About</a>
              </li>-->

    </ul>

    <div class="artist__navigation__friends">

      <a href="#">
        <img src="assets/images/profile-pics/me.jpg" alt="" />
      </a>

      <a href="#">
        <img src="assets/images/profile-pics/me.jpg" alt="" />
      </a>

      <a href="#">
        <img src="assets/images/profile-pics/me.jpg" alt="" />
      </a>

    </div>

  </div>

</div>

<div class="artist__content">

  <div class="tab-content">

    <!-- Overview -->
    <div role="tabpanel" class="tab-pane active" id="artist-overview">

      <div class="overview">

        <div class="overview__artist">

          <!-- Latest Release-->
          <div class="section-title">Latest Release</div>

          <div class="latest-release">
            <?php


            $albumQuery = mysqli_query($con, "SELECT * FROM albums where artist='$artistId'ORDER BY id DESC LIMIT 1");

            while ($row = mysqli_fetch_array($albumQuery)) {


              echo "
                              <div class='latest-release__art' role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>

                                <img src='" . $row['artworkPath'] . "'/>
                               
                              </div>

                              <div class='latest-release__song'>

                              <div class='latest-release__song__title'>" . $row['title'] . "</div>


                                <div class='latest-release__song__date'>

                                  <span class='day'>12</span>

                                  <span class='month'>August</span>

                                  <span class='year'>2018</span>

                                </div>

                              </div>

                            
                            ";
            }
            ?>

          </div>
          <!-- / -->

          <!-- Popular-->
          <div class="section-title">Popular</div>

          <div class="tracks">

            <?php


            $songIdArray = $artist->getSongIds();

            $i = 1;



            foreach ($songIdArray as $songId) {

              if ($i > 5) {
                break;
              }

              $albumSong = new Song($con, $songId);
              $albumArtist = $albumSong->getArtist();

              echo "
                          <div class='track'>

                            <div class='track__number'>$i</div>

                            <div class='track__added'>

                              <i class='ion-play playsong ' onclick='setTrack(\"" . $albumSong->getId() . "\",tempPlaylist, true)'></i>

                            </div>

                            <div class='track__title featured'>
                            
                              <span class='title'>" . $albumSong->getTitle() . "</span>
                              <span class='feature'>" . $albumArtist->getName() . "</span>
                              
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
            </script>



          </div>


          <!-- options menu -->

          <nav class="optionsMenu">
            <input type="hidden" class="songId">

            <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>


          </nav>

          <button class="show-more button-light">Show 5 More</button>
          <!-- / -->

        </div>

        <div class="overview__related">

          <div class="section-title">Related Artist</div>

          <div class="related-artists">


            <?php

              $artistGenre = $artist->getGenre();
              $artistname = $artist->getName();


              $artistQuery = mysqli_query($con, "SELECT * FROM artists WHERE genre='$artistGenre' AND name != '$artistname' ");
  
              while($row = mysqli_fetch_array($artistQuery)){

                echo "
  
                <a href='#' class='related-artist' role='link' tabindex='0' onclick='openPage(\"artist.php?id=".$row['id']."\")'>
            
                  <span class='related-artist__img'>
                  
                    <img src=\"".$row['profilephoto']."\" />
                    
                  </span>
                  
                  <span class='related-artist__name'>" . $row['name'] . "</span>
                  
                </a>             
                    ";


              }
  

            

            ?>



          </div>

        </div>

        <div class="overview__albums">

          <div class="overview__albums__head">

            <span class="section-title">Albums</span>

            <span class="view-type">

              <i class="fa fa-list list active"></i>

              <i class="fa fa-th-large card"></i>

            </span>

          </div>

          <div class="album">


            <div class="gridViewContainer">

              <?php

              $albumQuery = mysqli_query($con, "SELECT * FROM albums where artist='$artistId'");

              while ($row = mysqli_fetch_array($albumQuery)) {




                echo "<div class='gridViewItem'>

                              <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>

                                <img src='" . $row['artworkPath'] . "'>

                                <div class='gridViewInfo'>"
                  . $row['title'] .
                  "</div> 
                              </span>  
                              
                            </div>";
              }

              ?>


            </div>



          </div>

        </div>

      </div>

    </div>
    <!-- / -->



  </div>

</div>