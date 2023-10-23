<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image/x-icon" href="images/divine_logo.png" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
	<title>DWCL - Queueing System</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<link rel="stylesheet" href="css/login.css">
</head>
<body>  
    <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>

    <div class="container">
	<img src="images/divine_logo.png" alt="">
		<div class="screen">
			<div class="screen__content">
				<form class="login" method="POST" action="function/login.php">
					<div class="login__field">
						<i class="login__icon fas fa-user"></i>
						<input type="text" class="login__input" placeholder="Username" id="username" name="username" required>
					</div>
					<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
						<input type="password" class="login__input" placeholder="Password" id="password" name="password" required>
					</div>
					<button class="button login__submit" value="Login">
						<span class="button__text">Log In Now</span>
						<i class="button__icon fas fa-chevron-right"></i>
					</button>				
				</form>
			</div>
			<div class="screen__background">
				<span class="screen__background__shape screen__background__shape4"></span>
				<span class="screen__background__shape screen__background__shape3"></span>		
				<span class="screen__background__shape screen__background__shape2"></span>
				<span class="screen__background__shape screen__background__shape1"></span>
			</div>		
		</div>
	</div>

</body>
</html>
