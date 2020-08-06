<?php
include("includes/classes/Playlist.php");



?>
<div class="content__left">

  <section class="navigation">

    <!-- Main -->
    <div class="navigation__list navwithimage">

      <img class="userpicture" src="assets/images/profile-pics/user.png" width="48px" alt="">

      <p class="homeuser">
        <span class="userinfo username"><?php echo $userLoggedIn->getFirstandLastname(); ?></span>
        <span class="userinfo"><?php echo $userLoggedIn->getUsername(); ?><b class="caret"></b></span>
        <span class="userinfo" style="text-transform: lowercase;"><?php echo $userLoggedIn->getEmail(); ?><b class="caret"></b></span>

      </p>

    </div>

    <!-- / -->

    <!-- Your Music -->
    <div class="navigation__list">
      <div class="navigation__list__header" role="button" data-toggle="collapse" href="#yourMusic" aria-expanded="true" aria-controls="yourMusic">
        <i class="ion-headphone"></i>

        Your Music
      </div>

      <div class="collapse in" id="yourMusic">

        <span class="navigation__list__item" role="link" tabindex="0" onclick="openPage('userSongs.php')">
          <i class="ion-headphone"></i>
          <span>Songs</span>
        </span>

        <span class="navigation__list__item" role="link" tabindex="0" onclick="openPage('browse.php')">
          <i class="ion-ios-musical-notes"></i>
          <span>Albums</span>
        </span>

        <span class="navigation__list__item" role="link" tabindex="0" onclick="openPage('userArtist.php')">
          <i class="ion-person"></i>
          <span>Artists</span>
        </span>

        <span class="navigation__list__item" role="link" tabindex="0" onclick="openPage('yourMusic.php')">
          <i class="ion-document"></i>
          <span>Playlists</span>
        </span>

      </div>

    </div>
    <!-- / -->

    <!-- Playlists -->
    <div class="navigation__list">

      <div class="navigation__list__header" role="button" data-toggle="collapse" href="#playlists" aria-expanded="true" aria-controls="playlists">
        <i class="ion-document"></i>

        Playlists
      </div>

      <div class="collapse in  playlistadjusted" id="playlists">

        <?php

        $username =  $userLoggedIn->getUsername();

        $playlistQuery = mysqli_query($con, "SELECT * FROM playlists where owner ='$username'");

        if (mysqli_num_rows($playlistQuery) == 0) {
          echo "<span class='navigation__list__item'>No Playlist Created</span>";
        }

        while ($row = mysqli_fetch_array($playlistQuery)) {

          $playlist = new Playlist($con, $row);

          echo "                      
                      <span href='#' class='navigation__list__item' role='link' tabindex='0' onclick='openPage(\"playlist.php?id=" . $playlist->getId() . "\")'>
                        <i class='ion-ios-musical-notes'></i>
                        <span>" . $playlist->getName() . "</span>
                      </span>";
        }

        ?>

      </div>

    </div>
    <!-- / -->

  </section>

  <section class="playlist">

      <span role='link' tabindex='0'onclick="createPlaylist()">

        <i class="ion-ios-plus-outline"></i>

        New Playlist

      </span>

    </section>

  <div class="songplaying">

  <div class="lds-dual-ring"> </div>

    <div class="playing__art">

      <img role='link' tabindex='0' src="" alt="Album Art" />

    </div>
   

  </div>


  <section class="playing">

    <div class="playing__song">

      <span role='link' tabindex='0' class="playing__song__name"></span>

      <span role='link' tabindex='0' class="playing__song__artist"></span>

    </div>

  </section>

</div>