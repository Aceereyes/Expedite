
            <div class="navbar nav_title" style="border: 0;">
				<center>
					<a href="index.php"><img style = "height:60px; width: 100%;" src="_photos/logo.PNG" /><span><img style = "height:60px; width: 100%; position: absolute; left:0px; top:0px;" src="_photos/logo.PNG" /></span>
					</a>
				</center>
            </div>
			
	<div class="clearfix"></div>
	<div class="profile clearfix">
		<div class="profile_pic">
		<?php
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ ?>
			<img src = "_photos/user.png" class="img-circle profile_img"/>
		<?php }else{
				$firstName = $ADMIN_LOGIN_VIEW['firstName'];
				$lastName = $ADMIN_LOGIN_VIEW['lastName'];
				$photo = $ADMIN_LOGIN_VIEW['photo']; ?>
			<img style = "width: 55px; height: 55px;" src="_photos/profilephotos/admins/<?php echo $firstName;echo$lastName; ?>/<?php echo $photo; ?>" alt="<?php echo $firstName;echo $lastName; ?>" class="img-circle profile_img">
		<?php } ?>
		</div>
		
		<?php
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ ?>
		
		<?php }else{ ?>
		<div class="profile_info">
			<h2><b><?php echo $firstName; echo ' '; echo $lastName; ?></b></h2>
			<span><?php echo $priviledge; ?></span>
		</div>
		<?php } ?>
		<div class="clearfix"></div>
	</div>