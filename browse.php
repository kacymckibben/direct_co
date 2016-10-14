<?php
include('getSession.php');

// LOAD INITIATIVES 
$query = "SELECT * FROM initiative ORDER BY rank ASC";
$initiativeQuery = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));
$INITIATIVES = array();
while ($row = mysqli_fetch_array($initiativeQuery, MYSQLI_ASSOC)) {
	$ind =  $row['id'];
	$INITIATIVES[$ind]['id']            	= $row['id'];
	$INITIATIVES[$ind]['creator_id']    	= $row['creator_id']; 
	$INITIATIVES[$ind]['rank']          	= $row['rank'];      	
	$INITIATIVES[$ind]['upvotes']       	= $row['upvotes'];  	
	$INITIATIVES[$ind]['downvotes']     	= $row['downvotes']; 	
	$INITIATIVES[$ind]['netvotes']     	 	= $row['netvotes']; 	
	$INITIATIVES[$ind]['ishidden']      	= $row['ishidden']; 	
	$INITIATIVES[$ind]['title']         	= $row['title'];			
	$INITIATIVES[$ind]['description']   	= $row['description'];
	$INITIATIVES[$ind]['page_id']       	= $row['page_id']; 	
	$INITIATIVES[$ind]['www']           	= $row['www']; 		
	$INITIATIVES[$ind]['creation_time'] 	= $row['creation_time'];
	$creator_id = $row['creator_id']; 
	$query = "SELECT * FROM user WHERE id = $creator_id";
	$userQuery = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));
	$creator = mysqli_fetch_array($userQuery);
	$INITIATIVES[$ind]['creator_username']	= $creator['username'];  
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
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	<link href="style.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar">
		<div class="navbar-brand"><img src="img/logo-2.png" alt="logo" /></div>
		<ul class="nav navbar-nav navbar-right">
			<li><a class="active" href="browse.php">Browse</a></li>
			<li><a href="#">Search</a></li>
			<li><a href="create_initiative.html">Start Initiative</a></li>
			<li><a href="#">Saved Initiatives</a></li><!--these are initiatives I've liked. Maybe also do one for created initatives-->
			<li><a href="#">Owned Initiatives</a></li><!--only show if user has created at least one-->

			<li><a href="#">Sign up</a></li>
			<li><a href="#">Login</a></li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="profile-pic" src="img/profile.png" alt="profile-pic" /> <span class="caret"></span></a>
		        <ul class="dropdown-menu">
		            <li><a href="#">Profile</a></li>
		            <li><a href="#">Notifications</a></li>
		            <li><a href="#">Logout</a></li>
		        </ul>
			</li>
			
		</ul>
	</nav>
	<nav class="navbar secondary-navbar">
		<ul class="nav navbar-nav navbar-center">
			<li class="text">Organize initiatives by: </li>
			<li><a class="active" href="#">Most votes</a></li>
			<li><a href="#">Most recent</a></li>
			<li><a href="#">Location</a></li>
			<li><a href="#">Topic</a></li>
			<li><a href="#">My topics</a></li>
		</ul>
	</nav>
	<div class="container">
		<?php
		// POPULATE INITIATIVES
		foreach($INITIATIVES as $initiative){
			$id 				= $initiative['id'];        
			$creator_id			= $initiative['creator_id'];   
			$creator_username 	= $initiative['creator_username'];   
			$rank				= $initiative['rank'];         
			$upvotes 			= $initiative['upvotes'];      
			$downvotes 			= $initiative['downvotes'];    
			$netvotes 			= $initiative['netvotes'];     
			$ishidden 			= $initiative['ishidden'];     
			$title 				= $initiative['title'];        
			$description		= $initiative['description'];  
			$page_id			= $initiative['page_id'];      
			$www				= $initiative['www'];          
			$creation_time		= $initiative['creation_time'];
			?>
			<div class="home-initiative">
				<div class="row">
					<div class="col-sm-2">
						<a href="#"><span id="liked" class="glyphicon glyphicon-thumbs-up"> <?php echo $upvotes;?> Likes</span></a>
						<br>
						<a href="#"><span id="disliked" class="glyphicon glyphicon-thumbs-down"> <?php echo $downvotes;?> Dislikes</span></a>
						<p>Total <?php echo $netvotes;?></p>
					</div>
					<div class="col-sm-10">
						<small><?php echo $creator_username;?></small><small><?php echo date('Y-m-d h:i:s',$creation_time);?></small>
						<a href="initiative.php"><h4><?php echo $title;?></h4></a><a class="initiative-website" href="#"><small><?php echo $www;?></small></a>
						<a href="initiative.php"><p><?php echo $description;?></p></a>
						<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
						<a href="#" class="share" data-toggle="popover" data-trigger="focus"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></a>
					</div>
				</div>
			</div>
		<?php
		}
		?>
	</div>
	
	<script type="text/javascript">
	$(".glyphicon").click(function () {
	    var obj = $(this);
	    if ($(this).hasClass('glyphicon-thumbs-up')) {
	    	obj.toggleClass("tst");
	    
	        if (document.getElementById("disliked").classList.contains('tst')) {
	        	var disliked = document.getElementById("disliked");
	        	$(disliked).removeClass("tst");
	        }
	    }
	    else {
			obj.toggleClass("tst");
		
			if (document.getElementById("liked").classList.contains('tst')) {
				var liked = document.getElementById("liked");
				$(liked).removeClass("tst");
			}
	    } 
	})
	
	$(document).ready(function(){
		var popcontent = '<span class="glyphicon glyphicon-envelope"></span><i class="fa fa-twitter" aria-hidden="true"></i><i class="fa fa-facebook" aria-hidden="true"></i><i class="fa fa-reddit" aria-hidden="true"></i>';
		$(".share").popover({animation:true, content:popcontent, html:true});
    	$('[data-toggle="popover"]').popover(); 
	});
	$(".glyphicon-bookmark").click(function () {
		var obj = $(this);
		obj.toggleClass("marked");
	})
	// $(".glyphicon-share-alt").click(function () {
	// 	var obj = $(this);
	// 	obj.toggleClass("marked");
	// })
	</script>
</body>
</html>