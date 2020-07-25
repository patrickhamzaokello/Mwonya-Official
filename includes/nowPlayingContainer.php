<?php

$songQuery = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");

$resultArray = array();

while ($row = mysqli_fetch_array($songQuery)) {

  array_push($resultArray, $row['id']);
}

$jsonArray = json_encode($resultArray);


?>

<script>
  $(document).ready(function() {
    var newPlaylist = <?php echo $jsonArray; ?>;
    audioElement = new Audio();
    setTrack(newPlaylist[0], newPlaylist, false);

    updateVolumeProgressBar(audioElement.audio);

    $(".current-track").on("mousedown touchstart mousemove touchmove ", function(e) {
      e.preventDefault();
    });

    $(".playbackBar .progressBar").mousedown(function() {
      mouseDown = true;
    });

    $(".playbackBar .progressBar").mousemove(function(e) {
      if (mouseDown) {
        timeFromOffset(e, this);
      }
    });


    $(".playbackBar .progressBar").mouseup(function(e) {
      timeFromOffset(e, this);

    });

    // volume bar updater when dragging.
    $(".control.volume .progressBar").mousedown(function() {
      mouseDown = true;
    });

    $(".control.volume  .progressBar").mousemove(function(e) {
      if (mouseDown) {
        var percentage = e.offsetX / $(this).width();

        if (percentage >= 0 && percentage <= 1) {
          audioElement.audio.volume = percentage;
        }

      }
    });

    $(".control.volume  .progressBar").mouseup(function(e) {
      var percentage = e.offsetX / $(this).width();

      if (percentage >= 0 && percentage <= 1) {
        audioElement.audio.volume = percentage;
      }
    });

    $(document).mouseup(function() {
      mouseDown = false;
    });

  });

  function timeFromOffset(mouse, progressBar) {

    var percentage = mouse.offsetX / $(progressBar).width() * 100;

    var seconds = audioElement.audio.duration * (percentage / 100);
    audioElement.setTime(seconds);
  }

  function prevSong() {
    if (audioElement.audio.currentTime >= 3 || currentIndex == 0) {
      audioElement.setTime(0);

    } else {
      currentIndex = currentIndex - 1;
      setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
    }
  }



  function nextSong() {

    if (repeat == true) {
      audioElement.setTime(0);
      playSong();
      return;
    }

    if (currentIndex == currentPlaylist.length - 1) {
      currentIndex = 0;
    } else {
      currentIndex++;
    }

    var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, true);
  }

  function setRepeat() {
    repeat = !repeat;
    var imageName = repeat ? "ion-loop" : "ion-refresh";
    $(".control.repeat i").attr("class", imageName);
  }


  function setMute() {
    audioElement.audio.muted = !audioElement.audio.muted;
    var imageName = audioElement.audio.muted ? "ion-volume-mute" : "ion-volume-high";
    $(".control.volume i").attr("class", imageName);
  }

  function setShuffle() {
    shuffle = !shuffle;
    var imageName = shuffle ? "ion-shuffle" : "ion-ios-shuffle";
    $(".control.shuffle i").attr("class", imageName);


    if (shuffle == true) {
      //randomize playlist
      shuffleArray(shufflePlaylist);
      currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);

    } else {
      //shuffle is off and go back to regular playlist
      currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);

    }


  }

  function shuffleArray(a) {
    var j, x, i;
    for (i = a.length; i; i--) {
      j = Math.floor(Math.random() * i);
      x = a[i - 1];
      a[i - 1] = a[j];
      a[j] = x;
    }
  }


  function setTrack(trackId, newPlaylist, play) {


    if (newPlaylist != currentPlaylist) {
      currentPlaylist = newPlaylist;
      shufflePlaylist = currentPlaylist.slice();
      shuffleArray(shufflePlaylist);
    }

    if (shuffle == true) {
      currentIndex = shufflePlaylist.indexOf(trackId);
    } else {
      currentIndex = currentPlaylist.indexOf(trackId);
    }
    pauseSong();

    $.post("includes/handlers/ajax/getSongJson.php", {
      songId: trackId
    }, function(data) {

      var track = JSON.parse(data);
      $(".playing__song__name").text(track.title);

      $.post("includes/handlers/ajax/getArtistJson.php", {
        artistId: track.artist
      }, function(data) {
        var artist = JSON.parse(data);
        $(".playing__song__artist").text(artist.name);
        $(".playing__song__artist").attr("onclick", "openPage('artist.php?id=" + artist.id + "')");


      });

      $.post("includes/handlers/ajax/getAlbumJson.php", {
        albumId: track.album
      }, function(data) {
        var album = JSON.parse(data);
        $(".playing__art img").attr("src", album.artworkPath);
        $(".playing__art img").attr("onclick", "openPage('album.php?id=" + album.id + "')");
        $(".playing__song__name").attr("onclick", "openPage('album.php?id=" + album.id + "')");

      });

      audioElement.setTrack(track);

      if (play == true) {
        playSong();
        $(".track__title .title").attr("value", "playing now");

      }

    });

  }

  function playSong() {

    if (audioElement.audio.currentTime == 0) {

      $.post("includes/handlers/ajax/updatePlays.php", {
        songId: audioElement.currentlyPlaying.id
      });

    }

    $(".ion-ios-play.play").hide();
    $(".ion-ios-pause.pause").show();
    audioElement.play();
  }

  function pauseSong() {
    $(".ion-ios-play.play").show();
    $(".ion-ios-pause.pause").hide();
    audioElement.pause();
  }
</script>



<section class="current-track">

  <div class="current-track__actions">

    <a class="ion-ios-skipbackward" onclick="prevSong()"></a>

    <a class="ion-ios-play play" onclick="playSong()"></a>

    <a class="ion-ios-pause pause" onclick="pauseSong()"></a>

    <a class="ion-ios-skipforward" onclick="nextSong()"></a>

  </div>


  <div class="playbackBar">

    <span class="progressTime current-track__progress__start">0.00</span>

    <div class="progressBar">

      <div class="progressBarBg">

        <div class="progressmade"></div>

      </div>

    </div>

    <span class="progressTime current-track__progress__finish">0.00</span>

  </div>


  <div class="current-track__options">


    <span class="controls">

      <a href="#" class="control shuffle" onclick="setShuffle()">
        <i class="ion-ios-shuffle"></i>
      </a>

      <a href="#" class="control repeat" onclick="setRepeat()">
        <i class="ion-refresh"></i>
      </a>


      <a href="#" class="control volume">

        <i class="ion-volume-high" onclick="setMute()"></i>

        <div class="progressBar">

          <div class="progressBarBg">

            <div class="volumeprogress"></div>

          </div>

        </div>

      </a>

      <span class="control" role="link" tabindex="0" onclick="openPage('browse.php')">
        Keda Music
      </span>

    </span>

  </div>

</section>