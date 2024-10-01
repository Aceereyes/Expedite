<div class="x_title">
	<ul class="nav navbar-right panel_toolbox">
		<li><button type="button" class = "btn btn-sm btn-success" data-toggle="modal" data-target=".bs-example-modal-search-file"><i class="fa fa-search"></i> Search Record </button>
        </li>
	</ul>
	<div class="clearfix"></div>
</div>
<?php
if($ADMIN_PRIVILEDGE != 'Admin'){
								echo '
									<table id="datatable" class="table-hover table table-striped table-bordered">
										<thead>
											<tr>
												<th>DATE & TIME OF DOWNLOAD</th>
												<th>DOWNLOADED BY</th>
												<th>FILE TYPE</th>
												<th>FILE NAME</th>
												<th>DEPARTMENT/COLLEGE NAME</th>
											</tr>
										</thead>
										<tbody>';
										
			if(isset($_POST['search_file'])){
				$file_type = $_POST['file_type'];
				$date_from = $_POST['date_from']; 
				$date_to = $_POST['date_to'];
				if($file_type != 'ALL_FILES'){
								$sel = mysql_query("SELECT * FROM file_downloads WHERE file_type = '$file_type' && date_download between '$date_from' and '$date_to' && dept_code = '$ADMIN_DEPARTMENT' && dept_name = '$ADMIN_USER_DEPARTMENT' ORDER BY id DESC");
				}else{
								$sel = mysql_query("SELECT * FROM file_downloads WHERE date_download between '$date_from' and '$date_to' && dept_code = '$ADMIN_DEPARTMENT' && dept_name = '$ADMIN_USER_DEPARTMENT' ORDER BY id DESC");
				}				
								while($row=mysql_fetch_array($sel))
								{
								$file_id = ''.$row['id'].'';
								$userid = ''.$row['user_id'].'';
								$notification_status = ''.$row['notification_status'].'';
								$file_type = ''.$row['file_type'].'';
								echo '	
											<tr class="record" data-toggle="modal" data-target=".bs-example-modal-view_file_details'.$row['id'].'">
												<td>';
									echo date('F d, Y', strtotime(''.$row['date_download'].''));
									echo ' - ';
									echo date('h:i A', strtotime(''.$row['time_download'].''));
								echo '			</td>
												<td>';
												if($file_type == 'FILE_WITH_APPROVAL'){
													echo 'FILE WITH APPROVAL';
												}else{
													echo 'FILE WITHOUT APPROVAL';
												}
								echo '			</td>
												<td>'.$row['name'].'</td>
												<td>'.$row['file_description'].'</td>
												<td>'.$row['dept_name'].'</td>
											</tr>
										';
									echo '
												<div class="modal fade bs-example-modal-download_file_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog modal-sm">
													  <div class="modal-content">

														<div class="modal-header">
														  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
														  </button>
														  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-building"></i> Edit Department/College Details</h4>
														</div>
															<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
														<div class="modal-body">
															  <label for="slider_description">DEPARTMENT NAME:</label>
														<br>
														<br>
															  <input type="hidden" id="dept_id" class="form-control" name="dept_id" value = "'.$row['id'].'" />
															  <input type="hidden" id="old_dept_name" class="form-control" name="old_dept_name" value = "" required />
															  <input type="hidden" id="old_dept_code" class="form-control" name="old_dept_code" value = "" required />
															  <label for="dept_name">Department Name:</label>
															  <input onkeypress="return /[0-9a-zA-Z_ ]/i.test(event.key)" type="text" id="dept_name" class="form-control" name="dept_name" value = "" required />
															  <label for="dept_code">Department Code:</label>
															  <input onkeypress="return /[0-9a-zA-Z_ ]/i.test(event.key)" type="text" id="dept_code" class="form-control" name="dept_code" value = "" required />
														</div>
														<div class="modal-footer">
														  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
															<button  type="submit" name = "update_dept_details" class="btn btn-success" download><i class="fa fa-pencil"></i> Update</button>
														</div>
															</form>
													  </div>
													</div>
												  </div>
												  ';
			$file_type = ''.$row['file_type'].'';
			echo '
				<div class="modal fade bs-example-modal-view_file_details'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-download"></i> DOWNLOADED FILE DETAILS</h4>
                        </div>
                        <div class="modal-body">
						<h2>FILE INFORMATION</h2>
							  <label>FILE TYPE:</label>';
						if($file_type == 'FILE_WITH_APPROVAL'){
							echo ' FILE WITH APPROVAL';
						}elseif($file_type == 'FILE_WITHOUT_APPROVAL'){
							echo ' FILE WITHOUT APPROVAL';
						}
			echo '
						<br>
						<br>
							  <label>FILE NAME:</label> <a target = "_blank" href = "file_uploads/'.$row['file_name'].'">'.$row['file_name'].'</a>
						<br>
						<br>
							  <label>FILE DESCRIPTION:</label> '.$row['file_description'].'
						<br>
						<br>
							  <label>DEPARTMENT NAME:</label> '.$row['dept_name'].'
						<br>
						<br>
							  <label>DEPARTMENT CODE:</label> '.$row['dept_code'].'
						<br>
						<br>
						<label>NAME/S OF FILE SIGNATORIES:</label> ';
						$file_uploads_signatory = mysql_query("SELECT * FROM file_downloads WHERE id = '$file_id'");
						$file_uploads_signatoryt_view = mysql_fetch_array($file_uploads_signatory);
						$file_name = ''.$file_uploads_signatoryt_view['file_description'].'';
						$list_of_signatory = ''.$file_uploads_signatoryt_view['signatory'].'';
						if($list_of_signatory != ''){
						foreach(explode(' ' , $list_of_signatory) as $ing){
						$select_user_signatory = mysql_query("SELECT * FROM user_admins WHERE user_id LIKE '$ing'");
						while($select_user_signatory_view=mysql_fetch_array($select_user_signatory))
						{
						$signatory_name = ''.$select_user_signatory_view['user_firstname'].' '.$select_user_signatory_view['user_lastname'].', ';

						echo $signatory_name;
						}
						}
						}else{
							echo 'No signatories';
						}
						echo '
						<br>
						<br>
						<h2>USER\'S INFORMATION</h2>
							  <label>DOWNLOADED BY:</label> '.$row['name'].'
						<br>
						<br>
							  <label>EMAIL:</label> '.$row['email'].'
						<br>
						<br>';
						
						$file_downloads = mysql_query("SELECT * FROM user_admins WHERE user_id = '$userid'");
						$file_downloads_view = mysql_fetch_array($file_downloads);
						$priviledge = ''.$file_downloads_view['user_priviledge_level'].'';
						$list_of_signatory = ''.$file_downloads_view['user_dept'].'';
			echo '
							  <label>USER DEPARTMENT/COLLEGE NAME:</label> '.$row['dept_name'].'
						<br>
						<br>
							  <label>USER DEPARTMENT/COLLEGE CODE:</label> '.$row['dept_code'].'
						<br>
						<br>
							  <label>USER DEPARTMENT/COLLEGE PRIVILEDGE:</label> '.$priviledge.'
						<br>
						<br>
							  <label>DATE & TIME DOWNLOADED:</label><br>'; $date = strtotime(''.$row['date_download'].''); $new_date = date('F d, Y', $date); echo $new_date; echo ' - '; echo date('h:i A', strtotime(''.$row['time_download'].'')); echo '
						
						<br>
						<br>
							  
						</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
				  ';
				  }
			}else{
				
								$sel = mysql_query("SELECT * FROM file_downloads WHERE dept_code = '$ADMIN_DEPARTMENT' && dept_name = '$ADMIN_USER_DEPARTMENT' ORDER BY id DESC");
								while($row=mysql_fetch_array($sel))
								{
								$file_id = ''.$row['id'].'';
								$userid = ''.$row['user_id'].'';
								$notification_status = ''.$row['notification_status'].'';
								$file_type = ''.$row['file_type'].'';
								echo '	
											<tr class="record" data-toggle="modal" data-target=".bs-example-modal-view_file_details'.$row['id'].'">
												<td>';
									echo date('F d, Y', strtotime(''.$row['date_download'].''));
									echo ' - ';
									echo date('h:i A', strtotime(''.$row['time_download'].''));
								echo '			</td>
												<td>';
												if($file_type == 'FILE_WITH_APPROVAL'){
													echo 'FILE WITH APPROVAL';
												}else{
													echo 'FILE WITHOUT APPROVAL';
												}
								echo '			</td>
												<td>'.$row['name'].'</td>
												<td>'.$row['file_description'].'</td>
												<td>'.$row['dept_name'].'</td>
											</tr>
										';
									echo '
												<div class="modal fade bs-example-modal-download_file_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog modal-sm">
													  <div class="modal-content">

														<div class="modal-header">
														  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
														  </button>
														  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-building"></i> Edit Department/College Details</h4>
														</div>
															<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
														<div class="modal-body">
															  <label for="slider_description">DEPARTMENT NAME:</label>
														<br>
														<br>
															  <input type="hidden" id="dept_id" class="form-control" name="dept_id" value = "'.$row['id'].'" />
															  <input type="hidden" id="old_dept_name" class="form-control" name="old_dept_name" value = "" required />
															  <input type="hidden" id="old_dept_code" class="form-control" name="old_dept_code" value = "" required />
															  <label for="dept_name">Department Name:</label>
															  <input onkeypress="return /[0-9a-zA-Z_ ]/i.test(event.key)" type="text" id="dept_name" class="form-control" name="dept_name" value = "" required />
															  <label for="dept_code">Department Code:</label>
															  <input onkeypress="return /[0-9a-zA-Z_ ]/i.test(event.key)" type="text" id="dept_code" class="form-control" name="dept_code" value = "" required />
														</div>
														<div class="modal-footer">
														  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
															<button  type="submit" name = "update_dept_details" class="btn btn-success" download><i class="fa fa-pencil"></i> Update</button>
														</div>
															</form>
													  </div>
													</div>
												  </div>
												  ';
			$file_type = ''.$row['file_type'].'';
			echo '
				<div class="modal fade bs-example-modal-view_file_details'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-download"></i> DOWNLOADED FILE DETAILS</h4>
                        </div>
                        <div class="modal-body">
						<h2>FILE INFORMATION</h2>
							  <label>FILE TYPE:</label>';
						if($file_type == 'FILE_WITH_APPROVAL'){
							echo ' FILE WITH APPROVAL';
						}elseif($file_type == 'FILE_WITHOUT_APPROVAL'){
							echo ' FILE WITHOUT APPROVAL';
						}
			echo '
						<br>
						<br>
							  <label>FILE NAME:</label> <a target = "_blank" href = "file_uploads/'.$row['file_name'].'">'.$row['file_name'].'</a>
						<br>
						<br>
							  <label>FILE DESCRIPTION:</label> '.$row['file_description'].'
						<br>
						<br>
							  <label>DEPARTMENT NAME:</label> '.$row['dept_name'].'
						<br>
						<br>
							  <label>DEPARTMENT CODE:</label> '.$row['dept_code'].'
						<br>
						<br>
						<label>NAME/S OF FILE SIGNATORIES:</label> ';
						$file_uploads_signatory = mysql_query("SELECT * FROM file_downloads WHERE id = '$file_id'");
						$file_uploads_signatoryt_view = mysql_fetch_array($file_uploads_signatory);
						$file_name = ''.$file_uploads_signatoryt_view['file_description'].'';
						$list_of_signatory = ''.$file_uploads_signatoryt_view['signatory'].'';
						if($list_of_signatory != ''){
						foreach(explode(' ' , $list_of_signatory) as $ing){
						$select_user_signatory = mysql_query("SELECT * FROM user_admins WHERE user_id LIKE '$ing'");
						while($select_user_signatory_view=mysql_fetch_array($select_user_signatory))
						{
						$signatory_name = ''.$select_user_signatory_view['user_firstname'].' '.$select_user_signatory_view['user_lastname'].', ';

						echo $signatory_name;
						}
						}
						}else{
							echo 'No signatories';
						}
						echo '
						<br>
						<br>
						<h2>USER\'S INFORMATION</h2>
							  <label>DOWNLOADED BY:</label> '.$row['name'].'
						<br>
						<br>
							  <label>EMAIL:</label> '.$row['email'].'
						<br>
						<br>';
						
						$file_downloads = mysql_query("SELECT * FROM user_admins WHERE user_id = '$userid'");
						$file_downloads_view = mysql_fetch_array($file_downloads);
						$priviledge = ''.$file_downloads_view['user_priviledge_level'].'';
						$list_of_signatory = ''.$file_downloads_view['user_dept'].'';
			echo '
							  <label>USER DEPARTMENT/COLLEGE NAME:</label> '.$row['dept_name'].'
						<br>
						<br>
							  <label>USER DEPARTMENT/COLLEGE CODE:</label> '.$row['dept_code'].'
						<br>
						<br>
							  <label>USER DEPARTMENT/COLLEGE PRIVILEDGE:</label> '.$priviledge.'
						<br>
						<br>
							  <label>DATE & TIME DOWNLOADED:</label><br>'; $date = strtotime(''.$row['date_download'].''); $new_date = date('F d, Y', $date); echo $new_date; echo ' - '; echo date('h:i A', strtotime(''.$row['time_download'].'')); echo '
						
						<br>
						<br>
							  
						</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
				  ';
				  }
			}
								echo '
								</tbody>
								</table>';
}else{
	
								echo '
									<table id="datatable" class="table-hover table table-striped table-bordered">
										<thead>
											<tr>
												<th>DATE & TIME OF DOWNLOAD</th>
												<th>DOWNLOADED BY</th>
												<th>FILE TYPE</th>
												<th>FILE NAME</th>
												<th>DEPARTMENT/COLLEGE NAME</th>
											</tr>
										</thead>
										<tbody>';
										
			if(isset($_POST['search_file'])){
				$file_type = $_POST['file_type'];
				$date_from = $_POST['date_from']; 
				$date_to = $_POST['date_to'];
				if($file_type != 'ALL_FILES'){
								$sel = mysql_query("SELECT * FROM file_downloads WHERE file_type = '$file_type' && date_download between '$date_from' and '$date_to' ORDER BY id DESC");
				}else{
								$sel = mysql_query("SELECT * FROM file_downloads WHERE date_download between '$date_from' and '$date_to' ORDER BY id DESC");
				}				
								while($row=mysql_fetch_array($sel))
								{
								$file_id = ''.$row['id'].'';
								$userid = ''.$row['user_id'].'';
								$notification_status = ''.$row['notification_status'].'';
								$file_type = ''.$row['file_type'].'';
								echo '	
											<tr class="record" data-toggle="modal" data-target=".bs-example-modal-view_file_details'.$row['id'].'">
												<td>';
									echo date('F d, Y', strtotime(''.$row['date_download'].''));
									echo ' - ';
									echo date('h:i A', strtotime(''.$row['time_download'].''));
								echo '			</td>
												<td>';
												if($file_type == 'FILE_WITH_APPROVAL'){
													echo 'FILE WITH APPROVAL';
												}else{
													echo 'FILE WITHOUT APPROVAL';
												}
								echo '			</td>
												<td>'.$row['name'].'</td>
												<td>'.$row['file_description'].'</td>
												<td>'.$row['dept_name'].'</td>
											</tr>
										';
									echo '
												<div class="modal fade bs-example-modal-download_file_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog modal-sm">
													  <div class="modal-content">

														<div class="modal-header">
														  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
														  </button>
														  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-building"></i> Edit Department/College Details</h4>
														</div>
															<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
														<div class="modal-body">
															  <label for="slider_description">DEPARTMENT NAME:</label>
														<br>
														<br>
															  <input type="hidden" id="dept_id" class="form-control" name="dept_id" value = "'.$row['id'].'" />
															  <input type="hidden" id="old_dept_name" class="form-control" name="old_dept_name" value = "" required />
															  <input type="hidden" id="old_dept_code" class="form-control" name="old_dept_code" value = "" required />
															  <label for="dept_name">Department Name:</label>
															  <input onkeypress="return /[0-9a-zA-Z_ ]/i.test(event.key)" type="text" id="dept_name" class="form-control" name="dept_name" value = "" required />
															  <label for="dept_code">Department Code:</label>
															  <input onkeypress="return /[0-9a-zA-Z_ ]/i.test(event.key)" type="text" id="dept_code" class="form-control" name="dept_code" value = "" required />
														</div>
														<div class="modal-footer">
														  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
															<button  type="submit" name = "update_dept_details" class="btn btn-success" download><i class="fa fa-pencil"></i> Update</button>
														</div>
															</form>
													  </div>
													</div>
												  </div>
												  ';
			$file_type = ''.$row['file_type'].'';
			echo '
				<div class="modal fade bs-example-modal-view_file_details'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-download"></i> DOWNLOADED FILE DETAILS</h4>
                        </div>
                        <div class="modal-body">
						<h2>FILE INFORMATION</h2>
							  <label>FILE TYPE:</label>';
						if($file_type == 'FILE_WITH_APPROVAL'){
							echo ' FILE WITH APPROVAL';
						}elseif($file_type == 'FILE_WITHOUT_APPROVAL'){
							echo ' FILE WITHOUT APPROVAL';
						}
			echo '
						<br>
						<br>
							  <label>FILE NAME:</label> <a target = "_blank" href = "file_uploads/'.$row['file_name'].'">'.$row['file_name'].'</a>
						<br>
						<br>
							  <label>FILE DESCRIPTION:</label> '.$row['file_description'].'
						<br>
						<br>
							  <label>DEPARTMENT NAME:</label> '.$row['dept_name'].'
						<br>
						<br>
							  <label>DEPARTMENT CODE:</label> '.$row['dept_code'].'
						<br>
						<br>
						<label>NAME/S OF FILE SIGNATORIES:</label> ';
						$file_uploads_signatory = mysql_query("SELECT * FROM file_downloads WHERE id = '$file_id'");
						$file_uploads_signatoryt_view = mysql_fetch_array($file_uploads_signatory);
						$file_name = ''.$file_uploads_signatoryt_view['file_description'].'';
						$list_of_signatory = ''.$file_uploads_signatoryt_view['signatory'].'';
						if($list_of_signatory != ''){
						foreach(explode(' ' , $list_of_signatory) as $ing){
						$select_user_signatory = mysql_query("SELECT * FROM user_admins WHERE user_id LIKE '$ing'");
						while($select_user_signatory_view=mysql_fetch_array($select_user_signatory))
						{
						$signatory_name = ''.$select_user_signatory_view['user_firstname'].' '.$select_user_signatory_view['user_lastname'].', ';

						echo $signatory_name;
						}
						}
						}else{
							echo 'No signatories';
						}
						echo '
						<br>
						<br>
						<h2>USER\'S INFORMATION</h2>
							  <label>DOWNLOADED BY:</label> '.$row['name'].'
						<br>
						<br>
							  <label>EMAIL:</label> '.$row['email'].'
						<br>
						<br>';
						
						$file_downloads = mysql_query("SELECT * FROM user_admins WHERE user_id = '$userid'");
						$file_downloads_view = mysql_fetch_array($file_downloads);
						$priviledge = ''.$file_downloads_view['user_priviledge_level'].'';
						$list_of_signatory = ''.$file_downloads_view['user_dept'].'';
			echo '
							  <label>USER DEPARTMENT/COLLEGE NAME:</label> '.$row['dept_name'].'
						<br>
						<br>
							  <label>USER DEPARTMENT/COLLEGE CODE:</label> '.$row['dept_code'].'
						<br>
						<br>
							  <label>USER DEPARTMENT/COLLEGE PRIVILEDGE:</label> '.$priviledge.'
						<br>
						<br>
							  <label>DATE & TIME DOWNLOADED:</label><br>'; $date = strtotime(''.$row['date_download'].''); $new_date = date('F d, Y', $date); echo $new_date; echo ' - '; echo date('h:i A', strtotime(''.$row['time_download'].'')); echo '
						
						<br>
						<br>
							  
						</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
				  ';
				  }
			}else{
								$sel = mysql_query("SELECT * FROM file_downloads ORDER BY id DESC");
								while($row=mysql_fetch_array($sel))
								{
								$file_id = ''.$row['id'].'';
								$userid = ''.$row['user_id'].'';
								$notification_status = ''.$row['notification_status'].'';
								$file_type = ''.$row['file_type'].'';
								echo '	
											<tr class="record" data-toggle="modal" data-target=".bs-example-modal-view_file_details'.$row['id'].'">
												<td>';
									echo date('F d, Y', strtotime(''.$row['date_download'].''));
									echo ' - ';
									echo date('h:i A', strtotime(''.$row['time_download'].''));
								echo '			</td>
												<td>';
												if($file_type == 'FILE_WITH_APPROVAL'){
													echo 'FILE WITH APPROVAL';
												}else{
													echo 'FILE WITHOUT APPROVAL';
												}
								echo '			</td>
												<td>'.$row['name'].'</td>
												<td>'.$row['file_description'].'</td>
												<td>'.$row['dept_name'].'</td>
											</tr>
										';
									echo '
												<div class="modal fade bs-example-modal-download_file_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog modal-sm">
													  <div class="modal-content">

														<div class="modal-header">
														  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
														  </button>
														  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-building"></i> Edit Department/College Details</h4>
														</div>
															<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
														<div class="modal-body">
															  <label for="slider_description">DEPARTMENT NAME:</label>
														<br>
														<br>
															  <input type="hidden" id="dept_id" class="form-control" name="dept_id" value = "'.$row['id'].'" />
															  <input type="hidden" id="old_dept_name" class="form-control" name="old_dept_name" value = "" required />
															  <input type="hidden" id="old_dept_code" class="form-control" name="old_dept_code" value = "" required />
															  <label for="dept_name">Department Name:</label>
															  <input onkeypress="return /[0-9a-zA-Z_ ]/i.test(event.key)" type="text" id="dept_name" class="form-control" name="dept_name" value = "" required />
															  <label for="dept_code">Department Code:</label>
															  <input onkeypress="return /[0-9a-zA-Z_ ]/i.test(event.key)" type="text" id="dept_code" class="form-control" name="dept_code" value = "" required />
														</div>
														<div class="modal-footer">
														  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
															<button  type="submit" name = "update_dept_details" class="btn btn-success" download><i class="fa fa-pencil"></i> Update</button>
														</div>
															</form>
													  </div>
													</div>
												  </div>
												  ';
			$file_type = ''.$row['file_type'].'';
			echo '
				<div class="modal fade bs-example-modal-view_file_details'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-download"></i> DOWNLOADED FILE DETAILS</h4>
                        </div>
                        <div class="modal-body">
						<h2>FILE INFORMATION</h2>
							  <label>FILE TYPE:</label>';
						if($file_type == 'FILE_WITH_APPROVAL'){
							echo ' FILE WITH APPROVAL';
						}elseif($file_type == 'FILE_WITHOUT_APPROVAL'){
							echo ' FILE WITHOUT APPROVAL';
						}
			echo '
						<br>
						<br>
							  <label>FILE NAME:</label> <a target = "_blank" href = "file_uploads/'.$row['file_name'].'">'.$row['file_name'].'</a>
						<br>
						<br>
							  <label>FILE DESCRIPTION:</label> '.$row['file_description'].'
						<br>
						<br>
							  <label>DEPARTMENT NAME:</label> '.$row['dept_name'].'
						<br>
						<br>
							  <label>DEPARTMENT CODE:</label> '.$row['dept_code'].'
						<br>
						<br>
						<label>NAME/S OF FILE SIGNATORIES:</label> ';
						$file_uploads_signatory = mysql_query("SELECT * FROM file_downloads WHERE id = '$file_id'");
						$file_uploads_signatoryt_view = mysql_fetch_array($file_uploads_signatory);
						$file_name = ''.$file_uploads_signatoryt_view['file_description'].'';
						$list_of_signatory = ''.$file_uploads_signatoryt_view['signatory'].'';
						if($list_of_signatory != ''){
						foreach(explode(' ' , $list_of_signatory) as $ing){
						$select_user_signatory = mysql_query("SELECT * FROM user_admins WHERE user_id LIKE '$ing'");
						while($select_user_signatory_view=mysql_fetch_array($select_user_signatory))
						{
						$signatory_name = ''.$select_user_signatory_view['user_firstname'].' '.$select_user_signatory_view['user_lastname'].', ';

						echo $signatory_name;
						}
						}
						}else{
							echo 'No signatories';
						}
						echo '
						<br>
						<br>
						<h2>USER\'S INFORMATION</h2>
							  <label>DOWNLOADED BY:</label> '.$row['name'].'
						<br>
						<br>
							  <label>EMAIL:</label> '.$row['email'].'
						<br>
						<br>';
						
						$file_downloads = mysql_query("SELECT * FROM user_admins WHERE user_id = '$userid'");
						$file_downloads_view = mysql_fetch_array($file_downloads);
						$priviledge = ''.$file_downloads_view['user_priviledge_level'].'';
						$list_of_signatory = ''.$file_downloads_view['user_dept'].'';
			echo '
							  <label>USER DEPARTMENT/COLLEGE NAME:</label> '.$row['dept_name'].'
						<br>
						<br>
							  <label>USER DEPARTMENT/COLLEGE CODE:</label> '.$row['dept_code'].'
						<br>
						<br>
							  <label>USER DEPARTMENT/COLLEGE PRIVILEDGE:</label> '.$priviledge.'
						<br>
						<br>
							  <label>DATE & TIME DOWNLOADED:</label><br>'; $date = strtotime(''.$row['date_download'].''); $new_date = date('F d, Y', $date); echo $new_date; echo ' - '; echo date('h:i A', strtotime(''.$row['time_download'].'')); echo '
						
						<br>
						<br>
							  
						</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
				  ';
				  }
			}
								echo '
								</tbody>
								</table>';
}
								?>
<div class="modal fade bs-example-modal-search-file" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2"><i class="fa fa-search"></i> SEARCH DOWNLOADS <b><?php echo $collegedepartment; ?></b></h4>
			</div>
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="modal-body">
							<label for="files[]">FILE TYPE:</label>
							<select required class="form-control" name="file_type" id = "user_staff_priviledge" >
								<option value = "ALL_FILES">ALL FILES</option>
								<option value = "FILE_WITH_APPROVAL">WITH APPROVAL</option>
								<option value = "FILE_WITHOUT_APPROVAL">WITHOUT APPROVAL</option>
							</select>			
							<label for="date_from">FROM DATE:</label>
							<input class = "form-control" type="date" name="date_from" value = "<?php echo''.date('Y-m-d').''; ?>"/>
							
							<label for="date_to">TO DATE:</label>
							<input class = "form-control" type="date" name="date_to" value = "<?php echo''.date('Y-m-d').''; ?>"/>
							
					</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
							<button class="btn btn-success" name = "search_file" type="submit"><i class="fa fa-search"></i> Search</button>
                        </div>
				</form>
		</div>
	</div>
</div>