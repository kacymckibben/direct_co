<?php
// UPDATE $_SESSION VARIABLE INITIATIVE_ID
$_SESSION['INITIATIVE_ID'] = $INITIATIVE_ID;


// LOAD INITIATIVE 
$query = "SELECT * FROM initiative WHERE id = $INITIATIVE_ID";
$initiativeQuery = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));
$INITIATIVE = mysqli_fetch_array($initiativeQuery);

// LOAD CREATOR OF INITIATIVE
$creator_id = $INITIATIVE['creator_id'];
$query = "SELECT * FROM user WHERE id = $creator_id";
$creatorQuery = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));
$CREATOR = mysqli_fetch_array($creatorQuery);

// LOAD COMMENTS
$query = "SELECT * FROM `comments` WHERE `comments`.`initiative_id` = $INITIATIVE_ID ORDER BY upvotes DESC";
$commmentQuery = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));
$COMMENTS = array();
while ($row = mysqli_fetch_array($commmentQuery, MYSQLI_ASSOC)) {
	$ind =  $row['id'];
	$COMMENTS[$ind]['id']            = $row['id'];           
	$COMMENTS[$ind]['initiative_id'] = $row['initiative_id'];
	$COMMENTS[$ind]['user_id']       = $row['user_id'];      
	//$COMMENTS[$ind]['user_name']     = $row['user_name'];    
	$COMMENTS[$ind]['parent_id']     = $row['parent_id'];   
	$COMMENTS[$ind]['rank']          = $row['rank'];         
	$COMMENTS[$ind]['upvotes']       = $row['upvotes'] ;     
	$COMMENTS[$ind]['downvotes']     = $row['downvotes'];    
	$COMMENTS[$ind]['netvotes']      = $row['netvotes'];    
	$COMMENTS[$ind]['ishidden']      = $row['ishidden'];     
	$COMMENTS[$ind]['comment']       = $row['comment']; 
	$COMMENTS[$ind]['timestamp']     = $row['timestamp'];

}
// LOAD COMMENT INDICES
$query = "SELECT * FROM children_id WHERE initiative_id = $INITIATIVE_ID";
$childrenIndQuery = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));
$CHILDREN_INDEX = array();
while ($row = mysqli_fetch_array($childrenIndQuery, MYSQLI_ASSOC)) {
	$ind =  $row['index'];
	$CHILDREN_INDEX[$ind]['index']         = $row['index'];     
	$CHILDREN_INDEX[$ind]['parent_id']     = $row['parent_id'];       
	$CHILDREN_INDEX[$ind]['initiative_id'] = $row['initiative_id'];
	$CHILDREN_INDEX[$ind]['child_id']      = $row['child_id'];    
}

?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Direct Colorado</title>
	<link rel="shortcut icon" href="favicon.ico?" type="image">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<!--<script type="text/javascript" src="bootstrap.min.js"></script>-->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js_functions.js"></script>
</head>
<body>
	<nav class="navbar">
		<a href="index.php" class="navbar-brand"><img src="img/logo-2.png" alt="logo" /></a>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="browse.php">Browse</a></li>
			<li><a href="#">Search</a></li>
			<?php
			if($IS_LOGGED_IN){
			?>
				<li><a href="create_initiative.html">Create Initiative</a></li>
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
	<nav class="navbar secondary-navbar">
		<ul class="nav navbar-nav">
			<li><a class="bold-text" href="#"><span class="glyphicon glyphicon-chevron-left"></span> Back</a></li>
			<li class="text">More initiatives:</li>
			<li><a class="bold-text" href="#">Tagged with blah</a></li>
			<li><a class="bold-text" href="#">From username</a></li>
			<li><a class="bold-text" href="#">Around Abc City, CO</a></li>
		</ul>
	</nav>
	<div class="container">
		<div class="initiative">
			<div class="row">
				<div class="col-sm-2">
				<?php
				// QUERY WHETHER USER LIKED/DISLIKED INITIATIVE. THIS WILL UPDATE THE THUMBS UP/DOWN TOGGLE. 
				$query = "SELECT * FROM `initiative_likes` WHERE `initiative_likes`.`initiative_id` = '$INITIATIVE_ID' AND `initiative_likes`.`user_id` = '$USER_ID'";
				$result = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));
				if (mysqli_num_rows($result)!=0){
					$initiativeLike = mysqli_fetch_array($result);
					$initiativeLikeValue = $initiativeLike['liked'];
					if($initiativeLikeValue == 1){ //LIKED
						$initiativeLikeClass    = '"glyphicon glyphicon-thumbs-up tst"';
						$initiativeDislikeClass = '"glyphicon glyphicon-thumbs-down"';
					}elseif($initiativeLikeValue == -1){ //DISLIKED
						$initiativeLikeClass    = '"glyphicon glyphicon-thumbs-up"';
						$initiativeDislikeClass = '"glyphicon glyphicon-thumbs-down tst"';
					}else{ // NEITHER LIKED NOR DISLIKED
						$initiativeLikeClass    = '"glyphicon glyphicon-thumbs-up"';
						$initiativeDislikeClass = '"glyphicon glyphicon-thumbs-down"';
					}
				}else{ // NEITHER LIKED NOR DISLIKED
					$initiativeLikeClass    = '"glyphicon glyphicon-thumbs-up"';
					$initiativeDislikeClass = '"glyphicon glyphicon-thumbs-down"';
				}
				?>
					<a href="#"><span id="liked" class=<?php echo $initiativeLikeClass;?>> <span class="like-font"><?php echo $INITIATIVE['upvotes'];?> Likes</span></span></a>
					<br>
					<a href="#"><span id="disliked" class=<?php echo $initiativeDislikeClass;?>> <span class="like-font"><?php echo $INITIATIVE['downvotes'];?> Dislikes</span></span></a>
					<p><span id="total">Total <?php echo $INITIATIVE['netvotes'];?></span></p>
				</div>
				<div class="col-sm-10">
					<small><?php echo $CREATOR['username'];?></small><small><?php echo date('Y-m-d h:i:s',$INITIATIVE['creation_time']);?></small>
					<h4><?php echo $INITIATIVE['title'];?></h4><a class="initiative-website" href="#"><?php echo $INITIATIVE['www'];?></a>
					<p><?php echo $INITIATIVE['description'];?></p><br>
					
					<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
					<a href="#" class="share" data-toggle="popover" data-trigger="focus"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></a>
					<form name = <?php echo '"' . $INITIATIVE_ID . '"';?> id= "0">
		                <div class="form-group">
		                    <label for="comment">Your Comment</label>
		                    <textarea name="comment" class="form-control" rows="2"></textarea>
		                </div>
		                <button type="submit" class="btn btn-ltblue" onClick="submitComment(this.form)">Save</button>
	                </form>
					<!-- <br>
					<div class="pull-right"> 
						<a id="expandAll" href="#">Expand/Collapse All</a>
	            	</div> -->
				</div>
			</div>
		</div>

		<?php
		$depth = 1; // comment level starts at 1 (for proper css indentations)

		// LEVEL 0 COMMENTS (NO PARENTS) (depth = 1 (for proper css))
		$parentID = 0;
		$childrenArray = getChildrenArray($dbc, $parentID, $INITIATIVE_ID);
		if(!empty($childrenArray)){
			$childrenArray = getChildrenArray($dbc,$parentID, $INITIATIVE_ID);
			displayChildren($COMMENTS, $INITIATIVE_ID, $USER_ID, $childrenArray, $dbc , $depth);
		}



		function getChildrenArray($dbc, $parentID, $INITIATIVE_ID){
			// Returns an array of a parent's children comments ($childrenArray)
			// $parentID : parent id for which to get children comments
			$query = "SELECT * FROM comments WHERE parent_id = $parentID AND initiative_id = $INITIATIVE_ID ORDER BY upvotes DESC";
			$childrenQuery = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));
			$childrenArray = array();
			while ($comment = mysqli_fetch_array($childrenQuery, MYSQLI_ASSOC)) {
				array_push($childrenArray, $comment);
			}
			return $childrenArray;
		}

		function displayChildren($COMMENTS, $INITIATIVE_ID, $USER_ID, $childrenArray, $dbc , $depth){
			// Recursive function that displays all children comments (and recursive subsequent children)
			// $COMMENTS : Array of all comments for initiative (queried at beginning of page)
			// $INITIATIVE_ID: Initiative ID
			// $USER_ID: User ID
			// $childrenArray : Array of children for current comment
			// $dbc : database connection
			// $depth : level of comments deep. 1 for first-level comments 
			$commentClassString = '"comment-' . $depth . '"' ; // "comment-2" e.g. (comment indentation)
			foreach($childrenArray as $childArray){
				$commentor_id = $childArray['user_id'];
				$query = "SELECT * FROM user WHERE id = $commentor_id";
				$commentorQuery = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));
				$commentor = mysqli_fetch_array($commentorQuery);

				$comment_id = $childArray['id'];
				$commentReply = 'reply' . $comment_id ;
				?>
					<div id=<?php echo '"' . $comment_id . '"' ;?> class= <?php echo $commentClassString;?> >
						<div class="row">
							<div class="vote col-sm-2 text-center">
								<?php
								// QUERY WHETHER USER LIKED/DISLIKED COMMENT. THIS WILL UPDATE THE CHEVRON UP/DOWN TOGGLE. 
								$query = "SELECT * FROM `comment_likes` WHERE `comment_likes`.`comment_id` = '$comment_id' AND `comment_likes`.`user_id` = '$USER_ID'";
								$commentLikeResult = mysqli_query($dbc, $query) or die ("Error in query: $query " . mysqli_error($dbc));
								if (mysqli_num_rows($commentLikeResult)!=0){
									$commentLike = mysqli_fetch_array($commentLikeResult);
									$commentLikeValue = $commentLike['liked'];
									if($commentLikeValue == 1){ //LIKED
										$commentLikeClass    = '"glyphicon glyphicon-chevron-up tst"';
										$commentDislikeClass = '"glyphicon glyphicon-chevron-down"';
									}elseif($commentLikeValue == -1){ //DISLIKED
										$commentLikeClass    = '"glyphicon glyphicon-chevron-up"';
										$commentDislikeClass = '"glyphicon glyphicon-chevron-down tst"';
									}else{ // NEITHER LIKED NOR DISLIKED
										$commentLikeClass    = '"glyphicon glyphicon-chevron-up"';
										$commentDislikeClass = '"glyphicon glyphicon-chevron-down"';
									}
								}else{ // NEITHER LIKED NOR DISLIKED
									$commentLikeClass    = '"glyphicon glyphicon-chevron-up"';
									$commentDislikeClass = '"glyphicon glyphicon-chevron-down"';
								}
								?>
								<div class="like" ><span id=<?php echo '"upvoted' . $comment_id . '"';?> class=<?php echo $commentLikeClass;?> aria-hidden="true"></span></div>
								<span class="net-text" id=<?php echo '"netvoted'.$comment_id.'"';?>>Net <?php echo $childArray['netvotes'];?></span>
								<div class="dislike" ><span id=<?php echo '"downvoted' . $comment_id . '"';?> class=<?php echo $commentDislikeClass;?>></span></div>
							</div>
							<div class="col-sm-10">
								<small><?php echo $commentor['username'];?> </small><small><?php echo date('Y-m-d h:i:s',$childArray['timestamp']);?></small>
								<p><?php echo $childArray['comment'];?></p>
								<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
								<a href="#"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></a>
								<span>
			                        <a role="button" data-toggle="collapse" href= <?php echo '"#' . $commentReply . '"' ;?> aria-expanded="false" aria-controls=<?php echo '"' . $commentReply . '"' ;?>>Reply</a>
			                    </span>
					            <div class="collapse" id=<?php echo '"' . $commentReply . '"' ;?>>
					                <form name = <?php echo '"' . $INITIATIVE_ID . '"';?> id= <?php echo '"' . $comment_id . '"';?>>
						                <div class="form-group">
						                    <label for="comment">Your Comment</label>
						                    <textarea name="comment" class="form-control" rows="2"></textarea>
						                </div>
						                <button type="submit" class="btn btn-ltblue" onClick="submitComment(this.form)">Save</button>
					                </form>
					            </div>
								<?php 
								$nestedChildrenComments = getChildrenArray($dbc, $comment_id, $INITIATIVE_ID);
								if(!empty($nestedChildrenComments)){
									$href = 'collapse' . $comment_id; 
									$numChildren = count($nestedChildrenComments);
								?>
									<br>
									<a class="collapse-comment" data-toggle="collapse" href=<?php echo '"#' . $href . '"';?> aria-expanded="true" aria-controls="collapseExample"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> <?php echo $numChildren;?> comments</a>
								<?php
								}
								?>
								
							</div>
						</div>
					</div>
					<?php
					// DISPLAY ALL NESTED CHILDREN COMMENTS (CALL RECURSIVELY TO displayChildren())
					if(!empty($nestedChildrenComments)){
					?>
					<div class="all-children-comments">
						<div class = "panel-collapse collapse in" id = <?php echo '"' . $href . '"';?> aria-expanded="true">
						<?php
						displayChildren($COMMENTS, $INITIATIVE_ID, $USER_ID, $nestedChildrenComments, $dbc, $depth+1);
						?>
						</div>
					</div>
					<?php
					}
				}	
			}
		?>
		<?php
		include('login_signup_modal_content.html');
		?>
	</div>

	<script type="text/javascript">
		$(function () {			
            $('a[data-toggle="collapse"]').on('click',function() {
				var objectID=$(this).attr('href');
				if($(objectID).hasClass('in')) {
                	$(objectID).collapse('hide');
				}
				else {
            		$(objectID).collapse('show');
				}
        	});
                    
            // $('#expandAll').on('click',function() {
            // 	$('.all-children-comments .panel-collapse').collapse("toggle");
            // 	var elements = document.getElementsByClassName('glyphicon');
            // 	for (var i = 0; i < elements.length; i++) {
            // 		if (elements[i].classList.contains('glyphicon-plus')) {
            // 			elements[i].classList.add('glyphicon-minus');
            // 			elements[i].classList.remove('glyphicon-plus');
            // 		}
            // 		else if (elements[i].classList.contains('glyphicon-minus')) {
            // 			elements[i].classList.add('glyphicon-plus');
            // 			elements[i].classList.remove('glyphicon-minus');
            // 		}
            // 	}
            // })
		});

	$('[data-toggle="collapse"]').on('click', function() {
    	var $this = $(this),
        $parent = typeof $this.data('parent')!== 'undefined' ? $($this.data('parent')) : undefined;

	    var currentIcon = $this.find('.glyphicon');
	    currentIcon.toggleClass('glyphicon-plus glyphicon-minus');
	    $parent.find('.glyphicon').not(currentIcon).removeClass('glyphicon-minus').addClass('glyphicon-plus');

	});
	$(document).ready(function(){
		var popcontent = '<span class="glyphicon glyphicon-envelope"></span><i class="fa fa-twitter" aria-hidden="true"></i><i class="fa fa-facebook" aria-hidden="true"></i><i class="fa fa-reddit" aria-hidden="true"></i>';
		$(".share").popover({animation:true, content:popcontent, html:true});
    	$('[data-toggle="popover"]').popover(); 
	});
	$(".glyphicon").click(function () {
	    var obj = $(this);
	    if ($(this).hasClass('glyphicon-thumbs-up')) {
	    	obj.toggleClass("tst");

	    	$.ajax({
				type: "POST",
				url: "initiative_like_update.php",
				data: { likeToggle: 1,
					   },
				dataType: 'json',
				success: function(likeData){
					// likeData is an array of numbers: 
					// [upvotes downvotes netvotes initiative_id] 
					upVotesString   = ' <span class="like-font">'+likeData[0]+ ' Likes</span>';
					downVotesString = ' <span class="like-font">'+likeData[1]+ ' Dislikes</span>';
					netVotesString  = 'Total ' + likeData[2];
					$('#liked').html(upVotesString);
					$('#disliked').html(downVotesString);
					$('#total').html(netVotesString);
				},
			});
	    
	        if (document.getElementById("disliked").classList.contains('tst')) {
	        	var disliked = document.getElementById("disliked");
	        	$(disliked).removeClass("tst");
	        }
	    }
	    else if($(this).hasClass('glyphicon-thumbs-down')) {
			obj.toggleClass("tst");

	    	$.ajax({
				type: "POST",
				url: "initiative_like_update.php",
				data: { likeToggle: -1,
					   },
				dataType: 'json',
				success: function(likeData){
					// likeData is an array of numbers: 
					// [upvotes downvotes netvotes initiative_id]
					upVotesString   = ' <span class="like-font">'+likeData[0]+ ' Likes</span>';
					downVotesString = ' <span class="like-font">'+likeData[1]+ ' Dislikes</span>';
					netVotesString  = 'Total ' + likeData[2];
					$('#liked').html(upVotesString);
					$('#disliked').html(downVotesString);
					$('#total').html(netVotesString);
				},
			});
		
			if (document.getElementById("liked").classList.contains('tst')) {
				var liked = document.getElementById("liked");
				$(liked).removeClass("tst");
			}
	    } 
	    else if ($(this).hasClass('glyphicon-chevron-up')) {
	    	obj.toggleClass("tst");
	    	var par_id = $(this).parent().parent().parent().parent().attr('id');

	    	$.ajax({
				type: "POST",
				url: "comment_like_update.php",
				data: { likeToggle: 1,
					    comment_id: par_id,
					   },
				dataType: 'json',
				success: function(likeData){
					// likeData is an array of 2 numbers: 
					// [netvotes, comment_id]
					netVotedString  = 'Net ' + likeData[0];
					$('#netvoted' + likeData[1]).html(netVotedString);
				},
			});

	    	if (document.getElementById("downvoted" + par_id).classList.contains('tst')) {
				var downvoted = document.getElementById("downvoted" + par_id);
				$(downvoted).removeClass("tst");
			}
	    }
	    else if ($(this).hasClass('glyphicon-chevron-down')) {
	    	obj.toggleClass("tst");
	    	var par_id = $(this).parent().parent().parent().parent().attr('id');

	    	$.ajax({
				type: "POST",
				url: "comment_like_update.php",
				data: { likeToggle: -1,
					    comment_id: par_id,
					   },
				dataType: 'json',
				success: function(likeData){
					// likeData is an array of 3 numbers: 
					// [upvotes downvotes netvotes]
					netVotedString  = 'Net ' + likeData[0];
					$('#netvoted' + likeData[1]).html(netVotedString);
				},
			});

	    	if (document.getElementById("upvoted" + par_id).classList.contains('tst')) {
				var upvoted = document.getElementById("upvoted" + par_id);
				$(upvoted).removeClass("tst");
			}
	    }
	})
	$(".glyphicon-bookmark").click(function () {
		var obj = $(this);
		obj.toggleClass("marked");
	})
	</script>

	<script>
	function submitComment(form)
	{
		// INITIATIVE ID IS PASSED VIA FORM.NAME
		// PARENT ID IS PASSED VIA FORM.ID
		// COMMENT IS PASSED BY FORM.COMMENT.VALUE

		if(form.comment.value === ''){
				return;
		}else{
			var comment = form.comment.value;
			form.comment.value = '';
			var initiative = form.name; 
			var parent = form.id;

			$.ajax({
				type: "POST",
				url: "comment_update.php",
				data: { comment:    	comment,
						initiative_id: 	initiative, 
					    parent_id:  	parent,
					   }
				//success: function(msg){
					//
				//}
			});
		}
	}
	</script>

</body>
</html>