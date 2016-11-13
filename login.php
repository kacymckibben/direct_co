<?php
/* login.php:
	will login user with the following credentials from $_POST:
		username
		email
		password
	Checks to see if the user exists
	Checks to see if password matches password passed to the
	It will then redirect to the 'initiative' page

	Jake Turelli
	Sept 11, 2016
*/
require_once( '../includes/connection.php');
session_start();
session_unset ();

$username  = $_POST['username'];
$email     = $_POST['email'];
$password  = $_POST['password'];
$CURRENT_PAGE = $_SESSION['CURRENT_PAGE'];

// THROW ALERT ERROR IF USERNAME INCLUDES SPECIAL CHARACTERS
$SPECIAL_CHARACTERS = "/[\'^£$%&*()}{#~?><>,|=_+¬-]/";
if(preg_match($SPECIAL_CHARACTERS, $username) ){
	echo "<script>alert('No special characters allowed.');
				 window.location.href='index.php';
					</script>";
}


if($_POST['login']) {
	$query = "SELECT * FROM `user` WHERE `username` LIKE '$username'";
	$result = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));
	
	// IF USERNAME IS VALID, CHECK PASSWORD
	if (mysqli_num_rows($result)!=0){
		$user = mysqli_fetch_array($result);
		$pswd_hash2compare = $user['password'];

		// IF PASSWORD MATCHES, LOG USER IN
		if(password_verify($password,$pswd_hash2compare )){
			$user_id = $user['id'];

			// UPDATE SESSION VARIABLES
			$_SESSION['IS_LOGGED_IN'] = TRUE;
			$_SESSION['USER_ID'] =  $user_id;
			$_SESSION['USERNAME'] = $user['username'];

			// UPDATE USER LOGGED IN STATUS ON THE DATABASE
			$query =  "UPDATE `user` SET `isloggedin` = 1 WHERE `user`.`id` = $user_id";
			$result = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));

			// WELCOME USER AND REDIRECT TO INITIATIVE PAGE
			echo '<script>window.location.href=' . $CURRENT_PAGE .  ';</script>';
		}else{
			// ERROR: INCORRECT PASSWORD
			echo "<script>alert('Password incorrect.');
				 window.location.href='index.php';
					</script>";
		}

	}else{
		// ERROR: INVALID USERNAME
		echo "<script>alert('Invalid username.');
				 window.location.href='index.php';
					</script>";
	}
} else {
	// ERROR: NO LOGIN WAS PASSED BY $_POST
	echo "<script>alert('How did you get here?.');
				 window.location.href='index.php';
					</script>";

}

?>