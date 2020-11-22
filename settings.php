<?php include("includes/includedFiles.php"); ?>


<div class="overview__albums">

    <div class="userCenterSection">
        <div class="userInfo">
            <h3>ACCOUNT INFO</h3>

            <img src="assets/images/profile-pics/me.jpg" alt="">

            <p class="userlable">USER NAME </P>
            <P class="uservalue"><?php echo $userLoggedIn->getUsername(); ?></P>

            <p class="userlable">FULL NAME</P>
            <P class="uservalue"><?php echo $userLoggedIn->getFirstAndLastName(); ?></P>

            <p class="userlable">EMAIL </P>
            <P class="uservalue"><?php echo $userLoggedIn->getEmail(); ?></P>



            <div class="UserbuttonItems">
                <button class="userbuton" onclick="openPage('updateDetails.php')">Update User Info</button>
                <button class="userbuton" onclick="logout()">Log Out</button>
            </div>

        </div>



    </div>

</div>