<?php
include("includes/includedFiles.php");


?>
<!-- headerends -->
<div class="overview__albums">

  <div class="overview__albums__head">
  
  <h2 class="pageHeadingBig">Poems</h2>
  
  <span class="view-type">
  
    <i class="fa fa-list list active"></i>
    
    <i class="fa fa-th-large card"></i>
    
  </span>

</div>

<div class="album">


  <div class="gridViewContainer">

    <?php

      $albumQuery = mysqli_query($con, "SELECT * FROM podcastalbum ORDER BY RAND() LIMIT 20");

      while($row = mysqli_fetch_array($albumQuery)) {

        


        echo "<div class='gridViewItem'>

            <span role='link' tabindex='0' onclick='openPage(\"podcastalbum.php?id=". $row['id'] ."\")'>

              <img src='".$row['artworkpath']."'>

              <div class='gridViewInfo'>"
                  .$row['title'].
              "</div> 
            </span>  
            
          </div>";
      }

    ?>

  </div>

</div>


<div class="overview__albums__head">
  
  <h2 class="pageHeadingBig">Live Radio</h2>
  
  <span class="view-type">
  
    <i class="fa fa-list list active"></i>
    
    <i class="fa fa-th-large card"></i>
    
  </span>

</div>

<div class="album">


  <div class="gridViewContainer">

    <?php

      $albumQuery = mysqli_query($con, "SELECT * FROM liveradio ORDER BY RAND() LIMIT 20");

      while($row = mysqli_fetch_array($albumQuery)) {

        


        echo "<div class='gridViewItem'>

            <span role='link' tabindex='0' onclick='openPage(\"radio.php?id=". $row['id'] ."\")'>

              <img src='".$row['artworkpath']."'>

              <div class='gridViewInfo'>"
                  .$row['title'].
              "</div> 
            </span>  
            
          </div>";
      }

    ?>

  </div>

</div>

<div class="overview__albums__head">
  
  <h2 class="pageHeadingBig">DJ Mixes</h2>
  
  <span class="view-type">
  
    <i class="fa fa-list list active"></i>
    
    <i class="fa fa-th-large card"></i>
    
  </span>

</div>

<div class="album">


  <div class="gridViewContainer">

    <?php

      $albumQuery = mysqli_query($con, "SELECT * FROM djmixedalbums ORDER BY RAND() LIMIT 20");

      while($row = mysqli_fetch_array($albumQuery)) {

        


        echo "<div class='gridViewItem'>

            <span role='link' tabindex='0' onclick='openPage(\"Mixes.php?id=". $row['id'] ."\")'>

              <img src='".$row['artworkpath']."'>

              <div class='gridViewInfo'>"
                  .$row['title'].
              "</div> 
            </span>  
            
          </div>";
      }

    ?>

  </div>

</div>

<div class="overview__albums__head">
  
    <h2 class="pageHeadingBig">Discover Great Music</h2>
    
    <span class="view-type">
    
      <i class="fa fa-list list active"></i>
      
      <i class="fa fa-th-large card"></i>
      
    </span>
  
  </div>

  <div class="album">


    <div class="gridViewContainer">

      <?php

        $albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 20");

        while($row = mysqli_fetch_array($albumQuery)) {

          


          echo "<div class='gridViewItem'>

              <span role='link' tabindex='0' onclick='openPage(\"album.php?id=". $row['id'] ."\")'>

                <img src='".$row['artworkPath']."'>

                <div class='gridViewInfo'>"
                    .$row['title'].
                "</div> 
              </span>  
              
            </div>";
        }

      ?>

    </div>

  </div>

  <div class="overview__albums__head" id="podcastsection">
  
  <h2 class="pageHeadingBig">Podcasts</h2>
  
  <span class="view-type">
  
    <i class="fa fa-list list active"></i>
    
    <i class="fa fa-th-large card"></i>
    
  </span>

</div>

<div class="album">


  <div class="gridViewContainer">

    <?php

      $albumQuery = mysqli_query($con, "SELECT * FROM podcastalbum ORDER BY RAND() LIMIT 20");

      while($row = mysqli_fetch_array($albumQuery)) {

        


        echo "<div class='gridViewItem'>

            <span role='link' tabindex='0' onclick='openPage(\"podcastalbum.php?id=". $row['id'] ."\")'>

              <img src='".$row['artworkpath']."'>

              <div class='gridViewInfo'>"
                  .$row['title'].
              "</div> 
            </span>  
            
          </div>";
      }

    ?>

  </div>

</div>
  


</div>
