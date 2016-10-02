<?php
include('getSession.php');

$INITIATIVE_ID = 1; // This might be autogenerated upon initiative page creation

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
$query = "SELECT * FROM comments WHERE initiative_id = $INITIATIVE_ID ORDER BY netvotes DESC";
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
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Direct Colorado</title>
	<link rel="shortcut icon" href="favicon.ico?" type="image">
	<!--<link rel="stylesheet" href="bootstrap.min.css">-->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<!--<script type="text/javascript" src="bootstrap.min.js"></script>-->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js_functions.js"></script>
</head>
<body>
	<nav class="navbar">
		<div class="navbar-brand"><img src="img/logo-2.png" alt="logo" /></div>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="browse.html">Browse</a></li>
			<li><a href="#">Search</a></li>
			<?php
			if($IS_LOGGED_IN){
			?>
				<li><a href="#">Start Initiative</a></li>
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
				<li><a href="#">Sign up</a></li>
				<li><a href="#">Login</a></li>
			<?php
			}
			?>
		</ul>
	</nav>
	<nav class="navbar secondary-navbar">
		<ul class="nav navbar-nav">
			<li><a href="#">Back</a></li>
			<li class="text">More initiatives:</li>
			<li><a href="#">Tagged with blah</a></li>
			<li><a href="#">From username</a></li>
			<li><a href="#">Around Abc City, CO</a></li>
		</ul>
	</nav>
	<div class="container">

		<div class="initiative">
			<div class="row">
				<div class="col-sm-2">
					<a href="#"><span id="liked" class="glyphicon glyphicon-thumbs-up"> <span class="like-font"><?php echo $INITIATIVE['upvotes'];?> Likes</span></span></a>
					<br>
					<a href="#"><span id="disliked" class="glyphicon glyphicon-thumbs-down"> <span class="like-font"><?php echo $INITIATIVE['downvotes'];?> Dislikes</span></span></a>
					<p>Total <?php echo $INITIATIVE['netvotes'];?></p>
				</div>
				<div class="col-sm-10">
					<small><?php echo $CREATOR['username'];?></small><small><?php echo date('Y-m-d h:i:s',$INITIATIVE['creation_time']);?></small>
					<h4><?php echo $INITIATIVE['title'];?></h4><a class="initiative-website" href="#"><?php echo $INITIATIVE['www'];?></a>
					<p><?php echo $INITIATIVE['description'];?></p><a href="#">Read more</a><br>
					
					<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
					<a href="#" data-toggle="popover" title="Popover title" data-trigger="focus" data-content="And here's some amazing content. It's very engaging. Right?"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></a>
					<form name = <?php echo '"' . $INITIATIVE_ID . '"';?> id= "0">
		                <div class="form-group">
		                    <label for="comment">Your Comment</label>
		                    <textarea name="comment" class="form-control" rows="2"></textarea>
		                </div>
		                <button type="submit" class="btn btn-ltblue" onClick="submitComment(this.form)">Save</button>
	                </form>
					<br>
					<div class="pull-right"> 
						<a id="expandAll" href="#"><span class="glyphicon glyphicon-plus"></span> Expand All</a>

	                	<a id="collapseAll" href="#"><span class="glyphicon glyphicon-minus"></span> Collapse All</a>
	            	</div>
				</div>
			</div>
		</div>

		<?php
		$depth = 1; // comment level starts at 1 (for proper css indentations)

		// LEVEL 0 COMMENTS (NO PARENTS) (depth = 1 (for proper css))
		$parentID = 0;
		$childrenArray = getChildrenArray($dbc, $parentID);
		if(!empty($childrenArray)){
			$childrenArray = getChildrenArray($dbc,$parentID );
			displayChildren($COMMENTS, $INITIATIVE_ID, $childrenArray, $dbc , $depth);
		}



		function getChildrenArray($dbc, $parentID){
			// Returns an array of a parent's children comments ($childrenArray)
			// $parentID : parent id for which to get children comments
			$query = "SELECT * FROM comments WHERE parent_id = $parentID ORDER BY netvotes DESC";
			$childrenQuery = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));
			$childrenArray = array();
			while ($comment = mysqli_fetch_array($childrenQuery, MYSQLI_ASSOC)) {
				array_push($childrenArray, $comment);
			}
			return $childrenArray;
		}

		function displayChildren($COMMENTS, $INITIATIVE_ID, $childrenArray, $dbc , $depth){
			// Recursive function that displays all children comments (and recursive subsequent children)
			// $COMMENTS : Array of all comments for initiative (queried at beginning of page)
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

				<div class= <?php echo $commentClassString;?> >
					<div class="row">
						<div class="col-sm-2 text-center">
							<a href="#"><span id="upvoted" class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
							<span>Net <?php echo $childArray['netvotes'];?></span>
							<a class="dislike" href="#"><span id="downvoted" class="glyphicon glyphicon-chevron-down"></span></a>
						</div>
						<div class="col-sm-10">
							<small><?php echo $commentor['username'];?> </small><small><?php echo date('Y-m-d h:i:s',$childArray['timestamp']);?></small>
							<p><?php echo $childArray['comment'];?><a href="#">Read more</a></p>
							<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
							<a href="#"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></a>
							<span>
		                        <a class="" role="button" data-toggle="collapse" href= <?php echo '"#' . $commentReply . '"' ;?> aria-expanded="false" aria-controls=<?php echo '"' . $commentReply . '"' ;?>>Reply</a>
		                    </span>
				            <div class="collapse" id=<?php echo '"' . $commentReply . '"' ;?>>
				                <form name = <?php echo '"' . $INITIATIVE_ID . '"';?> id= <?php echo '"' . $comment_id . '"';?>>
					                <div class="form-group">
					                    <label for="comment">Your Comment</label>
					                    <textarea name="comment" class="form-control" rows="2"></textarea>
					                </div>
					                <button type="submit" class="btn btn-ltblue" onClick="submitComment(this.form)">Save</button>
					                <a href="#reply1" data-toggle="collapse" aria-expanded="false" aria-controls=<?php echo '"' . $commentReply . '"' ;?>><button type="submit" class="btn btn-default">Cancel</button></a>
				                </form>
				            </div>
							<br>
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Expand 2 comments</a>
						</div>
					</div>
				</div>

				<?php
				// DISPLAY ALL NESTED CHILDREN COMMENTS (CALL RECURSIVELY TO displayChildren())
				$nestedChildrenComments = getChildrenArray($dbc, $comment_id);
				if(!empty($nestedChildrenComments)){
					displayChildren($COMMENTS, $INITIATIVE_ID, $nestedChildrenComments, $dbc, $depth+1);
				}
				
			}

		}

		?>
		<div class="panel-collapse collapse" id="collapseExample">
			<div class="panel-collapse collapse" id="comment3">
				<div class="panel-collapse collapse" id="comment4">
				</div>
			</div>
			<div class="panel-collapse collapse" id="comment5">
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(function () {			
                    $('a[data-toggle="collapse"]').on('click',function(){
				
				var objectID=$(this).attr('href');
				
				if($(objectID).hasClass('in'))
				{
                	$(objectID).collapse('hide');
				}
				
				else{
            		$(objectID).collapse('show');
				}
                    });
                    
                    
                    $('#expandAll').on('click',function(){
                        
                        $('a[data-toggle="collapse"]').each(function(){
                            var objectID=$(this).attr('href');
                            if($(objectID).hasClass('in')===false)
                            {
                                 $(objectID).collapse('show');
                            }
                        });
                    });
                    
                    $('#collapseAll').on('click',function(){
                        
                        $('a[data-toggle="collapse"]').each(function(){
                            var objectID=$(this).attr('href');
                            $(objectID).collapse('hide');
                        });
                    });
                    
		});

	$('[data-toggle="collapse"]').on('click', function() {
    var $this = $(this),
            $parent = typeof $this.data('parent')!== 'undefined' ? $($this.data('parent')) : undefined;
    if($parent === undefined) { /* Just toggle my  */
        $this.find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
        return true;
    }

    /* Open element will be close if parent !== undefined */
    var currentIcon = $this.find('.glyphicon');
    currentIcon.toggleClass('glyphicon-plus glyphicon-minus');
    $parent.find('.glyphicon').not(currentIcon).removeClass('glyphicon-minus').addClass('glyphicon-plus');

});
	$(document).ready(function(){
    	$('[data-toggle="popover"]').popover(); 
	});
	$(".glyphicon").click(function () {
	    var obj = $(this);
	    if ($(this).hasClass('glyphicon-thumbs-up')) {
	    	obj.toggleClass("tst");
	    
	        if (document.getElementById("disliked").classList.contains('tst')) {
	        	var disliked = document.getElementById("disliked");
	        	$(disliked).removeClass("tst");
	        }
	    }
	    else if($(this).hasClass('glyphicon-thumbs-down')) {
			obj.toggleClass("tst");
		
			if (document.getElementById("liked").classList.contains('tst')) {
				var liked = document.getElementById("liked");
				$(liked).removeClass("tst");
			}
	    } 
	    else if ($(this).hasClass('glyphicon-chevron-up')) {
	    	obj.toggleClass("tst");

	    	if (document.getElementById("downvoted").classList.contains('tst')) {
				var downvoted = document.getElementById("downvoted");
				$(downvoted).removeClass("tst");
			}
	    }
	    else {
	    	obj.toggleClass("tst");

	    	if (document.getElementById("upvoted").classList.contains('tst')) {
				var upvoted = document.getElementById("upvoted");
				$(upvoted).removeClass("tst");
			}
	    }
	})
	$(".glyphicon-bookmark").click(function () {
		var obj = $(this);
		obj.toggleClass("marked");
	})
	// $(".glyphicon-share-alt").click(function () {
	// 	var obj = $(this);
	// 	obj.toggleClass("marked");
	// })
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