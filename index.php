<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Lato:900,700,400,300,100|Merriweather:700,400,300' rel='stylesheet' type='text/css'>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Direct Colorado</title>
	<link rel="shortcut icon" href="favicon.ico?" type="image">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar">
		<div class="navbar-brand"><img src="img/logo-2.png" alt="logo" /></div>
		<ul class="nav navbar-nav navbar-right">
			<li><a class="active" href="#">Browse</a></li>
			<li><a href="#">Search</a></li>
			<li><a href="#">Start Initiative</a></li>
			<li><a href="#">Saved Initiatives</a></li><!--these are initiatives I've liked. Maybe also do one for created initatives-->
			<li><a href="#">Owned Initiatives</a></li><!--only show if user has created at least one-->
			
			<li><a href="#">Sign up</a></li>
			<li><a href="#">Login</a></li>
			
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="profile-pic" src="img/profile.png" alt="profile-pic" /> <span class="caret"></span></a>
		        <ul class="dropdown-menu">
		            <li><a href="#">Profile</a></li>
		            <li><a href="#">Notifications</a></li>
		            <li><a href="#">Logout</a></li>
		        </ul>
			</li>
			
		</ul>
	</nav>
	<div class="container">
		<div class="row">
			<form id="loginform" role="form" action="login.php" method="post">
				<fieldset class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name="uname" value="">
				</fieldset>
				<fieldset class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="uname" autocomplete="new-password" value="">
				</fieldset>
				<fieldset class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="pword" autocomplete="new-password" value="">
				</fieldset>
				<fieldset class="form-group">
					<input type="submit" class="btn btn-wide" name="login" value="LOGIN">
				</fieldset>
				<!-- <div class="border"></div>
				<fieldset class="form-group form-inline">
					<label>Don't have an account yet? </label>
					<button type="button" class="btn-link" id="switchtosignup">Sign up</button>
				</fieldset> -->
			</form>
		</div>
		<div class="row">
			<form id="signupform" role="form" action="signup.php" method="post">
				<fieldset class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name="uname" value="">
				</fieldset>
				<fieldset class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="uname" autocomplete="new-password" value="">
				</fieldset>
				<fieldset class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="pword" autocomplete="new-password" value="">
				</fieldset>
				<fieldset class="form-group">
					<input type="submit" class="btn btn-wide" name="signup" value="SIGN UP">
				</fieldset>
			</form>
		</div>
	</div>
</body>
</html>