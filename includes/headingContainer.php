<?php
if(isset($_GET['term'])){
    $term = urldecode($_GET['term']);
}
else{
    $term="";
}
?>

<script>

$(".searchInput").focus();
    $(function(){
        
        $(".searchInput").keyup(function(){
            clearTimeout(timer);

            $(".spinner img").css("visibility","visible");


            timer = setTimeout(function(){

                var val = $(".searchInput").val();
                openPage("search.php?term="+val);
            }, 2000)
        });

    });
</script>


<section class="header">

    <div class="page-flows">
    
      <span class="flow" role="link" tabindex="0" onclick="openPage('browse.php')">
        Keda Music
      </span>
      
      
    </div>
    
    <div class="search">
  
      <input type="text" class="searchInput" value="<?php echo $term ?>" placeholder="Search" onfocus="this.value = this.value" />
       
      <span class="spinner"> <img src="assets/images/icons/spinner.gif" alt=""></span>

    </div>

    <div class="navitems">
    
            <span class="navigation__list__item" role="link" tabindex="0" onclick="openPage('browse.php')">
              <i class="ion-ios-browsers"></i>
              <span>Music</span>
            </span>

            <span class="navigation__list__item" role="link" tabindex="0" onclick="openPage('podcasts.php')">
              <i class="ion-person-stalker"></i>
              <span>PodCast</span>
            </span>

            <span class="navigation__list__item" role="link" tabindex="0" onclick="openPage('poems.php')">
              <i class="ion-radio-waves"></i>
              <span>Poems</span>
            </span>

            <span class="navigation__list__item" role="link" tabindex="0" onclick="openPage('radio.php')">
              <i class="ion-radio-waves"></i>
              <span>Live Radio</span>
            </span>

            <span class="navigation__list__item" role="link" tabindex="0" onclick="openPage('Mixes.php')">
              <i class="ion-radio-waves"></i>
              <span>Dj Mixes</span>
            </span>

            <button class="button-dark" onclick="createPlaylist()">
              <span role='link' tabindex='0'>

                <i class="ion-ios-plus-outline"></i>

                Playlist

              </span>
            </button>
            
    
    </div>
    
    <div class="user">
    
      <!-- <div class="user__notifications">
      
        <i class="ion-android-notifications"></i>
        
      </div>
      
      <div class="user__inbox">
      
        <i class="ion-archive"></i>
        
      </div> -->
      
      <div class="user__info">
      
        <span class="user__info__img">
        
          <img src="assets/images/profile-pics/head_emerald.jpg" alt="Profile Picture" class="img-responsive" />
          
        </span>
        
        <span class="user__info__name" role="link" tabindex="0" onclick="openPage('settings.php')">
        
          <span class="first"><?php echo $userLoggedIn->getFirstAndLastName(); ?></span>
          
<!--           <span class="last">Hamza</span> -->
          
        </span>
        
      </div>
      
      <div class="user__actions">
      
        <div class="dropdown">
          <button class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="ion-chevron-down"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
            <li><span role="link" tabindex="0"onclick="openPage('settings.php')">Account</span></li>
            <li><span role="link" tabindex="0" onclick="openPage('updateDetails.php')">Settings</span></li>
            <li><span role="link" tabindex="0" onclick="logout()">Log Out</span></li>
          </ul>
        </div>
        
      </div>
      
    </div>
    
  </section>