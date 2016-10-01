<?php
include('getSession.php');

// LOAD INITIATIVES 
$query = "SELECT * FROM initiative ORDER BY rank ASC";
$initiativeQuery = mysqli_query($dbc,$query) or die ("Error in query: $query " . mysqli_error($dbc));
$INITIATIVES = array();
while ($row = mysqli_fetch_array($initiativeQuery, MYSQLI_ASSOC)) {
	$ind =  $row['id'];
	$INITIATIVES[$ind]['id']            = $row['id'];
	$INITIATIVES[$ind]['creator_id']    = $row['creator_id']; 
	$INITIATIVES[$ind]['rank']          = $row['rank'];      	
	$INITIATIVES[$ind]['upvotes']       = $row['upvotes'];  	
	$INITIATIVES[$ind]['downvotes']     = $row['downvotes']; 	
	$INITIATIVES[$ind]['netvotes']      = $row['netvotes']; 	
	$INITIATIVES[$ind]['ishidden']      = $row['ishidden']; 	
	$INITIATIVES[$ind]['title']         = $row['title'];			
	$INITIATIVES[$ind]['description']   = $row['description'];
	$INITIATIVES[$ind]['page_id']       = $row['page_id']; 	
	$INITIATIVES[$ind]['www']           = $row['www']; 		
	$INITIATIVES[$ind]['creation_time'] = $row['creation_time'];
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
	<link href="style.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar">
		<div class="navbar-brand"><img src="img/logo-2.png" alt="logo" /></div>
		<ul class="nav navbar-nav navbar-right">
			<li><a class="active" href="#">Browse</a></li>
			<li><a href="#">Search</a></li>
			<li><a href="#">Start Initiative</a></li>
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
			$id = $initiative['id'];        
			$initiative['creator_id'];   
			$initiative['rank'];         
			$initiative['upvotes'];      
			$initiative['downvotes'];    
			$initiative['netvotes'];     
			$initiative['ishidden'];     
			$initiative['title'];        
			$initiative['description'];  
			$initiative['page_id'];      
			$initiative['www'];          
			$initiative['creation_time'];

		}

		?>


		<div class="home-initiative">
			<div class="row">
				<div class="col-sm-2">
					<a href="#"><span id="liked" class="glyphicon glyphicon-thumbs-up"> 124 Likes</span></a>
					<br>
					<a href="#"><span id="disliked" class="glyphicon glyphicon-thumbs-down"> 35 Dislikes</span></a>
					<p>Total 159</p>
				</div>
				<div class="col-sm-10">
					<small>Username </small><small>Date Posted</small>
					<a href="initiative.php"><h4>Ballot Initiative Title</h4></a><a class="initiative-website" href="#"><small>Initiative Website</small></a>
					<a href="initiative.php"><p>Short description of ballot initiative. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a iaculis enim, sed pretium arcu. Cras consectetur lectus eget eros sodales, aliquam ultrices lectus posuere. Maecenas eget sem vel odio lacinia faucibus. Praesent volutpat non libero eu viverra. Praesent consectetur gravida condimentum.</p></a>
					<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
					<a href="#"><span class="glyphicon glyphicon-share-alt" data-toggle="modal" data-target="#sharemodal" aria-hidden="true"></span></a>
				</div>
			</div>
		</div>
		<div class="home-initiative">
			<div class="row">
				<div class="col-sm-2">
					<a href="#"><span id="liked" class="glyphicon glyphicon-thumbs-up"> 110 Likes</span></a>
					<br>
					<a href="#"><span id="disliked" class="glyphicon glyphicon-thumbs-down"> 46 Dislikes</span></a>
					<p>Total 156</p>
				</div>
				<div class="col-sm-10">
					<small>Username </small><small>Date Posted</small>
					<h4>Another Ballot Initiative Title</h4><a class="initiative-website" href="#"><small>Initiative Website</small></a>
					<p>Short description of ballot initiative. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget sem vel odio lacinia faucibus. Praesent volutpat non libero eu viverra. Praesent consectetur gravida condimentum.</p>
					<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
					<a href="#"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></a>
				</div>
			</div>
		</div>
		<div class="home-initiative">
			<div class="row">
				<div class="col-sm-2">
					<a href="#"><span id="liked" class="glyphicon glyphicon-thumbs-up"> 92 Likes</span></a>
					<br>
					<a href="#"><span id="disliked" class="glyphicon glyphicon-thumbs-down"> 20 Dislikes</span></a>
					<p>Total 112</p>
				</div>
				<div class="col-sm-10">
					<small>Username </small><small>Date Posted</small>
					<h4>Another Ballot Initiative Title</h4><a class="initiative-website" href="#"><small>Initiative Website</small></a>
					<p>Short description of ballot initiative. Nam a iaculis enim, sed pretium arcu. Cras consectetur lectus eget eros sodales, aliquam ultrices lectus posuere. Maecenas eget sem vel odio lacinia faucibus. Praesent volutpat non libero eu viverra. Praesent consectetur gravida condimentum.</p>
					<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
					<a href="#"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></a>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="sharemodal" tabindex="-1" role="dialog" aria-labelledby="ShareModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<button>Email</button>
					<button>Tweet</button>
				</div>
			</div>
		</div>
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
	$(".glyphicon-bookmark").click(function () {
		var obj = $(this);
		obj.toggleClass("marked");
	})
	$(".glyphicon-share-alt").click(function () {
		var obj = $(this);
		obj.toggleClass("marked");
	})
	</script>
</body>
</html>