<?php
include("includes/config.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");

$account = new Account($con);

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValue($name)
{
	if (isset($_POST[$name])) {
		echo $_POST[$name];
	}
}
?>


<!DOCTYPE html>
<html>

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YNG3P75VXH"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-YNG3P75VXH');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mwonya Music Accounts</title>
    <link rel="icon" href="assets/images/musiclogo.png" type="image/png">


    <link href="assets/signup/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/signup/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets/signup/css/animate.css" rel="stylesheet">
    <link href="assets/signup/css/style.css" rel="stylesheet">

    <script src="assets/signup/js/jquery-3.1.1.min.js"></script>
    <script src="assets/signup/js/register.js"></script>

</head>



<body class="gray-bg">
    <?php

	if (isset($_POST['registerButton'])) {
		echo '<script>
            $(document).ready(function() {
                $("#loginForm").hide();
                $("#registerForm").show();
            });
        </script>';
	} else {
		echo '<script>
            $(document).ready(function() {
                $("#loginForm").show();
                $("#registerForm").hide();
            });
        </script>';
	}

	?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Mwonya</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="register.php">Login</a><span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>

            </ul>
        </div>
    </nav>


    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">M</h1>
                <p>Mwonya Music</p>

            </div>
            <div id="loginForm">
                <h3>Welcome to Mwonya</h3>
                <p>Listen and Enjoy Quality Entertainment from your Favourite Artists
                </p>
                <p>Login in. To Start Listening.</p>
                <form class="m-t" role="form" action="register.php" method="POST">
                    <div class="form-group">
                        <span class="formerror"><?php echo $account->getError(Constants::$loginFailed); ?></span>
                        <input type="text" class="form-control" placeholder="Username" id="loginUsername"
                            name="loginUsername" value="<?php getInputValue('loginUsername') ?>" required
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input id="loginPassword" name="loginPassword" type="password" class="form-control"
                            placeholder="Password" required="">
                    </div>
                    <button type="submit" name="loginButton" class="btn btn-primary block full-width m-b">Login</button>

                    <a href="#"><small>Forgot password?</small></a>
                    <p class="text-muted text-center"><small>Do not have an account?</small></p>
                    <a class="btn btn-sm btn-white btn-block" id="hideLogin">Create an account</a>
                </form>
            </div>

            <div id="registerForm">
                <h3>Register to IN+</h3>
                <p>Create account to see it in action.</p>
                <form class="m-t" role="form" action="register.php" method="POST">
                    <div class="form-group">
                        <span class="formerror"><?php echo $account->getError(Constants::$usernameCharacters); ?></span>
                        <span class="formerror"><?php echo $account->getError(Constants::$usernameTaken); ?></span>
                        <input class="form-control" id="username" name="username" type="text" placeholder="Username"
                            value="<?php getInputValue('username') ?>" required>
                    </div>
                    <div class="form-group">
                        <span
                            class="formerror"><?php echo $account->getError(Constants::$firstNameCharacters); ?></span>
                        <input class="form-control" id="firstName" name="firstName" type="text" placeholder="First Name"
                            value="<?php getInputValue('firstName') ?>" required>
                    </div>
                    <div class="form-group">
                        <span class="formerror"><?php echo $account->getError(Constants::$lastNameCharacters); ?></span>
                        <input class="form-control" id="lastName" name="lastName" type="text" placeholder="Last Name"
                            value="<?php getInputValue('lastName') ?>" required>
                    </div>
                    <div class="form-group">
                        <span class="formerror"><?php echo $account->getError(Constants::$emailsDontMatch); ?></span>
                        <span class="formerror"><?php echo $account->getError(Constants::$emailInvalid); ?></span>
                        <span class="formerror"><?php echo $account->getError(Constants::$emailTaken); ?></span>
                        <input class="form-control" id="email" name="email" type="email" placeholder="Email"
                            value="<?php getInputValue('email') ?>" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="email2" name="email2" type="email" placeholder="Confirm Email"
                            value="<?php getInputValue('email2') ?>" required>
                    </div>

                    <div class="form-group">
                        <span class="formerror"><?php echo $account->getError(Constants::$passwordsDoNoMatch); ?></span>
                        <span
                            class="formerror"><?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?></span>
                        <span class="formerror"><?php echo $account->getError(Constants::$passwordCharacters); ?></span>
                        <input class="form-control" id="password" name="password" type="password" placeholder="Password"
                            required>
                    </div>

                    <div class="form-group">
                        <input class="form-control" id="password2" name="password2" type="password"
                            placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy
                            </label></div>
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b"
                        name="registerButton">Register</button>

                    <p class="text-muted text-center"><small>Already have an account?</small></p>
                    <a class="btn btn-sm btn-white btn-block" id="hideRegister">Login</a>
                </form>
            </div>

            <p class="m-t"> <small>Mwonya Music App &copy; 2020</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->

    <script src="assets/signup/js/popper.min.js"></script>
    <script src="assets/signup/js/bootstrap.js"></script>
    <!-- iCheck -->
    <script src="assets/signup/js/plugins/iCheck/icheck.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
    </script>

</body>

</html>