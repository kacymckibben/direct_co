<?php
include('getSession.php');

$likeToggle = $_POST['likeToggle'];
$comment_id = $_POST['comment_id'];
$CURRENT_TIME = time();


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


// GET INFORMATION ON USER'S LIKE/DISLIKES OF COMMENT
$query = "SELECT * FROM `comment_likes` WHERE `comment_likes`.`comment_id` = '$comment_id' AND `comment_likes`.`user_id` = '$USER_ID'";
$result = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));

if (mysqli_num_rows($result)!=0){
	$commentLike = mysqli_fetch_array($result);
	$likeValueWas = $commentLike['liked'];

	if($likeValueWas==0){ // WAS NEUTRAL
		if($likeToggle==1){ // LIKED
			$newUpvotes  = $newUpvotes  + 1;
			$newNetvotes = $newNetvotes + 1;
		}else{ // DISLIKED
			$newDownvotes  = $newDownvotes  + 1;
			$newNetvotes   = $newNetvotes   - 1;
		}
		$newLikedToggle = $likeToggle;
	}elseif($likeValueWas==1){ // WAS LIKED
		if($likeToggle==1){ // UNLIKED
			$newUpvotes  = $newUpvotes  - 1;
			$newNetvotes = $newNetvotes - 1;
			$newLikedToggle = 0;
		}else{ // DISLIKED (FROM LIKED)
			$newUpvotes    = $newUpvotes    - 1;
			$newDownvotes  = $newDownvotes  + 1;
			$newNetvotes   = $newNetvotes   - 2;
			$newLikedToggle = -1;
		}		
	}else{ // WAS DISLIKED
		if($likeToggle==1){ // LIKED (FROM DISLIKE)
			$newUpvotes    = $newUpvotes    + 1;
			$newDownvotes  = $newDownvotes  - 1;
			$newNetvotes   = $newNetvotes   + 2;
			$newLikedToggle = 1;
		}else{ // UNDISLIKED 
			$newDownvotes  = $newDownvotes  - 1;
			$newNetvotes   = $newNetvotes   + 1;
			$newLikedToggle = 0;
		}			
	}

	$query = "UPDATE comment_likes SET liked = '$newLikedToggle' WHERE `comment_likes`.`comment_id` = '$comment_id' AND `comment_likes`.`user_id` = '$USER_ID'";
	$updateLikedTable = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));


}else{
	$query = "INSERT INTO  `comment_likes` ( id, comment_id, user_id, liked, timestamp) VALUES (NULL, $comment_id, $USER_ID, $likeToggle,$CURRENT_TIME)";
	$updateLikedTable = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));
	if($likeToggle == 1){ // LIKED
		$newUpvotes    = $newUpvotes    + 1;
		$newNetvotes   = $newNetvotes   + 1;
	}elseif($likeToggle == -1){ // DISLIKED
		$newDownvotes  = $newDownvotes  + 1;
		$newNetvotes   = $newNetvotes   - 1;
	}

}


// UPDATE NUMBER OF LIKES FOR THE LIKED/DISLIKED COMMENT
$query = "UPDATE comments SET upvotes = '$newUpvotes' , downvotes = '$newDownvotes',  netvotes = '$newNetvotes' WHERE `comments`.`id` = '$comment_id'";
$updateComment = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));

?>