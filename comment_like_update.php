<?php
include('getSession.php');

$likeToggle = $_POST['likeToggle'];
$comment_id = $_POST['comment_id'];
$CURRENT_TIME = time();
//$INITIATIVE_ID = $_SESSION['INITIATIVE_ID'];

// GET COMMENT INFO
$query = "SELECT * FROM `comments` WHERE `comments`.`id` = '$comment_id'";
$result = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));
$commentRow = mysqli_fetch_array($result);
$upvotes   = $commentRow['upvotes'];
$downvotes = $commentRow['downvotes'];
$netvotes  = $commentRow['netvotes'];
$newUpvotes   = $upvotes;
$newDownvotes = $downvotes;
$newNetvotes  = $netvotes;


$query = "SELECT * FROM `comment_likes` WHERE `comment_likes`.`comment_id` = '$comment_id' AND `comment_likes`.`user_id` = '$USER_ID'";
$result = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));

if (mysqli_num_rows($result)!=0){
	$commentLike = mysqli_fetch_array($result);
	$likeValue = $commentLike['liked'];
	//
	//
	// THIS ALGORITHM NEEDS FIXING. IF $likeToggle != $likeValue, WE DON'T KNOW IF IT WAS LIKED/DISLIKE OR NEUTRAL BEFORE SO WE DON'T KNOW HOW TO UPDATE DOWNVOTES/UPVOTES. NEED TO THINK ABOUT THIS.
	//
	//
	if ($likeToggle == $likeValue){
		$newLikedToggle = 0; // toggle like or dislike to neutral
		if($likeToggle==1){
			$newUpvotes   = $newUpvotes   - 1;
			$newNetvotes  = $newNetvotes  - 1;
		}else{
			$newDownvotes = $newDownvotes - 1;
			$newNetvotes  = $newNetvotes  + 1;
		}
	}else{
		$newLikedToggle = $likeToggle; // set likeToggle to updated value (1 for like, -1 for dislike)
		if($likeToggle==1){
			$newUpvotes   = $newUpvotes   + 1;
			$newNetvotes  = $newNetvotes  + 1;
		}else{
			$newDownvotes = $newDownvotes + 1;
			$newNetvotes  = $newNetvotes  - 1;
		}

	}
	//
	//
	//
	//
	//

	$query = "UPDATE comment_likes SET liked = '$newLikedToggle' WHERE `comment_likes`.`comment_id` = '$comment_id' AND `comment_likes`.`user_id` = '$USER_ID'";
	$updateLikedTable = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));


}else{
	$query = "INSERT INTO  `comment_likes` ( id, comment_id, user_id, liked, timestamp) VALUES (NULL, $comment_id, $USER_ID, $likeToggle,$CURRENT_TIME)";
	$updateLikedTable = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));

}



// UPDATE NUMBER OF LIKES FOR THE LIKED/DISLIKED COMMENT
$query = "UPDATE comments SET upvotes = '$newUpvotes' , downvotes = '$newDownvotes',  netvotes = '$newNetvotes' WHERE `comments`.`id` = '$comment_id'";
$updateComment = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));

?>