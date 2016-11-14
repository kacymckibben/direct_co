<?php
include('getSession.php');
$FLAG_THRESHOLD = 3;

$comment_id = $_POST['comment_id'];
$CURRENT_TIME = time();


// GET INFORMATION ON USER'S FLAG OF COMMENT
$query = "SELECT * FROM `comment_flags` WHERE `comment_flags`.`comment_id` = '$comment_id' AND `comment_flags`.`user_id` = '$USER_ID'";
$result = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));

if (mysqli_num_rows($result)!=0){
	$commentFlag = mysqli_fetch_array($result);
	$flagValueWas = $commentFlag['flagged'];

	if($flagValueWas==0){ // WAS NOT FLAGGED
		$newFlagToggle = 1;
	}elseif($flagValueWas==1){ // WAS FLAGGED
		$newFlagToggle = 0;	
	}
	$query = "UPDATE `comment_flags` SET `comment_flags`.`flagged` = $newFlagToggle WHERE `comment_flags`.`comment_id` = '$comment_id' AND `comment_flags`.`user_id` = '$USER_ID'";
	$updateFlaggedTable = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));

}else{
	$query = "INSERT INTO  `comment_flags` ( id, comment_id, user_id, flagged, timestamp) VALUES (NULL, $comment_id, $USER_ID, '1',$CURRENT_TIME)";
	$updateFlaggedTable = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));
}


// GET COMMENT FLAG INFO
$query = "SELECT * FROM `comment_flags` WHERE `comment_flags`.`comment_id` = '$comment_id'";
$result = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));
$nFlags = mysqli_num_rows($result);
if($nFlags >= $FLAG_THRESHOLD){
	$query = "UPDATE comments SET ishidden = 1 WHERE `comments`.`id` = '$comment_id'";
	$updateFlag = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));
}else{
	$query = "UPDATE comments SET ishidden = 0 WHERE `comments`.`id` = '$comment_id'";
	$updateFlag = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));
}

