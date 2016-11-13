<?php
include('getSession.php');

$comment       = $_POST['comment'];
$initiative_id = $_POST['initiative_id'];
$parent_id     = $_POST['parent_id']; // if parent_id is != 0, it is a sub comment

$comment = addslashes($comment); // avoid sql injection

$CURRENT_TIME = time();

// INSERT COMMENT INTO DATABASE
$query = "INSERT INTO comments ( id, initiative_id, user_id, parent_id, rank, upvotes, downvotes, netvotes, ishidden, comment, timestamp) VALUES (NULL, $initiative_id, $USER_ID, $parent_id,0,0,0,0,0, '$comment', $CURRENT_TIME)";

$addComment = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));
$comment_id = mysqli_insert_id($dbc);

// UPDATE CHILDREN ID 
$query = "INSERT INTO children_id (`index`, `parent_id`, `initiative_id`, `child_id`) VALUES (NULL, $parent_id, $initiative_id, $comment_id)";
$updateChildren = mysqli_query($dbc, $query ) or die ("Error in query: $query " . mysqli_error($dbc));

?>