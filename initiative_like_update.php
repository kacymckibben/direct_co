<?php
include('getSession.php');

$likeToggle = $_POST['likeToggle'];
$CURRENT_TIME = time();
$INITIATIVE_ID = $_SESSION['INITIATIVE_ID'];


$query = "SELECT * FROM `initiative_likes` WHERE `initiative_likes`.`initiative_id` = '$INITIATIVE_ID' AND `initiative_likes`.`user_id` = '$USER_ID'";
$result = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));

if (mysqli_num_rows($result)!=0){
	$initiativeLike = mysqli_fetch_array($result);
	$likeValue = $initiativeLike['liked'];
	if ($likeToggle == $likeValue){
		$newLikedToggle = 0; // toggle like or dislike to neutral
	}else{
		$newLikedToggle = $likeToggle; // set likeToggle to updated value (1 for like, -1 for dislike)
	}
	$query = "UPDATE initiative_likes SET liked = '$newLikedToggle' WHERE `initiative_likes`.`initiative_id` = '$INITIATIVE_ID' AND `initiative_likes`.`user_id` = '$USER_ID'";
	$updateLikedTable = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));


}else{
	$query = "INSERT INTO  `initiative_likes` ( id, initiative_id, user_id, liked, timestamp) VALUES (NULL, $INITIATIVE_ID, $USER_ID, $likeToggle,$CURRENT_TIME)";
	$updateLikedTable = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));
}
?>