<?php
								echo '
									<table id="datatable-fixed-header" class="table-hover table table-striped table-bordered">
										<thead>
											<tr>
												<th>FILE NAME</th>
												<th>DEPARTMENT/COLLEGE NAMES</th>
												<th>DATE & TIME OF DOWNLOAD</th>
												<th>STATUS</th>
												<th>ACTION</th>
											</tr>
										</thead>
										<tbody>
										';
								$sel = mysql_query("SELECT * FROM file_with_approvals WHERE signatory != '' && signatory = '$ADMIN_USERID' ORDER BY id DESC");
								while($row=mysql_fetch_array($sel))
								{
								$file_id = ''.$row['id'].'';
								$file_description = ''.$row['file_description'].'';
								$user_ids = ''.$row['user_id'].'';
								$notification_status = ''.$row['notification_status'].'';
								$approval = ''.$row['approval'].'';
								$total_signatory = ''.$row['total_signatory'].'';
								echo '	
											<tr class="record ';
											if ($notification_status == 1){
												echo 'warning';
											}else{
												echo 'success';
											}
								echo '" >
												<td data-toggle="modal" data-target=".bs-example-modal-view_file_details_withapproval'.$row['id'].'">'.$row['file_description'].'</td>
												<td data-toggle="modal" data-target=".bs-example-modal-view_file_details_withapproval'.$row['id'].'">'.$row['dept_name'].'</td>
												<td data-toggle="modal" data-target=".bs-example-modal-view_file_details_withapproval'.$row['id'].'">';
									echo date('F d, Y', strtotime(''.$row['date_download'].''));
									echo ' - ';
									echo date('h:i A', strtotime(''.$row['time_download'].''));
								echo '			</td>
												<td data-toggle="modal" data-target=".bs-example-modal-view_file_details_withapproval'.$row['id'].'">';
													if($approval == $total_signatory){
														echo '<span class="label label-success"> DONE '.$approval.'/'.$total_signatory.'</span>';
													}else{
														echo '<span class="label label-warning"> PENDING '.$approval.'/'.$total_signatory.'</span>';
													}
								echo '
												</td>
												<td>
													<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target=".bs-example-modal-file_withapproval_approved'.$row['id'].'"><i class="fa fa-check"></i> APPROVE</button>
													<button  type="submit" name = "update_dept_details" class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> REVISE</button>
													<button  type="submit" name = "update_dept_details" class="btn btn-danger btn-xs"><i class="fa fa-time"></i> DECLINE</button>
												</td>
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
				<div class="modal fade bs-example-modal-view_file_details_withapproval'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-send"></i> RECEIVED FILE DETAILS</h4>
                        </div>
                        <div class="modal-body">
						<h2>FILE INFORMATION</h2>
							  <label>FILE TYPE:</label>';
						if($file_type == 'FILE_WITH_APPROVAL'){
							echo 'FILE WITH APPROVAL';
						}elseif($file_type == 'FILE_WITHOUT_APPROVAL'){
							echo 'FILE WITHOUT APPROVAL';
						}
			echo '
						<br>
						<br>
							  <label>FILE NAME:</label> '.$row['file_name'].'
						<br>
						<br>
							  <label>DESCRIPTION:</label> '.$row['file_description'].'
						<br>
						<br>
							  <label>DEPARTMENT/COLLEGE NAME:</label> '.$row['dept_name'].'
						<br>
						<br>
							  <label>DEPARTMENT/COLLEGE CODE:</label> '.$row['dept_code'].'
						<br>
						<br>
							  <label>UPLOADED BY:</label> '.$row['name'].'
						<br>
						<br>
							  <label>NAME/S OF FILE SIGNATORIES:</label> ';
						$file_uploads_signatory = mysql_query("SELECT * FROM sent_file WHERE description = '$file_description'");
						$file_uploads_signatoryt_view = mysql_fetch_array($file_uploads_signatory);
						$file_name = ''.$file_uploads_signatoryt_view['description'].'';
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
						<br>';
						$file_sender = mysql_query("SELECT * FROM user_admins WHERE user_id = '$user_ids'");
						$file_sender_view = mysql_fetch_array($file_sender);
						$user_department = ''.$file_sender_view['user_dept'].'';
						$user_priviledge = ''.$file_sender_view['user_priviledge'].'';
						$user_priviledge_level = ''.$file_sender_view['user_priviledge_level'].'';
						$user_firstname = ''.$file_sender_view['user_firstname'].'';
						$user_middlename = ''.$file_sender_view['user_middlename'].'';
						$user_lastname = ''.$file_sender_view['user_lastname'].'';
						$user_email = ''.$file_sender_view['user_email'].'';
			echo'
						<h2>SENDER\'S INFORMATION</h2>
							  <label>NAME:</label> '.$user_firstname.' '.$user_middlename.' '.$user_lastname.'
						<br>
						<br>
							  <label>EMAIL:</label> '.$user_email.'
						<br>
						<br>
							  <label>USER DEPARTMENT/COLLEGE NAME:</label> '.$user_department.'
						<br>
						<br>
							  <label>USER DEPARTMENT/COLLEGE CODE:</label> '.$user_priviledge.'
						<br>
						<br>
							  <label>USER DEPARTMENT/COLLEGE PRIVILEDGE:</label> '.$user_priviledge_level.'
						<br>
						<br>
							  <label>DATE & TIME SENT:</label><br>'; $date = strtotime(''.$row['date_download'].''); $new_date = date('F d, Y', $date); echo $new_date; echo ' - '; echo date('h:i A', strtotime(''.$row['time_download'].'')); echo '
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
				  
				  echo '
                  <div class="modal fade bs-example-modal-file_withapproval_approved'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Modal title</h4>
                        </div>
                        <div class="modal-body">
                          <h4>Text in a modal</h4>
                          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                          <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>

                      </div>
                    </div>
                  </div>
				  ';
								}
								echo '
								</tbody>
								</table>';
								?>