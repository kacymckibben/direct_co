<?php
include('getSession.php');
$query =  "UPDATE `user` SET `isloggedin` = 0 WHERE `user`.`id` = $USER_ID";
$result = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));
session_unset ();

echo "<script>alert('You have been logged out. See you next time!');
				 window.location.href='index.php';
					</script>";
?>