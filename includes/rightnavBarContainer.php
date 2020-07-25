<div class="content__right">

  <div class="topChart">

    <p>TOP 10 SONGS</p>


    <?php


    $topchart = mysqli_query($con, "SELECT id FROM songs  ORDER BY  plays DESC LIMIT 10");

    if (mysqli_num_rows($topchart) == 0) {
      echo "<span class='navigation__list__item'>working on top charts</span>";
    }

    $songIdArray = array();

    $i = 1;

    while ($row = mysqli_fetch_array($topchart)) {

      array_push($songIdArray, $row['id']);

      $albumSong = new Song($con, $row['id']);
      $albumArtist = $albumSong->getArtist();
      $songAlbum =  $albumSong->getAlbum();


      echo "
          <div class='chartSong'>
          
            <div class='chartSong__art'>

              <img src=\"" . $songAlbum->getArtworkPath() . "\" />
      
            </div>
        
            <div class='chartElement'>
        
              <span class='chartSongName' role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $songAlbum->getId() . "\")'>" . $albumSong->getTitle() . "</span>
        
              <span class='ChartArtistName'role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $albumArtist->getId() . "\")'>" . $albumArtist->getName() . "</span>
        
            </div>
        
            <div class='chartAdd'>
        
              <i class='ion-play playsong ' onclick='setTrack(\"" . $albumSong->getId() . "\",tempPlaylist, true)'></i>
              
        
            </div>

          </div>
          
          ";

      $i = $i + 1;
    }

    ?>

    <script>
      var topchartsongID = '<?php echo json_encode($songIdArray); ?>';
      tempPlaylist = JSON.parse(topchartsongID);
      // console.log(tempPlaylist);
    </script>


  </div>


</div>