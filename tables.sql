CREATE TABLE `direct_co`.`initiative`				( 	`id`        	INT(11) NOT NULL AUTO_INCREMENT,
														`creator_id`   	INT(11) NOT NULL ,
									  					`rank`      	INT(11) NOT NULL , 
									  					`upvotes`   	INT(11) NOT NULL , 
									  					`downvotes` 	INT(11) NOT NULL , 
									  					`netvotes`  	INT(11) NOT NULL , 
									  					`ishidden`  	BOOLEAN NOT NULL DEFAULT '0',
									  					`title`			VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
									  					`description`   VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
									  					`page_id`   	VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
									  					`www`   		VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
									  					`creation_time`	INT(11) NOT NULL ,
									  	PRIMARY KEY (	`id`) ) ENGINE = InnoDB;



CREATE TABLE `direct_co`.`comments`					( 	`id`        	INT(11) NOT NULL AUTO_INCREMENT,
														`initiative_id` INT(11) NOT NULL ,
														`user_id`   	INT(11) NOT NULL ,
														`parent_id` 	INT(11) NOT NULL , 
									  					`rank`      	INT(11) NOT NULL , 
									  					`upvotes`   	INT(11) NOT NULL , 
									  					`downvotes` 	INT(11) NOT NULL , 
									  					`netvotes`  	INT(11) NOT NULL , 
									  					`ishidden`  	BOOLEAN NOT NULL DEFAULT '0',
									  					`comment`   	VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
									  					`timestamp` 	INT(11) NOT NULL , 
									  	PRIMARY KEY (	`id`) ) ENGINE = InnoDB;


CREATE TABLE `direct_co`.`user` 					( 	`id`        	INT(11) NOT NULL AUTO_INCREMENT,
														`username`  	VARCHAR(50)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
														`email`     	VARCHAR(50)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
														`password`		VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
														`creation_time`	INT(11) NOT NULL ,
														`isloggedin`  	BOOLEAN NOT NULL DEFAULT '0',
									  	PRIMARY KEY (	`id`) ) ENGINE = InnoDB;


CREATE TABLE `direct_co`.`children_id`				( 	`index`     	INT(11) NOT NULL AUTO_INCREMENT,
														`parent_id` 	INT(11) NOT NULL ,
														`initiative_id` INT(11) NOT NULL ,
														`child_id`  	INT(11) NOT NULL ,
									  	PRIMARY KEY (	`index`) ) ENGINE = InnoDB;


CREATE TABLE `direct_co`.`comment_likes`			( 	`id`        	INT(11) NOT NULL AUTO_INCREMENT,
														`comment_id`    INT(11) NOT NULL ,
														`user_id`   	INT(11) NOT NULL ,
														`liked` 		INT(1)  NOT NULL , 
									  					`timestamp` 	INT(11) NOT NULL , 
									  	PRIMARY KEY (	`id`) ) ENGINE = InnoDB;


CREATE TABLE `direct_co`.`comment_flags`			( 	`id`        	INT(11) NOT NULL AUTO_INCREMENT,
														`comment_id`    INT(11) NOT NULL ,
														`user_id`   	INT(11) NOT NULL ,
														`flagged` 		INT(1)  NOT NULL , 
									  					`timestamp` 	INT(11) NOT NULL , 
									  	PRIMARY KEY (	`id`) ) ENGINE = InnoDB;


CREATE TABLE `direct_co`.`initiative_likes`			( 	`id`        	INT(11) NOT NULL AUTO_INCREMENT,
														`initiative_id` INT(11) NOT NULL ,
														`user_id`   	INT(11) NOT NULL ,
														`liked` 		INT(1)  NOT NULL , 
									  					`timestamp` 	INT(11) NOT NULL , 
									  	PRIMARY KEY (	`id`) ) ENGINE = InnoDB;




INSERT INTO initiative (id,creator_id ,rank,upvotes,downvotes,netvotes,ishidden,title,description,page_id,www,creation_time) 
		VALUES (1, 1, 1, 0,0,0,0,'Sample Initiative 1', 'Sample initiative 1 description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam a iaculis enim, sed pretium arcu. Cras consectetur lectus eget eros sodales, aliquam ultrices lectus posuere. Maecenas eget sem vel odio lacinia faucibus. Praesent volutpat non libero eu viverra. Praesent consectetur gravida condimentum.', 'initiative.php', 'wikipedia.com', 1473642150)