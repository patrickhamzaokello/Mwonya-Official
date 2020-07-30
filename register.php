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

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Mwonya Music | Login</title>

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


	<div class="middle-box text-center loginscreen animated fadeInDown">
		<div>
			<div>

				<h1 class="logo-name">IN+</h1>

			</div>
			<div id="loginForm">
				<h3>Welcome to IN+</h3>
				<p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
					<!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
				</p>
				<p>Login in. To see it in action.</p>
				<form class="m-t" role="form" action="register.php" method="POST">
					<div class="form-group">
						<?php echo $account->getError(Constants::$loginFailed); ?>
						<input type="text" class="form-control" placeholder="Username" id="loginUsername" name="loginUsername" value="<?php getInputValue('loginUsername') ?>" required autocomplete="off">
					</div>
					<div class="form-group">
						<input id="loginPassword" name="loginPassword" type="password" class="form-control" placeholder="Password" required="">
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
						<?php echo $account->getError(Constants::$usernameCharacters); ?>
						<?php echo $account->getError(Constants::$usernameTaken); ?>
						<input class="form-control" id="username" name="username" type="text" placeholder="Username" value="<?php getInputValue('username') ?>" required>
					</div>
					<div class="form-group">
						<?php echo $account->getError(Constants::$firstNameCharacters); ?>
						<input class="form-control" id="firstName" name="firstName" type="text" placeholder="First Name" value="<?php getInputValue('firstName') ?>" required>
					</div>
					<div class="form-group">
						<?php echo $account->getError(Constants::$lastNameCharacters); ?>
						<input class="form-control" id="lastName" name="lastName" type="text" placeholder="Last Name" value="<?php getInputValue('lastName') ?>" required>
					</div>
					<div class="form-group">
						<?php echo $account->getError(Constants::$emailsDontMatch); ?>
						<?php echo $account->getError(Constants::$emailInvalid); ?>
						<?php echo $account->getError(Constants::$emailTaken); ?>
						<input class="form-control" id="email" name="email" type="email" placeholder="Email" value="<?php getInputValue('email') ?>" required>
					</div>
					<div class="form-group">
						<input class="form-control" id="email2" name="email2" type="email" placeholder="Confirm Email" value="<?php getInputValue('email2') ?>" required>
					</div>

					<div class="form-group">
						<?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
						<?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
						<?php echo $account->getError(Constants::$passwordCharacters); ?>
						<input class="form-control" id="password" name="password" type="password" placeholder="Password" required>
					</div>

					<div class="form-group">
						<input class="form-control" id="password2" name="password2" type="password" placeholder="Confirm Password" required>
					</div>
					<div class="form-group">
						<div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
					</div>
					<button type="submit" class="btn btn-primary block full-width m-b" name="registerButton">Register</button>

					<p class="text-muted text-center"><small>Already have an account?</small></p>
					<a class="btn btn-sm btn-white btn-block" id="hideRegister">Login</a>
				</form>
			</div>

			<p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
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