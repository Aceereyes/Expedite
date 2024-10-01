<?php @$priviledge = $ADMIN_LOGIN_VIEW['priviledge']; ?>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li>
				<?php
				if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ ?>
                <a class="user-profile">
					<i class="fa fa-user"></i> CIETI GUEST USER
				</a>
				<?php }else{
						$firstName = $ADMIN_LOGIN_VIEW['firstName'];
						$lastName = $ADMIN_LOGIN_VIEW['lastName'];
						$photo = $ADMIN_LOGIN_VIEW['photo'];
					?>
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="_photos/profilephotos/admins/<?php echo $firstName;echo$lastName; ?>/<?php echo $photo; ?>" alt="..."><?php echo ''.$firstName.'';echo ' ';echo ''.$lastName.''; ?> <span class=" fa fa-angle-down"></span>
                  </a>
				  <?php } ?>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <!--<li><a href="javascript:;"><i class="fa fa-user pull-right"></i> Profile</a></li>
                    <li>
					
                    </li>
                    <li><a href="javascript:;"><i class="fa fa-question-circle pull-right"></i> Help</a></li>
                    <li><a href="login.html"><i class="fa fa-gear pull-right"></i> Settings</a></li>-->
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
			
          </div>
        </div>
        <!-- /top navigation -->