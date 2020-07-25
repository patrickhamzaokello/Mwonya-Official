<?php 
include("includes/includedFiles.php");

if(isset($_GET['id'])){
    $playlistId =  $_GET['id'];
}
else{
   header("Location:index.php");
}

$playlist = new Playlist($con, $playlistId);
$owner = new User($con, $playlist->getOwner());

?>

<!-- headerends -->

<div class="overview__albums">
              
                <div class="overview__albums__head">
                
                  <span class="section-title">Playlist</span>
                  
                  <span class="view-type">
                  
                    <i class="fa fa-list list active"></i>
                    
                    <i class="fa fa-th-large card"></i>
                    
                  </span>
                
                </div>

                <div class="entityInfo">
                    <div class="leftSection">
                        <img src="assets/images/bg.jpg">
                    </div>

                    <div class="rightSection">
                        <h2><?php echo $playlist->getName(); ?></h2>

                        <p>By <?php echo $playlist->getOwner(); ?></p>

                        <p> <?php echo $playlist->getNumberOfSongs(); ?> Songs</p>

                        <button class="button-dark" onclick="playFirstSong()">
                          <i class="ion-ios-play"></i>
                          Play
                        </button>

                        <button class="button green" onclick="deletePlaylist('<?php echo $playlistId; ?>')">delete</button>

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


                            $songIdArray = $playlist->getSongIds();         
                                    
                            $i = 1;

                            foreach($songIdArray as $songId){

                                $playlistSong = new Song($con, $songId);
                                $songArtist = $playlistSong->getArtist();

                                echo "
                                <div class='track'>

                                  <div class='track__number'>$i</div>
        
                                  <div class='track__added'>
        
                                    <i class='ion-play playsong ' onclick='setTrack(\"".$playlistSong->getId()."\",tempPlaylist, true)'></i>

                                  </div>
        
                                  <div class='track__title featured'>
                                  
                                    <span class='title'>".$playlistSong->getTitle()."</span>
                                    <span class='feature' role='link' tabindex='0' onclick='openPage(\"artist.php?id=". $songArtist->getId()."\")'>". $songArtist->getName()."</span>
                                    
                                  </div>
        
                                  <div class='track__more'>
          
                                    <input type='hidden' class='songId' value='". $playlistSong->getId()."'>
            
                                    <i class='ion-more' onclick='showOptionsMenu(this)'></i>
          
                                  </div>
                                
                                  <div class='track__length'>".$playlistSong->getDuration()."</div>
                                  
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

  
  <div class="item" onclick="removeFromPlaylist(this, '<?php echo $playlistId; ?>')">Remove from Playlist</div>


</nav>
