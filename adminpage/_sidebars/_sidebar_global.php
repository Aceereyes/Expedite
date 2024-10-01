        <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="color:black">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
				<!--<li><a href="slider.php"><i class="fa fa-desktop"></i> Slider</a>
                  </li>
				<li><a href="gallery.php"><i class="fa fa-photo"></i> Gallery</a>
                  </li>
					<li><a><i class="fa fa-info"></i> About Us <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						  <li><a href="history.php">History</a></li>
						  <li><a href="mission.php">Mission</a></li>
						  <li><a href="vision.php">Vision</a></li>
						  <li><a href="founders.php">Former Founders</a></li>
						  <li><a href="orgchart.php">Organizational Chart</a></li>
						  <li><a href="contactinfo.php">Contact Information</a></li>
						</ul>
					</li>-->
					<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
					<!--<li><a><i class="fa fa-th-list"></i> About / Contact Us <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						  <li><a href="about.php">About</a></li>
						  <li><a href="contactinfo.php">Contact Information</a></li>
						</ul>
					</li>
					
					<li><a><i class="fa fa-th-list"></i> Services <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						  <li><a href="services1.php">Repairing</a></li>
						  <li><a href="services2.php">Cleaning</a></li>
						  <li><a href="services3.php">Supply & Installation</a></li>
						  <li><a href="services4.php">Dismatling / Relocation</a></li>
						  <li><a href="services5.php">Disposal</a></li>
						  <li><a href="checkout.php">Checkout</a></li>
						</ul>
					</li>
					<li><a href="inventory.php"><i class="fa fa-bank"></i> Inventory</a>
					<li><a><i class="fa fa-envelope"></i> Messaging <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						  <li><a href="post_newsletter.php">Newsletter</a></li>
						  <li><a href="inquiries.php">Inbox</a></li>
						  <li><a href="sent.php">Sent</a></li>
						  <li><a href="reviews.php">Client's Feedback</a></li>
						</ul>
					</li>
					<!--<li><a href="orgchart.php"><i class="fa fa-users"></i> Teams</a></li>-->
					<?php
					if($department == 'HR Internal'){ ?>
					<li><a><i class="fa fa-envelope"></i> HR Internal <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						  <li><a href="hrinternal.php">Employees</a></li>
						  <li><a href="payroll.php">Payroll</a></li>
						</ul>
					</li>
					<?php } ?>
					
					<?php
					if($department == 'Marketing and Advertising'){ ?>
					<li><a><i class="fa fa-envelope"></i> Marketing and Advertising <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						<li><a href="mark.php">mark</a></li>
						</ul>
					</li>
					
					<?php } ?>
					
					<?php
					if($department == 'Accounting and Finance'){ ?>
					<li><a><i class="fa fa-envelope"></i> Accounting and Finance <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						<li><a href="acc.php">acc</a></li>
						</ul>
					</li>
					
					<?php } ?>
					<?php
					if($department == 'IT'){ ?>
					<li><a><i class="fa fa-envelope"></i> IT <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						<li><a href="it.php">it</a></li>
						</ul>
					</li>
					<?php } ?>
					<li><a><i class="fa fa-envelope"></i> Messaging <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						  <li><a href="inquiries.php">Inbox</a></li>
						  <li><a href="sent.php">Sent</a></li>
						  <li><a href="reviews.php">Client's Feedback</a></li>
						</ul>
					</li>
					<li><a><i class="fa fa-user"></i> Admin Panel <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						  <li><a href="user_accounts.php">Users Account</a></li>
						</ul>
					</li>
                </ul>
              </div>
            </div>
            <!-- /menu footer buttons -->