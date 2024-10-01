<?php @$ADMIN_PRIVILEDGE = $ADMIN_LOGIN_VIEW['user_priviledge']; ?>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
				<?php
				if(!isset($_SESSION['ADMIN_LOGIN'])){ ?>
                <li><a href="login.php"><i class="fa fa-unlock "></i> LOGIN</a></li>
				<?php } ?>
                <li>
				<?php
				if(!isset($_SESSION['ADMIN_LOGIN'])){ ?>
                <a class="user-profile">
					<i class="fa fa-user"></i> CIETI GUEST USER
				</a>
				<?php }else{ ?>
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="_photos/profilephotos/admins/<?php echo ''.$ADMIN_FIRSTNAME.'';echo ''.$ADMIN_MIDDLENAME.'';echo ''.$ADMIN_LASTNAME.''; ?>/<?php echo $ADMIN_PROFILE_PHOTO; ?>" alt="..."><span class=" fa fa-angle-down"></span>
                  </a>
				  <?php } ?>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"><i class="fa fa-user pull-right"></i> Profile</a></li>
                    <li>
					
                    </li>
                    <li><a href="javascript:;"><i class="fa fa-question-circle pull-right"></i> Help</a></li>
                    <li><a href="login.html"><i class="fa fa-gear pull-right"></i> Settings</a></li>
                    <li><a href="logout.php?id=<?php echo ''.$ADMIN_USERNAME.''; ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
				<?php
				if(isset($_SESSION['ADMIN_LOGIN'])){ ?>
				
				
				<!-- FILES WITH APPROVAL -->
				<li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-download"></i> File Approval
                    <span class="badge bg-red">
						<?php
						$count_downloads = mysql_query("SELECT count(*) AS id FROM file_with_approvals where file_type = 'FILE_WITH_APPROVAL' && notification_status = '1' && signatory = '$ADMIN_USERID'");
						$count_all_unread_downloads = mysql_fetch_assoc($count_downloads);  
						$notification = ''.$count_all_unread_downloads['id'].'';
						echo ''.$count_all_unread_downloads['id'].' New';
						?> 
					</span>
                  </a>
				<ul id="menu1" class="dropdown-menu list-unstyled msg_list <?php if($notification != 0){ echo 'ex3'; } ?>" role="menu">
				  <?php
					$ADMIN_USERID = $ADMIN_LOGIN_VIEW['user_id'];
					$sel = mysql_query("SELECT * FROM file_with_approvals WHERE file_type = 'FILE_WITH_APPROVAL' && notification_status = '1' && signatory = '$ADMIN_USERID' ORDER BY id DESC");
					while($row=mysql_fetch_array($sel))
					{
					$id = ''.$row['id'].'';
						echo '
							<li style = "cursor: pointer;" data-toggle="modal" data-target=".bs-example-modal-approvals-file'.$row['id'].'">
								<span>
								  <span><b>'.$row['name'].'</b></span>
								</span>
									<br/>
									<br/>
								<span class="message">
								<b>Department Name:</b> '.$row['dept_code'].'
									<br/>
								  <b>File Name:</b> '.$row['file_name'].'
								  <br/>
								  <b>Date:</b>'; $date = strtotime(''.$row['date_download'].''); $new_date = date('F m, Y', $date); echo $new_date; echo '
								  <br/>
								  <b>Time:</b>'; echo date('h:i:s A', strtotime(''.$row['time_download'].'')); echo '
								</span>
							</li>
							<div class="clearfix"></div>
						';
					}
					
					$count_downloads = mysql_query("SELECT count(*) AS id FROM file_with_approvals WHERE file_type = 'FILE_WITH_APPROVAL' && notification_status = '1' && signatory = '$ADMIN_USERID'");
					$count_all_unread_downloads = mysql_fetch_assoc($count_downloads); 
					$notification = ''.$count_all_unread_downloads['id'].'';
					if($notification == 0){ 
					echo '
                    <li>
                      <div class="text-center">
					  <i class="fa fa-info-circle"></i> <b>'.$ADMIN_USER_DEPARTMENT.'</b> HAS NO NEW NOTIFICATION
                      </div>
                    </li>';
					}?>
				</ul>
                </li>
				<!-- END OF FILES WITH APPROVAL -->
				
				<style>
				  ul.ex3 {
					  background-color: lightblue;
					  height: 570px;
					  overflow: auto;
					}
				</style>
				
				
				<!-- RECEIVED -->
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="top" title="Logout">
                    <i class="fa fa-send"></i> Received Files
                    <span class="badge bg-red">
					<?php
				  if($ADMIN_PRIVILEDGE != 'Admin'){
						$count_received_files = mysql_query("SELECT count(*) AS id FROM sent_file where notification_status = '1' && dept_code = '$ADMIN_DEPARTMENT'");
						$count_all_unread_received_files = mysql_fetch_assoc($count_received_files);  
						$notification_received_files = ''.$count_all_unread_received_files['id'].'';
						echo ''.$count_all_unread_received_files['id'].' New';
				  }else{
						$count_received_files = mysql_query("SELECT count(*) AS id FROM sent_file where notification_status = '1'");
						$count_all_unread_received_files = mysql_fetch_assoc($count_received_files);  
						$notification_received_files = ''.$count_all_unread_received_files['id'].'';
						echo ''.$count_all_unread_received_files['id'].' New';
				  }
				  ?>
				  
					</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list <?php if($notification_received_files != 0){ echo 'ex3'; } ?>" role="menu">
				  <?php
				  if($ADMIN_PRIVILEDGE != 'Admin'){
					$sel = mysql_query("SELECT * FROM sent_file WHERE notification_status = '1' && dept_code = '$ADMIN_DEPARTMENT' ORDER BY id DESC");
					while($row=mysql_fetch_array($sel))
					{
					$id = ''.$row['id'].'';
						echo '
							<li data-toggle="modal" data-target=".bs-example-modal-file_sent'.$row['id'].'">
							  <a onclick="openWin()">
								<span>
								  <span><b>'.$row['name'].'</b></span>
								</span>
									<br/>
									<br/>
								<span class="message">
								<b>Department Name:</b> '.$row['dept_code'].'
									<br/>
								  <b>File Name:</b> '.$row['file_name'].'
								  <br/> 
								  <b>Date:</b>'; $date = strtotime(''.$row['date_sent'].''); $new_date = date('F m, Y', $date); echo $new_date; echo '
								  <br/>
								  <b>Time:</b>'; echo date('h:i:s A', strtotime(''.$row['time_sent'].'')); echo '
								</span>
							  </a>
							</li>
							<div class="clearfix"></div>
							<script>
								var myWindow;
							function openWin() {
								myWindow = window.open("_delete/received_notification.php?id='.$row['id'].'", "myWindow", "width=1,height=1");
								setTimeout(closeWin, 200)
							}
							function closeWin() {
								myWindow.close();
							}
							</script>
						';
					}
					$count_notification = mysql_query("SELECT count(*) AS id FROM sent_file where notification_status = '1' && dept_code = '$ADMIN_DEPARTMENT'");
					$count_all_unread_notification = mysql_fetch_assoc($count_notification); 
					$received = ''.$count_all_unread_notification['id'].'';
					if($received == 0){ 
					echo '
                    <li>
                      <div class="text-center">
					  <i class="fa fa-info-circle"></i> <b>'.$ADMIN_USER_DEPARTMENT.'</b> HAS NO NEW NOTIFICATION
                      </div>
                    </li>';
					}
				  }else{
					$sel = mysql_query("SELECT * FROM sent_file WHERE notification_status = '1' ORDER BY id DESC");
					while($row=mysql_fetch_array($sel))
					{
					$id = ''.$row['id'].'';
						echo '
							<li data-toggle="modal" data-target=".bs-example-modal-file_sent'.$row['id'].'">
							  <a onclick="openWin()">
								<span>
								  <span><b>'.$row['name'].'</b></span>
								</span>
									<br/>
									<br/>
								<span class="message">
								<b>Department Name:</b> '.$row['dept_code'].'
									<br/>
								  <b>File Name:</b> '.$row['file_name'].'
								  <br/> 
								  <b>Date:</b>'; $date = strtotime(''.$row['date_sent'].''); $new_date = date('F m, Y', $date); echo $new_date; echo '
								  <br/>
								  <b>Time:</b>'; echo date('h:i:s A', strtotime(''.$row['time_sent'].'')); echo '
								</span>
							  </a>
							</li>
							<div class="clearfix"></div>
							<script>
								var myWindow;
							function openWin() {
								myWindow = window.open("_delete/received_notification.php?id='.$row['id'].'", "myWindow", "width=1,height=1");
								setTimeout(closeWin, 200)
							}
							function closeWin() {
								myWindow.close();
							}
							</script>
						';
					}
					$count_notification = mysql_query("SELECT count(*) AS id FROM sent_file where notification_status = '1' && dept_code = '$ADMIN_DEPARTMENT'");
					$count_all_unread_notification = mysql_fetch_assoc($count_notification); 
					$received = ''.$count_all_unread_notification['id'].'';
					if($received == 0){ 
					echo '
                    <li>
                      <div class="text-center">
					  <i class="fa fa-info-circle"></i> <b>'.$ADMIN_USER_DEPARTMENT.'</b> HAS NO NEW NOTIFICATION
                      </div>
                    </li>';
					}
				  }
				  ?>
                  </ul>
                </li>
				<!-- END OF RECEIVED -->
				
				<li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-download"></i> Downloads
                    <span class="badge bg-red">
						<?php
				  if($ADMIN_PRIVILEDGE != 'Admin'){
						$count_downloads = mysql_query("SELECT count(*) AS id FROM file_downloads where notification_status = '1' && dept_code = '$ADMIN_DEPARTMENT'");
						$count_all_unread_downloads = mysql_fetch_assoc($count_downloads);  
						$notification = ''.$count_all_unread_downloads['id'].'';
						echo ''.$count_all_unread_downloads['id'].' New';
				  }else{
						$count_downloads = mysql_query("SELECT count(*) AS id FROM file_downloads where notification_status = '1'");
						$count_all_unread_downloads = mysql_fetch_assoc($count_downloads);  
						$notification = ''.$count_all_unread_downloads['id'].'';
						echo ''.$count_all_unread_downloads['id'].' New';
				  }
						?> 
					</span>
                  </a>
				<ul id="menu1" class="dropdown-menu list-unstyled msg_list <?php if($notification != 0){ echo 'ex3'; } ?>" role="menu">
				<?php
				if($ADMIN_PRIVILEDGE != 'Admin'){
					$sel = mysql_query("SELECT * FROM file_downloads WHERE notification_status = '1' && dept_code = '$ADMIN_DEPARTMENT' ORDER BY id DESC");
					while($row=mysql_fetch_array($sel))
					{
					$id = ''.$row['id'].'';
						echo '
							<li data-toggle="modal" data-target=".bs-example-modal-see_download-file'.$row['id'].'">
							  <a onclick="openWin()">
								<span>
								  <span><b>'.$row['name'].'</b></span>
								</span>
									<br/>
									<br/>
								<span class="message">
								<b>Department Name:</b> '.$row['dept_code'].'
									<br/>
								  <b>File Name:</b> '.$row['file_name'].'
								  <br/>
								  <b>Date:</b>'; $date = strtotime(''.$row['date_download'].''); $new_date = date('F m, Y', $date); echo $new_date; echo '
								  <br/>
								  <b>Time:</b>'; echo date('h:i:s A', strtotime(''.$row['time_download'].'')); echo '
								</span>
							  </a>
							</li>
							<div class="clearfix"></div>
							<script>
								var myWindow;
							function openWin() {
								myWindow = window.open("_delete/updating_download_notification.php?id='.$row['id'].'", "myWindow", "width=1,height=1");
								setTimeout(closeWin, 2000)
							}
							function closeWin() {
								myWindow.close();
							}
							</script>
						';
					}
					$count_downloads = mysql_query("SELECT count(*) AS id FROM file_downloads where notification_status = '1' && dept_code = '$ADMIN_DEPARTMENT'");
					$count_all_unread_downloads = mysql_fetch_assoc($count_downloads); 
					$notification = ''.$count_all_unread_downloads['id'].'';
					if($notification == 0){ 
					echo '
                    <li>
                      <div class="text-center">
					  <i class="fa fa-info-circle"></i> <b>'.$ADMIN_USER_DEPARTMENT.'</b> HAS NO NEW NOTIFICATION
                      </div>
                    </li>';
					}
				}else{
					$sel = mysql_query("SELECT * FROM file_downloads WHERE notification_status = '1' ORDER BY id DESC");
					while($row=mysql_fetch_array($sel))
					{
					$id = ''.$row['id'].'';
						echo '
							<li data-toggle="modal" data-target=".bs-example-modal-see_download-file'.$row['id'].'">
							  <a onclick="openWin()">
								<span>
								  <span><b>'.$row['name'].'</b></span>
								</span>
									<br/>
									<br/>
								<span class="message">
								<b>Department Name:</b> '.$row['dept_code'].'
									<br/>
								  <b>File Name:</b> '.$row['file_name'].'
								  <br/>
								  <b>Date:</b>'; $date = strtotime(''.$row['date_download'].''); $new_date = date('F m, Y', $date); echo $new_date; echo '
								  <br/>
								  <b>Time:</b>'; echo date('h:i:s A', strtotime(''.$row['time_download'].'')); echo '
								</span>
							  </a>
							</li>
							<div class="clearfix"></div>
							<script>
								var myWindow;
							function openWin() {
								myWindow = window.open("_delete/updating_download_notification.php?id='.$row['id'].'", "myWindow", "width=1,height=1");
								setTimeout(closeWin, 200)
							}
							function closeWin() {
								myWindow.close();
							}
							</script>
						';
					}
					$count_downloads = mysql_query("SELECT count(*) AS id FROM file_downloads where notification_status = '1' && dept_code = '$ADMIN_DEPARTMENT'");
					$count_all_unread_downloads = mysql_fetch_assoc($count_downloads); 
					$notification = ''.$count_all_unread_downloads['id'].'';
					if($notification == 0){ 
					echo '
                    <li>
                      <div class="text-center">
					  <i class="fa fa-info-circle"></i> <b>'.$ADMIN_USER_DEPARTMENT.'</b> HAS NO NEW NOTIFICATION
                      </div>
                    </li>';
					}
				}
					?>
                  </ul>
                </li>
				<?php
				if(isset($_POST['read_download'])){
					$id_unread_download = $_POST['id_unread_download'];
					$unread_download = $_POST['unread_download'];
					mysql_query("UPDATE file_downloads SET notification_status = '$unread_download' WHERE id = '$id_unread_download'");
					echo '<meta http-equiv="refresh" content="0.000001">';
				}
				
				if(isset($_POST['read_all_download'])){
					mysql_query("UPDATE file_downloads SET notification_status = '0' WHERE dept_code = '$ADMIN_DEPARTMENT'");
					echo '<meta http-equiv="refresh" content="0.000001">';
				}
				
				if(isset($_POST['read_notifications'])){
					$id_unread_notifications = $_POST['id_unread_notifications'];
					$unread_notifications = $_POST['unread_notifications'];
					mysql_query("UPDATE sent_file SET notification_status = '$unread_notifications' WHERE id = '$id_unread_notifications'");
					echo '<meta http-equiv="refresh" content="0.000001">';
				}
				
				if(isset($_POST['read_all_notification'])){
					mysql_query("UPDATE sent_file SET notification_status = '0'");
					echo '<meta http-equiv="refresh" content="0.000001">';
				}
				
				if(isset($_POST['file_approved'])){
					$file_with_approvals_id = $_POST['file_with_approvals_id'];
					$date_download = $_POST['date_download'];
					$time_download = $_POST['time_download'];
					$name = $_POST['name'];
							
					$select_file_approvals = mysql_query("SELECT * FROM file_with_approvals where id = '$file_with_approvals_id' && date_download = '$date_download' && time_download = '$time_download' && name = '$name'");
					$select_file_approvals_row=mysql_fetch_array($select_file_approvals);
					
					mysql_query("UPDATE file_with_approvals SET notification_status = '0', approval = '1' WHERE id = '$file_with_approvals_id' && name = '$name' && date_download = '$date_download' && time_download = '$time_download'");
					echo '<meta http-equiv="refresh" content="0.000001">';
				}
				
				if(isset($_POST['file_declined'])){
					mysql_query("UPDATE sent_file SET notification_status = '0'");
					echo '<meta http-equiv="refresh" content="0.000001">';
				}
				
					$sel = mysql_query("SELECT * FROM sent_file ORDER BY id");
					while($row=mysql_fetch_array($sel))
					{
						?>
<div class="modal fade bs-example-modal-file_sent<?php echo ''.$row['id'].''; ?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
		
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2"><i class="fa fa-book"></i> File Received Details</h4>
			</div>
					<div class="modal-body">
							  <label>FILE NAME:</label> <a href = "<?php echo 'http://lorelsdev.com/form/received_files/'; ?><?php echo ''.$row['file_name'].''; ?>" target = "_blank"><u><i><?php echo ''.$row['file_name'].''; ?></i></u></a>
						<br>
							  <label>DESCRIPTION:</label> <?php echo ''.$row['description'].''; ?>
						<br>
							  <label>COLLEGE / DEPARTMENT:</label> <?php echo ''.$row['dept_code'].''; ?> - <?php echo ''.$row['dept_name'].''; ?> 
						<br><br>
						<h4><i class="fa fa-info-circle"></i> FILE RECEIVED DETAILS</h4>
							  <label>UPLOADED BY:</label> <?php echo ''.$row['name'].''; ?>
						<br>
							  <label>EMAIL:</label> <?php echo ''.$row['email'].''; ?>
						<br>
							  <label>DATE & TIME UPLOADED:</label> <?php $date = strtotime(''.$row['date_sent'].''); $new_date = date('F m, Y', $date); echo $new_date;?> | <?php echo date('h:i A', strtotime(''.$row['time_sent'].'')); ?>
					</div>
		</div>
	</div>
</div>
					<?php } 
					$sel = mysql_query("SELECT * FROM file_downloads ORDER BY id");
					while($row=mysql_fetch_array($sel))
					{
						?>
<div class="modal fade bs-example-modal-see_download-file<?php echo ''.$row['id'].''; ?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
		
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2"><i class="fa fa-book"></i> File Details</h4>
			</div>
					<div class="modal-body">
							  <label>FILE NAME:</label> <a href = "file_uploads/<?php echo ''.$row['file_name'].''; ?>" target = "_blank"><u><i><?php echo ''.$row['file_name'].''; ?></i></u></a>
						<br>
							  <label>DESCRIPTION:</label> <?php echo ''.$row['file_description'].''; ?>
						<br>
							  <label>COLLEGE / DEPARTMENT:</label> <?php echo ''.$row['dept_code'].''; ?> - <?php echo ''.$row['dept_name'].''; ?> 
						<br><br>
						<h4><i class="fa fa-info-circle"></i> FILE DOWNLOAD DETAILS</h4>
							  <label>DOWNLOADED BY:</label> <?php echo ''.$row['name'].''; ?>
						<br>
							  <label>EMAIL:</label> <?php echo ''.$row['email'].''; ?>
						<br>
							  <label>DATE & TIME DOWNLOAD:</label> <?php $date = strtotime(''.$row['date_download'].''); $new_date = date('F m, Y', $date); echo $new_date;?> | <?php echo date('h:i A', strtotime(''.$row['time_download'].'')); ?>
					</div>
		</div>
	</div>
</div>
					<?php } 					
					$sel = mysql_query("SELECT * FROM file_with_approvals ORDER BY id");
					while($row=mysql_fetch_array($sel))
					{
						?>
<div class="modal fade bs-example-modal-approvals-file<?php echo ''.$row['id'].''; ?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
		
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2"><i class="fa fa-book"></i> File Details</h4>
			</div>
					<div class="modal-body">
							  <label>FILE NAME:</label> <a href = "file_uploads/received_files/<?php echo ''.$row['name'].''.$row['date_download'].''.$row['time_download1'].''; ?>/<?php echo ''.$row['file_name'].''; ?>" target = "_blank"><u><i><?php echo ''.$row['file_name'].''; ?></i></u></a>
						<br>
							  <label>Name:</label> <?php echo ''.$row['name'].''; ?>
						<br>
							  <label>Email:</label> <?php echo ''.$row['email'].''; ?>
						<br>
							  <label>Description:</label> <?php echo ''.$row['file_description'].''; ?>
						<br>
							  <label>Department Name:</label> <?php echo ''.$row['dept_name'].''; ?>
						<br>
							  <label>Department Code:</label> <?php echo ''.$row['dept_code'].''; ?>
						<br>
						<label>Name of File Signatories:</label>
						<?php
						$department_code = ''.$row['dept_code'].'';
						$name = ''.$row['name'].'';
						$email = ''.$row['email'].'';
						$date_download = ''.$row['date_download'].'';
						$time_download = ''.$row['time_download'].'';
						$description = ''.$row['file_description'].'';
					$select_file_dl = mysql_query("SELECT * FROM file_downloads WHERE notification_status = '1' && dept_code = '$department_code' && name = '$name' && email = '$email' && date_download = '$date_download' &&
					time_download = '$time_download' ORDER BY id");
					$select_file_dl_show=mysql_fetch_array($select_file_dl);
					$signatory = ''.$select_file_dl_show['signatory'].'';
					foreach(explode(' ', $signatory) as $explode_signatory){
					$select_users = mysql_query("SELECT * FROM user_admins WHERE user_id = '$explode_signatory' ORDER BY user_id");
					$select_users_show=mysql_fetch_array($select_users);
					$user_firstname = ''.$select_users_show['user_firstname'].'';
					$user_lastname = ''.$select_users_show['user_lastname'].'';
					echo '<ul>'.$user_firstname.' '.$user_lastname.'</ul>';
						}
					?>
					
						<br>
						<h4><i class="fa fa-info-circle"></i> File Approval Details</h4>
							  <label>Total Count:</label> <?php 
			$completion_signatures = mysql_query("SELECT * FROM file_downloads WHERE user_id = '$ADMIN_USERID' && file_description = '$description'");
			$completion_signatures_show=mysql_fetch_array($completion_signatures);
			$total_approved = $completion_signatures_show['approval']; 			
			$total_signatories = $completion_signatures_show['total_signatory'];
			
			$count_approved = mysql_query("SELECT count(*) AS approvals FROM file_downloads WHERE user_id = '$ADMIN_USERID' && file_description = '$description' && notification_status = '0' && signatory != ''");
			$count_approved_view = mysql_fetch_array($count_approved); 
			$show_counts = $count_approved_view['approvals']; 
			echo	''.$show_counts.'/'.$total_signatories.' ';		?>
						<br>
						<h4><i class="fa fa-info-circle"></i> File Download Details</h4>
							  <label>Uploaded By:</label> <?php echo ''.$row['name'].''; ?>
						<br>
							  <label>Date Download:</label> <?php $date = strtotime(''.$row['date_download'].''); $new_date = date('F m, Y', $date); echo $new_date;?>
						<br>
							  <label>Time Download:</label> <?php echo date('h:i A', strtotime(''.$row['time_download'].'')); ?>
							  
					</div>
					<div class="modal-footer">
						<form method = "POST">
							<input type = "hidden" name = "file_with_approvals_id" value = "<?php echo ''.$row['id'].''; ?>">
							<input type = "hidden" name = "date_download" value = "<?php echo ''.$row['date_download'].''; ?>">
							<input type = "hidden" name = "time_download" value = "<?php echo ''.$row['time_download'].''; ?>">
							<input type = "hidden" name = "name" value = "<?php echo ''.$row['name'].''; ?>">
							<button class="btn btn-block btn-danger" name = "file_declined" type="submit"><i class="fa fa-thumbs-o-down"></i> Decline</button>
							<button class="btn btn-block btn-warning" name = "file_declined" type="submit"><i class="fa fa-recycle"></i> Revise</button>
							<button class="btn btn-block btn-success" name = "file_approved" type="submit"><i class="fa fa-thumbs-o-up"></i> Approve</button>
						</form>
					</div>
		</div>
	</div>
</div>
					<?php } ?>
					

<?php 	} ?>		
				
              </ul>
            </nav>
			
          </div>
        </div>
        <!-- /top navigation -->