<?php
/* signup.php:
	will add user to database with the following credentials from $_POST:
		username
		email
		password
	Checks to see if the user exists
	Checks to see if password matches confirmation password
	It will then redirect to the 'initiative' page

	Jake Turelli
	Sept 11, 2016
*/
require_once('../includes/connection.php');
session_start();
session_unset ();
$CURRENT_TIME = time(); // get current time

$username  = $_POST['username'];
$email     = $_POST['email'];
$password  = $_POST['password'];

// THROW ALERT ERROR IF USERNAME INCLUDES SPECIAL CHARACTERS
$SPECIAL_CHARACTERS = "/[\'^£$%&*()}{#~?><>,|=_+¬-]/";
if(preg_match($SPECIAL_CHARACTERS, $username) ){
	echo "<script>alert('No special characters.');
				 window.location.href='index.php';
					</script>";
}


if($_POST['signup']) {
	$query = "SELECT * FROM `user` WHERE `username` LIKE '$username'";
	$checkUsername = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));

	$query = "SELECT * FROM `user` WHERE `email` LIKE '$email'";
	$checkEmail = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));

	// CHECK IF USERNAME EXISTS
	if (mysqli_num_rows($checkUsername)!=0){
		echo "<script>alert('Username already exists.');
				 window.location.href='index.php';
					</script>";
	// CHECK IF EMAIL HAS BEEN USED
	}elseif(mysqli_num_rows($checkEmail)!=0){
		echo "<script>alert('This email already in use.');
				 window.location.href='index.php';
					</script>";
	// USERNAME AND EMAIL ARE FREE, SIGN USER UP
	}else{
		// HASH PASSWORD
		$pswd_hash = password_hash($password, PASSWORD_DEFAULT);
		$query = "INSERT INTO `user` (`id`, `username`, `email`,`password`, `creation_time`, `isloggedin`) VALUES (NULL, '$username', '$email', '$pswd_hash', $CURRENT_TIME, 1 )";

		// ADD USER
		$addUser = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));

		$id = mysqli_insert_id($dbc); // USER IS LATEST INSERTED 

		// UPDATE SESSION VARIABLES WITH USER DATA
		$_SESSION['USER_ID']      = $id;
		$_SESSION['USERNAME']     = $username;
		$_SESSION['IS_LOGGED_IN'] = true;

		// REDIRECT TO INITIATIVE PAGE
		echo "<script>alert('Welcome to Direct Colorado!');
				 window.location.href='initiative.html';
					</script>";
	}
	
}else{
	// ERROR: NO SIGNUP WAS PASSED BY $_POST
	echo "<script>alert('How did you get here?');
				 window.location.href='index.php';
					</script>";
}
?>
