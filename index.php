<?php
include('getSession.php');
?>
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
	<script type="text/javascript" src="js_functions.js"></script>
</head>
<body>
	<nav class="navbar">
		<div class="navbar-brand"><img src="img/logo-2.png" alt="logo" /></div>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="browse.php">Browse</a></li>
			<li><a href="#">Search</a></li>
			<?php
			if($IS_LOGGED_IN){
			?>
				<li><a href="#">Create Initiative</a></li>
				<li><a href="#">Saved Initiatives</a></li><!--these are initiatives I've liked. Maybe also do one for created initatives-->
				<li><a href="#">Owned Initiatives</a></li><!--only show if user has created at least one-->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="profile-pic" src="img/profile.png" alt="profile-pic" /> <span class="caret"></span></a>
			        <ul class="dropdown-menu">
			            <li><a href="#">Profile</a></li>
			            <li><a href="#">Notifications</a></li>
			            <li><a href="logout.php">Logout</a></li>
			        </ul>
				</li>
			<?php
			}else{
			?>	
				<li><a href="#" data-toggle="modal" data-target="#signup-modal">Sign up</a></li>
				<li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
			<?php
			}
			?>
		</ul>
	</nav>
	<div class="jumbotron">
		<div class="container text-center">
			<h1 class="jumbotron-main-headline">Getting informed just got easier</h1>
			<form>
				<h3 class="jumbotron-sub-headline">Search a topic to find related initiatives to vote on:</h3>
				<input class="jumbotron-search-input" type="text" name="iniativesearch" placeholder="Search"><button class="btn btn-transparent"><i class="glyphicon glyphicon-search search-icon-white"></i></button>
			</form>
			<a class="jumbotron-link link" href="#">Learn more</a>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row row-white">
			<div class="col-md-2"></div>
			<div class="col-md-4 col-sm-6">
				<h4>Wish it was easier to learn about initiatives?</h4>
				<ul>
					<li>Quickly browse initiatives for topics that you care about</li>
					<li>Sign ballot initiatives online</li>
					<li>Participate in forums to discuss initiatives</li>
				</ul>
			</div>
			<div class="col-md-4 col-sm-6">
				<h4>Have an idea for a ballot initiative?</h4>
				<ul>
					<li>Easily create an initiative online</li>
					<li>Gather signatures electronically</li>
					<li>Track voting and comments on your initiative</li>
				</ul>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row row-color">
			<div class="col-md-4 col-sm-2"></div>
			<div class="col-md-4 col-sm-8">
				<h4 class="text-center">Sign up</h4>
				<p class="text-center">Already have an account? <a href="#" class="link" data-toggle="modal" data-target="#login-modal">Login</a></p>
				<form id="signupform" role="form" action="signup.php" method="post">
					<fieldset class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" name="username" value="">
					</fieldset>
					<fieldset class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email" autocomplete="off" value="">
					</fieldset>
					<fieldset class="form-group">
						<label>Password</label>
						<input type="password" id = "pass1" class="form-control" name="password" autocomplete="new-password" value="">
					</fieldset>
					<fieldset class="form-group">
						<label>Confirm Password</label>
						<input type="password" id="pass2" class="form-control" value="" onChange="checkPw();">
					</fieldset>
					<fieldset class="form-group">
						<input type="submit" class="btn btn-ltblue" name="signup" value="SIGN UP">
					</fieldset>
				</form>
			</div>
			<div class="col-md-4 col-sm-2"></div>	
		</div>
	</div>
	<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="loginModal">
		<div class="modal-dialog modal-sm" role="document">
		    <div class="modal-content">
		    	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel">Login</h4>
		      	</div>
		      	<div class="modal-body">
			        <form id="loginform" role="form" action="login.php" method="post">
						<fieldset class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name="username" value="">
						</fieldset>
						<fieldset class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" autocomplete="off" value="">
						</fieldset>
						<fieldset class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password" autocomplete="new-password" value="">
						</fieldset>
						<fieldset class="form-group">
							<input type="submit" class="btn" name="login" value="LOGIN">
						</fieldset>
						<!-- <div class="border"></div>
						<fieldset class="form-group form-inline">
							<label>Don't have an account yet? </label>
							<button type="button" class="btn-link" id="switchtosignup">Sign up</button>
						</fieldset> -->
					</form>
		      	</div>
		    </div>
	  	</div>
	</div>
	<div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="signupModal">
		<div class="modal-dialog modal-sm" role="document">
		    <div class="modal-content">
		    	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel">Sign up</h4>
		      	</div>
		      	<div class="modal-body">
			        <form id="signupform" role="form" action="signup.php" method="post">
						<fieldset class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name="username" value="">
						</fieldset>
						<fieldset class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" autocomplete="off" value="">
						</fieldset>
						<fieldset class="form-group">
							<label>Password</label>
							<input type="password" id = "pass1" class="form-control" name="password" autocomplete="new-password" value="">
						</fieldset>
						<fieldset class="form-group">
							<label>Confirm Password</label>
							<input type="password" id="pass2" class="form-control" value="" onChange="checkPw();">
						</fieldset>
						<fieldset class="form-group">
							<input type="submit" class="btn btn-ltblue" name="signup" value="SIGN UP">
						</fieldset>
					</form>
		      	</div>
		    </div>
	  	</div>
	</div>
</body>
</html>