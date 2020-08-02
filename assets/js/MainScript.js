var currentPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;
var timer;

$(document).click(function (click) {
    var target = $(click.target);

    if (!target.hasClass("item") && !target.hasClass("ion-more")) {
        hideOptionsMenu();
    }
});

$(window).scroll(function () {
    console.log("scrolling");
    hideOptionsMenu();
});

$(document).on("change", "select.playlistname", function () {
    var select = $(this);
    var playlistId = select.val();
    var songId = select.prev(".songId").val();

    $.post("includes/handlers/ajax/addToPlaylist.php", { playlistId: playlistId, songId: songId })
        .done(function (error) {

            if (error != "") {
                alert(error);
                return;
            }

            hideOptionsMenu();
            select.val("");

        });

});

function updatePassword(oldPasswordClass, newPasswordClass1, newPasswordClass2) {
    var oldPassword = $("." + oldPasswordClass).val();
    var newPassword1 = $("." + newPasswordClass1).val();
    var newPassword2 = $("." + newPasswordClass2).val();

    $.post("includes/handlers/ajax/updatePassword.php",
        {
            oldPassword: oldPassword,
            newPassword1: newPassword1,
            newPassword2: newPassword2,
            username: userLoggedIn
        })

        .done(function (response) {
            $("." + oldPasswordClass).nextAll(".message").text(response);
        })


}


function updateEmail(emailClass) {
    var emailValue = $("." + emailClass).val();

    $.post("includes/handlers/ajax/updateEmail.php", { email: emailValue, username: userLoggedIn })
        .done(function (response) {
            $("." + emailClass).nextAll(".message").text(response);
        });
}

function logout() {
    $.post("includes/handlers/ajax/logout.php", function () {
        location.reload();
    })
}

function openPage(url) {

    if (timer != null) {
        clearTimeout(timer);
    }

    if (url.indexOf("?") == -1) {
        url = url + "?";
    }
    var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
    console.log(encodedUrl);
    $("#mainContent").load(encodedUrl);
    $("body").scrollTop(0);
    history.pushState(null, null, url);

}


function removeFromYourSongs(button, username) {

    var songId = $(button).prevAll(".songId").val();

    $.post("includes/handlers/ajax/removeFromYourSongs.php", { username: username, songId: songId }).done(function (error) {


        if (error != "") {
            alert(error);
            return;
        }

        //do something when ajax returns
        openPage("userSongs.php");

    });


}

function removeFromPlaylist(button, playlistId) {

    var songId = $(button).prevAll(".songId").val();

    $.post("includes/handlers/ajax/removeFromPlaylist.php", { playlistId: playlistId, songId: songId }).done(function (error) {


        if (error != "") {
            alert(error);
            return;
        }

        //do something when ajax returns
        openPage("playlist.php?id=" + playlistId);

    });


}



function createPlaylist() {
    console.log(userLoggedIn);
    var popup = prompt("Playlist Name");

    if (popup != null) {

        $.post("includes/handlers/ajax/createPlaylist.php", { name: popup, username: userLoggedIn }).done(function (error) {


            if (error != "") {
                alert(error);
                return;
            }

            //do something when ajax returns           
            openPage("yourMusic.php");
            $("#playlists").load(location);


        });


    }
}

function deletePlaylist(playlistId) {
    var prompt = confirm("are you sure you want to delete this playlist?");

    if (prompt == true) {
        $.post("includes/handlers/ajax/deletePlaylist.php", { playlistId: playlistId }).done(function (error) {

            console.log("deletesong");


            if (error != "") {
                alert(error);
                return;
            }

            //do something when ajax returns
            openPage("yourMusic.php");
            $("#playlists").load(location);

        });
    }
}

function hideOptionsMenu() {
    var menu = $(".optionsMenu");
    if (menu.css("display") != "none") {
        menu.css("display", "none");
    }
}

function showOptionsMenu(button) {

    var songId = $(button).prevAll(".songId").val();

    //  console.log("showoptionsclicked songId: "+ songId );   
    var menu = $(".optionsMenu");
    var menuWidth = menu.width();
    menu.find(".songId").val(songId);

    var scrollTop = $(window).scrollTop(); //distrance from top of window to top of document
    var elementOffset = $(button).offset().top; //distance from top of document

    var top = elementOffset - scrollTop;
    var left = $(button).position().left;

    menu.css({ "top": top + "px", "left": left - menuWidth + "px", "display": "inline" });
}


function addSongLiked(button) {
    var artistId = $(button).prevAll(".artistId").val();
    var songId = $(button).prevAll(".songId").val();


    console.log("songId: " + songId);
    console.log("artistId: " + artistId);


    if (songId != null) {

        $.post("includes/handlers/ajax/addLikedSong.php", { songId: songId, artistId: artistId, username: userLoggedIn }).done(function (error) {


            if (error != "") {
                alert(error);
                return;
            }

            //do something when ajax returns           
            // openPage("yourMusic.php");
            // $("#playlists").load(location);
            $(button, ".ion-plus").css("color", "yellow");
            console.log("Song Added to Liked Song");


        });


    }


}

function formatTime(seconds) {
    var time = Math.round(seconds);
    var minutes = Math.floor(time / 60); //Rounds down
    var seconds = time - (minutes * 60);

    var extrazero = (seconds < 10) ? "0" : "";

    return minutes + ":" + extrazero + seconds;
}

function updateTimeProgressBar(audio) {

    $(".progressTime.current-track__progress__start").text(formatTime(audio.currentTime));
    $(".progressTime.current-track__progress__finish").text(formatTime(audio.duration - audio.currentTime));

    var progress = audio.currentTime / audio.duration * 100;
    $(".progressmade").css("width", progress + "%");
}


function updateVolumeProgressBar(audio) {
    var volume = audio.volume * 100;
    $(".volumeprogress").css("width", volume + "%");
}

function playFirstSong() {
    setTrack(tempPlaylist[0], tempPlaylist, true);
}

function Audio() {

    this.currentlyPlaying;
    this.audio = document.createElement('audio');

    this.audio.addEventListener("ended", function () {
        nextSong();
    });

    this.audio.addEventListener("canplay", function () {
        //this refers to the object that the event was called on
        var duration = formatTime(this.duration);
        $(".current-track__progress__finish").text(duration);
    });

    this.audio.addEventListener("timeupdate", function () {

        if (this.duration) {
            updateTimeProgressBar(this);
        }
    });

    this.audio.addEventListener("volumechange", function () {

        updateVolumeProgressBar(this);

    });

    this.setTrack = function (track) {
        this.currentlyPlaying = track;
        this.audio.src = track.path;
        
        // making song css tracker

        console.log(this.currentlyPlaying[1]) //gets song title

        $(".title:contains(" + this.currentlyPlaying[1] + ")").parent().parent().addClass('pkkkk');
        $('.pkkkk').css("border-left","none");
        $('.pkkkk').css("background","none");


        if ($(".title:contains(" + this.currentlyPlaying[1] + ")").parent().parent().hasClass('pkkkk')) {
            $('.track').removeClass('pkkkk');
            $(".title:contains(" + this.currentlyPlaying[1] + ")").parent().parent().addClass('pkkkk');
            $('.pkkkk').css("border-left", "2px solid yellow");
            $('.pkkkk').css("background","#2c093a");

        } else {
            $('.pkkkk').css("border-left","none");
            $('.pkkkk').css("background","none");

            $('.track').removeClass('pkkkk');


        }

    }

    this.play = function () {
        this.audio.play();
    }

    this.pause = function () {
        this.audio.pause();
    }

    this.setTime = function (seconds) {
        this.audio.currentTime = seconds;
    }

}