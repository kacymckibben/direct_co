<?php
include('getSession.php');

$likeToggle = $_POST['likeToggle'];
$CURRENT_TIME = time();
if(isset($_POST['initiative_id']) && !empty($_POST['initiative_id'])){
	$INITIATIVE_ID = $_POST['initiative_id']; // INITIATIVE IS BEING LIKED FROM BROWSE PAGE
}else{
	$INITIATIVE_ID = $_SESSION['INITIATIVE_ID']; // INITIATIVE IS BEING LIKED FROM INITIATIVE PAGE
}



// GET INITIATIVE INFO
$query = "SELECT * FROM `initiative` WHERE `initiative`.`id` = '$INITIATIVE_ID'";
$result = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));
$initiativeRow = mysqli_fetch_array($result);
$upvotes   = $initiativeRow['upvotes'];
$downvotes = $initiativeRow['downvotes'];
$netvotes  = $initiativeRow['netvotes'];
$newUpvotes   = $upvotes;
$newDownvotes = $downvotes;
$newNetvotes  = $netvotes;


// GET INFORMATION ON USER'S LIKE/DISLIKES OF INITIATIVE
$query = "SELECT * FROM `initiative_likes` WHERE `initiative_likes`.`initiative_id` = '$INITIATIVE_ID' AND `initiative_likes`.`user_id` = '$USER_ID'";
$result = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));

if (mysqli_num_rows($result)!=0){
	$initiativeLike = mysqli_fetch_array($result);
	$likeValueWas = $initiativeLike['liked'];

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

	$query = "UPDATE initiative_likes SET liked = '$newLikedToggle' WHERE `initiative_likes`.`initiative_id` = '$INITIATIVE_ID' AND `initiative_likes`.`user_id` = '$USER_ID'";
	$updateLikedTable = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));


}else{
	$query = "INSERT INTO  `initiative_likes` ( id, initiative_id, user_id, liked, timestamp) VALUES (NULL, $INITIATIVE_ID, $USER_ID, $likeToggle,$CURRENT_TIME)";
	$updateLikedTable = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));
	if($likeToggle == 1){ // LIKED
		$newUpvotes    = $newUpvotes    + 1;
		$newNetvotes   = $newNetvotes   + 1;
	}elseif($likeToggle == -1){ // DISLIKED
		$newDownvotes  = $newDownvotes  + 1;
		$newNetvotes   = $newNetvotes   - 1;
	}
}


// UPDATE NUMBER OF LIKES FOR THE LIKED/DISLIKED INITIATIVE
$query = "UPDATE initiative SET upvotes = '$newUpvotes' , downvotes = '$newDownvotes',  netvotes = '$newNetvotes' WHERE `initiative`.`id` = '$INITIATIVE_ID'";
$updateInitiative = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));


// PASS JSON DATA OF UPDATED [UPVOTES DOWNVOTES NETVOTES INITIATIVE_ID]
$returnData[] = $newUpvotes;
$returnData[] = $newDownvotes;
$returnData[] = $newNetvotes;
$returnData[] = $INITIATIVE_ID;
echo json_encode($returnData);
?>