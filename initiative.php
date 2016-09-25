<?php
include('getSession.php');
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
					<a href="#"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span><p class="num-likes"> 124 Likes</p></a>
					<a class="dislike" href="#"><span class="glyphicon glyphicon-thumbs-down"></span><p class="num-likes"> 35 Dislikes</p></a>
					<p>Total 159</p>
				</div>
				<div class="col-sm-10">
					<small>Username </small><small>Date Posted</small>
					<h4>Ballot Initiative Title</h4><a class="initiative-website" href="#">Initiative Website</a>
					<p>Short description of ballot initiative. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a iaculis enim, sed pretium arcu. Cras consectetur lectus eget eros sodales, aliquam ultrices lectus posuere. Maecenas eget sem vel odio lacinia faucibus. Praesent volutpat non libero eu viverra. Praesent consectetur gravida condimentum.</p><a href="#">Read more</a><br>
					
					<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
					<a href="#"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></a>
					<form>
		                <div class="form-group">
		                    <label for="comment">Your Comment</label>
		                    <textarea name="comment" class="form-control" rows="2"></textarea>
		                </div>
		                <button type="submit" class="btn btn-ltblue">Save</button>
	                </form>
					<br>
					<div class="pull-right"> 
						<a id="expandAll" href="#"><span class="glyphicon glyphicon-plus"></span> Expand All</a>

	                	<a id="collapseAll" href="#"><span class="glyphicon glyphicon-minus"></span> Collapse All</a>
	            	</div>
				</div>
			</div>
		</div>
		<div class="comment-1">
			<div class="row">
				<div class="col-sm-2 text-center">
					<a href="#"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
					<span>Net 89</span>
					<a class="dislike" href="#"><span class="glyphicon glyphicon-chevron-down"></span></a>
				</div>
				<div class="col-sm-10">
					<small>Username </small><small>Date Posted</small>
					<p>Comment 1 with a child. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a iaculis enim, sed pretium arcu. Cras consectetur lectus eget eros sodales, aliquam ultrices lectus posuere. Maecenas eget sem vel odio lacinia faucibus. Praesent volutpat non libero eu viverra. Praesent consectetur gravida condimentum. <a href="#">Read more</a></p>
					<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
					<a href="#"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></a>
					<span>
                        <a class="" role="button" data-toggle="collapse" href="#reply1" aria-expanded="false" aria-controls="reply1">Reply</a>
                    </span>
		            <div class="collapse" id="reply1">
		                <form>
			                <div class="form-group">
			                    <label for="comment">Your Comment</label>
			                    <textarea name="comment" class="form-control" rows="2"></textarea>
			                </div>
			                <button type="submit" class="btn btn-ltblue">Save</button>
			                <a href="#reply1" data-toggle="collapse" aria-expanded="false" aria-controls="reply1"><button type="submit" class="btn btn-default">Cancel</button></a>
		                </form>
		            </div>
					<br>
					<a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Expand 2 comments</a>
				</div>
			</div>
		</div>
		<div class="panel-collapse collapse" id="collapseExample">
			<div class="comment-2">
				<div class="row">
					<div class="col-sm-2 text-center">
						<a href="#"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
						<p>Net 52</p>
						<a class="dislike" href="#"><span class="glyphicon glyphicon-chevron-down"></span></a>
					</div>
					<div class="col-sm-10">
						<small>Username </small><small>Date Posted</small>
						<p>Comment 2 with a parent. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a iaculis enim, sed pretium arcu. Cras consectetur lectus eget eros sodales, aliquam ultrices lectus posuere. Maecenas eget sem vel odio lacinia faucibus. Praesent volutpat non libero eu viverra. Praesent consectetur gravida condimentum.</p>
						<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
						<a href="#"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></a>
						<span>
	                        <a class="" role="button" data-toggle="collapse" href="#reply2" aria-expanded="false" aria-controls="reply2">Reply</a>
	                    </span>
			            <div class="collapse" id="reply2">
			                <form>
				                <div class="form-group">
				                    <label for="comment">Your Comment</label>
				                    <textarea name="comment" class="form-control" rows="2"></textarea>
				                </div>
				                <button type="submit" class="btn btn-ltblue">Save</button>
				                <a href="#reply2" data-toggle="collapse" aria-expanded="false" aria-controls="reply2"><button type="submit" class="btn btn-default">Cancel</button></a>
			                </form>
			            </div>
						<br>
						<a data-toggle="collapse" href="#comment3" aria-expanded="false" aria-controls="comment3"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Expand 1 comment</a>
					</div>
				</div>
			</div>
			<div class="panel-collapse collapse" id="comment3">
				<div class="comment-3">
					<div class="row">
						<div class="col-sm-2 text-center">
							<a href="#"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
							<p>Net 52</p>
							<a class="dislike" href="#"><span class="glyphicon glyphicon-chevron-down"></span></a>
						</div>
						<div class="col-sm-10">
							<small>Username </small><small>Date Posted</small>
							<p>Comment 3 with a parent. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a iaculis enim, sed pretium arcu. Cras consectetur lectus eget eros sodales, aliquam ultrices lectus posuere. Maecenas eget sem vel odio lacinia faucibus. Praesent volutpat non libero eu viverra. Praesent consectetur gravida condimentum.</p>
							<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
							<a href="#"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></a>
							<span>
		                        <a class="" role="button" data-toggle="collapse" href="#reply3" aria-expanded="false" aria-controls="reply3">Reply</a>
		                    </span>
				            <div class="collapse" id="reply3">
				                <form>
					                <div class="form-group">
					                    <label for="comment">Your Comment</label>
					                    <textarea name="comment" class="form-control" rows="2"></textarea>
					                </div>
					                <button type="submit" class="btn btn-ltblue">Save</button>
					                <a href="#reply3" data-toggle="collapse" aria-expanded="false" aria-controls="reply3"><button type="submit" class="btn btn-default">Cancel</button></a>
				                </form>
				            </div>
							<br>
							<a data-toggle="collapse" href="#comment4" aria-expanded="false" aria-controls="comment4"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Expand 1 comment</a>
						</div>
					</div>
				</div>
				<div class="panel-collapse collapse" id="comment4">
					<div class="comment-4">
						<div class="row">
							<div class="col-sm-2 text-center">
								<a href="#"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
								<p>Net 52</p>
								<a class="dislike" href="#"><span class="glyphicon glyphicon-chevron-down"></span></a>
							</div>
							<div class="col-sm-10">
								<small>Username </small><small>Date Posted</small>
								<p>Comment 4 with a parent. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a iaculis enim, sed pretium arcu. Cras consectetur lectus eget eros sodales, aliquam ultrices lectus posuere. Maecenas eget sem vel odio lacinia faucibus. Praesent volutpat non libero eu viverra. Praesent consectetur gravida condimentum.</p>
								<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
								<a href="#"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></a>
								<span>
			                        <a class="" role="button" data-toggle="collapse" href="#reply4" aria-expanded="false" aria-controls="reply4">Reply</a>
			                    </span>
					            <div class="collapse" id="reply4">
					                <form>
						                <div class="form-group">
						                    <label for="comment">Your Comment</label>
						                    <textarea name="comment" class="form-control" rows="2"></textarea>
						                </div>
						                <button type="submit" class="btn btn-ltblue">Save</button>
						                <a href="#reply4" data-toggle="collapse" aria-expanded="false" aria-controls="reply4"><button type="submit" class="btn btn-default">Cancel</button></a>
					                </form>
					            </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="comment-2">
				<div class="row">
					<div class="col-sm-2 text-center">
						<a href="#"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
						<p>Net 52</p>
						<a class="dislike" href="#"><span class="glyphicon glyphicon-chevron-down"></span></a>
					</div>
					<div class="col-sm-10">
						<small>Username </small><small>Date Posted</small>
						<p>Comment 2 with a parent. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a iaculis enim, sed pretium arcu. Cras consectetur lectus eget eros sodales, aliquam ultrices lectus posuere. Maecenas eget sem vel odio lacinia faucibus. Praesent volutpat non libero eu viverra. Praesent consectetur gravida condimentum.</p>
						<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
						<a href="#"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></a>
						<a href="#"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></a>
						<span>
	                        <a class="" role="button" data-toggle="collapse" href="#reply5" aria-expanded="false" aria-controls="reply5">Reply</a>
	                    </span>
			            <div class="collapse" id="reply5">
			                <form>
				                <div class="form-group">
				                    <label for="comment">Your Comment</label>
				                    <textarea name="comment" class="form-control" rows="2"></textarea>
				                </div>
				                <button type="submit" class="btn btn-default">Save</button>
				                <a href="#reply5" data-toggle="collapse" aria-expanded="false" aria-controls="reply5"><button type="submit" class="btn btn-default">Cancel</button></a>
			                </form>
			            </div>
						<br>
						<a data-toggle="collapse" href="#comment5" aria-expanded="false" aria-controls="comment5"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Expand 1 comment</a>
					</div>
				</div>
			</div>
			<div class="panel-collapse collapse" id="comment5">
				<div class="comment-3">
					<div class="row">
						<div class="col-sm-2 text-center">
							<a href="#"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
							<p>Net 52</p>
							<a class="dislike" href="#"><span class="glyphicon glyphicon-chevron-down"></span></a>
						</div>
						<div class="col-sm-10">
							<small>Username </small><small>Date Posted</small>
							<p>Comment with a parent. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a iaculis enim, sed pretium arcu. Cras consectetur lectus eget eros sodales, aliquam ultrices lectus posuere. Maecenas eget sem vel odio lacinia faucibus. Praesent volutpat non libero eu viverra. Praesent consectetur gravida condimentum.</p>
							<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
							<a href="#"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></a>
							<a href="#"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></a>
							<span>
		                        <a class="" role="button" data-toggle="collapse" href="#reply6" aria-expanded="false" aria-controls="reply6">Reply</a>
		                    </span>
				            <div class="collapse" id="reply6">
				                <form>
					                <div class="form-group">
					                    <label for="comment">Your Comment</label>
					                    <textarea name="comment" class="form-control" rows="2"></textarea>
					                </div>
					                <button type="submit" class="btn btn-default">Save</button>
					                <a href="#reply6" data-toggle="collapse" aria-expanded="false" aria-controls="reply6"><button type="submit" class="btn btn-default">Cancel</button></a>
				                </form>
				            </div>
							<br>
							<a data-toggle="collapse" href="#comment6" aria-expanded="false" aria-controls="comment6"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Expand 1 comment</a>
						</div>
					</div>
				</div>
				<div class="panel-collapse collapse" id="comment6">
					<div class="comment-4">
						<div class="row">
							<div class="col-sm-2 text-center">
								<a href="#"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
								<p>Net 52</p>
								<a class="dislike" href="#"><span class="glyphicon glyphicon-chevron-down"></span></a>
							</div>
							<div class="col-sm-10">
								<small>Username </small><small>Date Posted</small>
								<p>Comment with a parent. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a iaculis enim, sed pretium arcu. Cras consectetur lectus eget eros sodales, aliquam ultrices lectus posuere. Maecenas eget sem vel odio lacinia faucibus. Praesent volutpat non libero eu viverra. Praesent consectetur gravida condimentum.</p>
								<a href="#"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a>
								<a href="#"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></a>
								<a href="#"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></a>
								<span>
			                        <a class="" role="button" data-toggle="collapse" href="#reply7" aria-expanded="false" aria-controls="reply7">Reply</a>
			                    </span>
					            <div class="collapse" id="reply7">
					                <form>
						                <div class="form-group">
						                    <label for="comment">Your Comment</label>
						                    <textarea name="comment" class="form-control" rows="2"></textarea>
						                </div>
						                <button type="submit" class="btn btn-default">Save</button>
						                <a href="#reply7" data-toggle="collapse" aria-expanded="false" aria-controls="reply7"><button type="submit" class="btn btn-default">Cancel</button></a>
					                </form>
					            </div>
							</div>
						</div>
					</div>
				</div>
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
	</script>
</body>
</html>