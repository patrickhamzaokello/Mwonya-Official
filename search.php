<?php
include("includes/includedFiles.php");


if(isset($_GET['term'])){
    $term = urldecode($_GET['term']);
}
else{
    $term="";
}
?>
<!-- header ends -->

<script>

    $(".spinner img").css("visibility","hidden");

</script>


<?php if($term == "") exit(); ?>

<div class="overview__albums">
                
    <div class="overview__albums__head">
    
        <span class="section-title">Songs</span>
        
        <span class="view-type">
        
            <i class="fa fa-list list active"></i>
            
            <i class="fa fa-th-large card"></i>
        
        </span>
    
    </div>


        <?php 

            $songsQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '%$term%'  AND tag ='music' LIMIT 10");

            if(mysqli_num_rows($songsQuery) == 0){
                echo "<span class='noResults'>No songs found matching: ".$term."</span>";
                
            }

            else{

            echo "
            
                <div class='album'>
                        
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
            
            ";}
            $songIdArray = array();         
                    
            $i = 1;

            while($row = mysqli_fetch_array($songsQuery)){

                if($i > 15){
                    break;
                }

                array_push($songIdArray, $row['id']);

                $albumSong = new Song($con, $row['id']);
                $albumArtist = $albumSong->getArtist();
                $songAlbum =  $albumSong->getAlbum();

                echo "
                <div class='track'>

                    <div class='track__number'>$i</div>

                    <div class='track__added'>

                    <i class='ion-play playsong ' onclick='setTrack(\"".$albumSong->getId()."\",tempPlaylist, true)'></i>

                    </div>

                    <div class='track__title featured'>
                    
                    <span class='title' role='link' tabindex='0' onclick='openPage(\"album.php?id=". $songAlbum->getId()."\")'>".$albumSong->getTitle()."</span>
                    <span class='feature' role='link' tabindex='0' onclick='openPage(\"artist.php?id=". $albumArtist->getId()."\")'>". $albumArtist->getName()."</span>
                    
                    </div>

                    <div class='track__more'>

                        <input type='hidden' class='songId' value='". $albumSong->getId()."'>
            
                        <i class='ion-more' onclick='showOptionsMenu(this)'></i>

                    </div>
                
                    <div class='track__length'>".$albumSong->getDuration()."</div>
                    
                    <div class='track__popularity'>
                    
                    <i class='ion-arrow-graph-up-right'></i>
                    
                    </div>

                </div> ";

                $i = $i +1;

            }

            ?>

            <script>
                var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
                tempPlaylist = JSON.parse(tempSongIds);
                // console.log(tempPlaylist);
            </script>
        
    
        </div>
    
        </div>
                  
    </div>

</div>

<!-- options menu -->

<nav class="optionsMenu">
  <input type="hidden" class="songId">

  <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
  
  <div class="item">Add to Songs</div>

</nav>




<div class="overview__albums">
                
    <div class="overview__albums__head">
    
        <span class="section-title">Artists</span>
        
        <span class="view-type">
        
            <i class="fa fa-list list active"></i>
            
            <i class="fa fa-th-large card"></i>
        
        </span>
    
    </div>

    <?php 

        $artistQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '%$term%' LIMIT 10");

        if(mysqli_num_rows($artistQuery) == 0){
            echo "<span class='noResults'>No Artists found matching: ".$term."</span>";
        }

        else{

                echo "
                
                    <div class='album'>
                            
                        <div class='album__tracks'>
                
                            <div class='tracks'>
                            
                                <div class='tracks__heading'>
                                
                                    <div class='tracks__heading__number'>#</div>
                                    
                                    <div class='tracks__heading__title'>Artist</div>
                                    
                                
                                </div>
        
        ";}
                                $i = 1;

                            while($row = mysqli_fetch_array($artistQuery)){

                                $artistFound = new Artist($con,$row['id']);

                            
                                echo "
                                <div class='track'>

                                    <div class='track__number'>$i</div>

                                    <div class='track__added'>

                                        <i class='ion-plus'></i>

                                    </div>

                                    <div class='track__title'>
                                            
                                        <span  class='title' role='link' tabindex='0' onclick='openPage(\"artist.php?id=". $artistFound->getId()."\")'>". $artistFound->getName()."</span>
                                
                                
                                    </div>

                                </div>";

                                $i = $i +1;        
                                        

                            }

                            echo "
                            
                            </div>
                            </div>
                            </div>
                            
                            ";

        ?>

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

                $albumQuery = mysqli_query($con, "SELECT * FROM albums where title LIKE '%$term%' LIMIT 10");

                if(mysqli_num_rows($albumQuery) == 0){
                    echo "<span class='noResults'>No Albums found matching: ".$term."</span>";
                }

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
                
</div>

<!-- podcast Results -->
<div class="overview__albums">
                
    <div class="overview__albums__head">
    
        <span class="section-title">Podcasts Results</span>
        
        <span class="view-type">
        
            <i class="fa fa-list list active"></i>
            
            <i class="fa fa-th-large card"></i>
        
        </span>
    
    </div>


        <?php 

            $songsQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '%$term%' AND tag ='podcast' LIMIT 10");

            if(mysqli_num_rows($songsQuery) == 0){
                echo "<span class='noResults'>No Podcasts found matching: ".$term."</span>";
                
            }

            else{

            echo "
            
                <div class='album'>
                        
                    <div class='album__tracks'>
            
                        <div class='tracks'>
                        
                                <div class='tracks__heading'>
                                
                                <div class='tracks__heading__number'>#</div>
                                
                                <div class='tracks__heading__title'>Podcast</div>
                                
                                <div class='tracks__heading__length'>
                                
                                    <i class='ion-ios-stopwatch-outline'></i>
                                    
                                </div>
                                
                                <div class='tracks__heading__popularity'>
                                
                                    <i class='ion-thumbsup'></i>
                                    
                                </div>
                        
                        </div>
            
            ";}
            $songIdArray = array();         
                    
            $i = 1;

            while($row = mysqli_fetch_array($songsQuery)){

                if($i > 15){
                    break;
                }

                array_push($songIdArray, $row['id']);

                $albumSong = new Song($con, $row['id']);
                $albumArtist = $albumSong->getArtist();
                $songAlbum =  $albumSong->getAlbum();

                echo "
                <div class='track'>

                    <div class='track__number'>$i</div>

                    <div class='track__added'>

                    <i class='ion-play playsong ' onclick='setTrack(\"".$albumSong->getId()."\",tempPlaylist, true)'></i>

                    </div>

                    <div class='track__title featured'>
                    
                    <span class='title' role='link' tabindex='0' onclick='openPage(\"album.php?id=". $songAlbum->getId()."\")'>".$albumSong->getTitle()."</span>
                    <span class='feature' role='link' tabindex='0' onclick='openPage(\"artist.php?id=". $albumArtist->getId()."\")'>". $albumArtist->getName()."</span>
                    
                    </div>

                    <div class='track__more'>

                        <input type='hidden' class='songId' value='". $albumSong->getId()."'>
            
                        <i class='ion-more' onclick='showOptionsMenu(this)'></i>

                    </div>
                
                    <div class='track__length'>".$albumSong->getDuration()."</div>
                    
                    <div class='track__popularity'>
                    
                    <i class='ion-arrow-graph-up-right'></i>
                    
                    </div>

                </div> ";

                $i = $i +1;

            }

            ?>

            <script>
                var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
                tempPlaylist = JSON.parse(tempSongIds);
                // console.log(tempPlaylist);
            </script>
        
    
        </div>
    
        </div>
                  
    </div>

</div>