<?php 
include '_connections/_database_connection.php';
include '_connections/_session_connection.php';
include '_partial/partial_head.php'; 
?>
<!DOCTYPE html>
<html lang="en">
	<link rel="stylesheet" href="/richtexteditor/rte_theme_default.css" />
	<script type="text/javascript" src="/richtexteditor/rte.js"></script>
	<script type="text/javascript" src='/richtexteditor/plugins/all_plugins.js'></script>
	
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
<?php include '_partial/partial_logo_user.php'; ?>
            <!-- /menu profile quick info -->
            <br />
<?php include '_sidebars/_sidebar_global.php'; ?>
          </div>
        </div>
<?php include '_partial/partial_navbar.php'; ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-users"></i> Employee</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button type="button" class = "btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg-add_employee"><i class="fa fa-plus"></i> Add Employee</button>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="">
					
                    </div>
                    <div class="">
                      <!-- Tab panes -->
                      <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active" id="about">
								<p>
								<?php
					if(isset($_POST['add_employee'])){
							$firstName = $_POST['firstName'];
							$lastName = $_POST['lastName'];
							$rate = $_POST['rate'];
							$email = $_POST['email'];
							$password = $_POST['password'];
							$department = $_POST['department'];
							$position = $_POST['position'];
							$sss = $_POST['sss'];
							$pagibig = $_POST['pagibig'];
							$philhealth = $_POST['philhealth'];
							
							/*$file=$_FILES['productphoto']['tmp_name'];
							$productphoto= addslashes(file_get_contents($_FILES['productphoto']['tmp_name']));
							$image_name= addslashes($_FILES['productphoto']['name']);
							$image_size= getimagesize($_FILES['productphoto']['tmp_name']);

							mkdir('_photos/products/'.$productname.'');
							
							move_uploaded_file($_FILES["productphoto"]["tmp_name"],"_photos/products/".$productname."/" . $_FILES["productphoto"]["name"]);
							
							$productphoto=$_FILES["productphoto"]["name"];
						
									function generateRandomString($length = 5){
									$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$charactersLength = strlen($characters);
									$randomString = '';
									for ($i = 0; $i < $length; $i++) {
										$randomString .= $characters[rand(0, $charactersLength - 1)];
										}
										return $randomString;
										}*/
						$check_user = mysqli_query($conn, "SELECT * FROM tbl_hr_employees WHERE firstName = '$firstName' && lastName = '$lastName'");
							if(mysqli_num_rows($check_user) > 0){
								echo '
									<div class="alert alert-warning alert-dismissible fade in" role="alert">
										<i class = "fa fa-check-circle"></i> <b>EXISTING EMPLOYEE!</b>
										</br>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										Employee <b>'.$firstName.' '.$lastName.'</b> is already exist.
										</br>
									</div>';
								echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=hrinternal.php">';
							}else{
							mysqli_query($conn, "INSERT into tbl_hr_employees (firstName,lastName,rate,email,department,position,sss,pagibig,philhealth)
							VALUES
							('$firstName','$lastName','$rate','$email','$department','$position','$sss','$pagibig','$philhealth')");
								
						$user_password_enc = password_hash($password, PASSWORD_DEFAULT);
							mysqli_query($conn, "INSERT into tbl_admins (firstName,lastName,email,username_user,password,department,priviledge)
							VALUES
							('$firstName','$lastName','$email','$email','$user_password_enc','$department','$department')");
							
									echo '
									<div class="alert alert-success alert-dismissible fade in" role="alert">
										<i class = "fa fa-check-circle"></i> <b>NEW PRODUCT!</b>
										</br>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										Employee <b>'.$firstName.' '.$lastName.'</b> has been successfully added.
										</br>
									</div>';
									echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=hrinternal.php">';
							}	
					}
					
					
								
				  if(isset($_POST['reply_user'])){	 
						$inbox_id = $_POST['inbox_id'];
						$name = $_POST['name'];
						$email = $_POST['email'];
						$subject = $_POST['subject'];
						$message = $_POST['message'];
						$created_at = $_POST['created_at'];
						
						$reply_name = ''.$name.'';
						$contactinformation_email = $_POST['contactinformation_email'];
						$reply_subject = 'REPLY - '.$subject.'';
						$reply_message = $_POST['reply_message'];
						$reply_date = date("F d, Y - h:i A");
						
						
            $subject = $_POST['subject'];
            $content = $_POST['message'];

						mysqli_query($conn, "INSERT INTO tbl_crm_reply 	(inbox_id, name, email, subject, message, date, reply_name, reply_email, reply_subject, reply_message, created_at)
								VALUES('.$inbox_id.','$name','$email','$subject','$message','$created_at','$reply_name','$contactinformation_email','$reply_subject','$reply_message','$reply_date')");
					
						
						//include 'mail.php';
						echo '
						<div class="alert alert-success alert-dismissible fade in" role="alert">
							<i class = "fa fa-info-circle"></i>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							Message has been successfully sent to <b>'.$name.' - '.$email.'</b>.
						</div>
							<meta http-equiv="refresh" content="3; url=inquiries.php">
						';
				  }
				  
				  if(isset($_POST['update_employee_details'])){
						$id = $_POST['id'];
						$firstName = $_POST['firstName'];
						$lastName = $_POST['lastName'];
						$rate = $_POST['rate'];
						$email = $_POST['email'];
						$department = $_POST['department'];
						$position = $_POST['position'];
						$password = $_POST['password'];
						
							mysqli_query($conn, "UPDATE tbl_hr_employees SET 
							firstName = '$firstName', 
							lastName = '$lastName', 
							rate = '$rate', 
							email = '$email', 
							department = '$department', 
							position = '$position',
							password = '$password'
							WHERE id = '$id'");
							echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=hrinternal.php">';
						
						}
						
					echo '
						<table id="datatable" class="table-hover table table-striped table-bordered">
							<thead>
								<tr>
									<th>Name</th>
									<th>Rate</th>
									<th>Email</th>
									<th>Department</th>
									<th>Position</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							';
					$message=mysqli_query($conn, "SELECT * FROM tbl_hr_employees");
					while($row=mysqli_fetch_array($message))
					{
					echo '	
								<tr class="record">
									<td>'.$row['firstName'].' '.$row['lastName'].'</td>
									<td>₱'.$row['rate'].'</td>
									<td>'.$row['email'].'</td>
									<td>'.$row['department'].'</td>
									<td>'.$row['position'].'</td>
									<td>
										<a data-toggle="modal" data-target=".bs-example-modal-view_user_'.$row['id'].'" class = "btn btn-xs btn-info"><i class="fa fa-eye"></i> View</a>
										<a data-toggle="modal" data-target=".bs-example-modal-edit_user_'.$row['id'].'" class = "btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Edit</a>
									</td>
								</tr>
							';
							echo '
                  <div class="modal fade bs-example-modal-view_user_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-eye"></i> View Employee Details</h4>
                        </div>
							<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
                        
											<div class="modal-body">
												  <label>Name:</label>
												  <br>
												  '.$row['firstName'].' '.$row['lastName'].'
												  <br>
												  <br>
												  <label>Rate:</label>
												  <br>
												  '.$row['rate'].'
												  <br>
												  <br><label>Department:</label>
												  <br>
												  '.$row['department'].'
												  <br>
												  <br><label>Position:</label>
												  <br>
												  '.$row['position'].'
												  <br>
												  <br>
												  <label>Email:</label>
												  <br>
												  '.$row['email'].'
												  <br>
												  <br><label>Password:</label>
												  <br>
												  '.$row['password'].'
												  <br>
												  <br>
												  <label>Date & Time Created:</label>
												  <br>
												  '.$row['created_at'].'
												  <br>
												  <br>
											</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
							</form>
                      </div>
                    </div>
                  </div>';
						echo '
                  <div class="modal fade bs-example-modal-edit_user_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-pecil"></i> Modify Employee Details</h4>
                        </div>
							<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
                        
											<div class="modal-body">
												  
												  
							  <form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
								<div class="modal-body">
									<input type="hidden" class="form-control" name="id" value = "'.$row['id'].'" />
									<div class=" form-group has-feedback">
										<label for = "firstName">FIRSTNAME:</label>
										<input required type="text" id="firstName" class="form-control" name="firstName" value = "'.$row['firstName'].'" required />
									</div>
									<div class=" form-group has-feedback">
										<label for="lastName">LASTNAME:</label>
										<input type="text" id="lastName" class="form-control" name="lastName" value = "'.$row['lastName'].'" required />
									</div>
									<div class=" form-group has-feedback">
										<label for="rate">RATE:</label>
										<input type="text" id="rate" class="form-control" name="rate" value = "'.$row['rate'].'" />
									</div>
									<div class=" form-group has-feedback">
										<label for="department">DEPARTMENT:</label>
										
										<select name = "department" class = "form-control">
											<option>'.$row['department'].'</option>
											<option>HR Internal</option>
											<option>HR External</option>
											<option>Marketing and Advertising</option>
											<option>Accounting and Finance</option>
											<option>IT</option>
											<option>Admin</option>

										</select>
									</div>
									<div class=" form-group has-feedback">
										<label for="position">POSITION:</label>
										<select name = "position" class = "form-control">
											<option>'.$row['position'].'</option>
											<option>HR Manager</option>
											<option>HR Gemera;ost</option>
											<option>HR Specialist</option>
											<option>HR Assistant</option>
											<option>Accounting Manager</option>
											<option>Accountant</option>
											<option>Accounting Specialist</option>
											<option>Accounting Assistant</option>
											<option>Head of Marketing</option>
											<option>Marketing Specialist</option>
											<option>Marketing Executive</option>
											<option>Network Administrator</option>
											<option>System Administrator</option>
											<option>Technical Support</option>
											<option>Executive Assistant</option>
										</select>
									</div>
									
									<div class=" form-group has-feedback">
										<label for="email">EMAIL:</label>
										<input onkeypress="return /[0-9a-zA-Z @ _ .]/i.test(event.key)" type="text" id="email" class="form-control" name="email" value = "'.$row['email'].'" />
									</div>
									
									<div class=" form-group has-feedback">
										<label for="password">PASSWORD:</label>
										<input type="text" id="email" class="form-control" name="password" value = "'.$row['password'].'" />
									</div>
								</div> 
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
									<button  type="submit" name = "update_employee_details" class="btn btn-success" download><i class="fa fa-pencil"></i> Update</button>
								</div>
							</form>
											</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
							</form>
                      </div>
                    </div>
                  </div>';
					}
					echo '
					</tbody>
					</table>';
					?>
								
								</p>
                        </div>
                      </div>
                    </div>

                    <div class="clearfix"></div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
		
					<div class="modal fade bs-example-modal-lg-add_employee" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
									<h4 class="modal-title" id="myModalLabel2"><i class="fa fa-users"></i> Add Employee</h4>
								</div>
								<form method = "POST" enctype="multipart/form-data">
									<div class="modal-body">
										<label>Name:</label>
										<input type = "text" placeholder = "Name" name = "firstName" class = "form-control"/>
										<br>
										<label>Last Name:</label>
										<input type = "text" placeholder = "Last Name" name = "lastName" class = "form-control"/>
										<br>
										<label>Rate:</label>
										<input type = "text" placeholder = "Rate" name = "rate" class = "form-control"/>
										<br>
										<label>Department:</label>
										<select name = "department" class = "form-control">
											<option>HR Internal</option>
											<option>HR External</option>
											<option>Marketing and Advertising</option>
											<option>Accounting and Finance</option>
											<option>IT</option>
											<option>Admin</option>
										
										</select>
										<br>
										<label>Position:</label>
										<select name = "position" class = "form-control">
											<option>HR Manager</option>
											<option>HR Gemera;ost</option>
											<option>HR Specialist</option>
											<option>HR Assistant</option>
											<option>Accounting Manager</option>
											<option>Accountant</option>
											<option>Accounting Specialist</option>
											<option>Accounting Assistant</option>
											<option>Head of Marketing</option>
											<option>Marketing Specialist</option>
											<option>Marketing Executive</option>
											<option>Network Administrator</option>
											<option>System Administrator</option>
											<option>Technical Support</option>
											<option>Executive Assistant</option>
										</select>
										<br>
										<label>SSS:</label>
										<input type = "text" placeholder = "SSS" name = "sss" class = "form-control"/>
										<br>
										<label>Pagibig:</label>
										<input type = "text" placeholder = "Pagibig" name = "pagibig" class = "form-control"/>
										<br>
										<label>Philhealth:</label>
										<input type = "text" placeholder = "Philhealth" name = "philhealth" class = "form-control"/>
										<label>Email:</label>
										<input type = "text" placeholder = "Email" name = "email" class = "form-control"/>
										<br>
										<label>Password:</label>
										<input type = "text" placeholder = "Password" name = "password" class = "form-control"/>
										<br>
										</div>
										<br>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
											<button type="submit" name = "add_employee" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
										</div>
									</form>
							</div>
						</div>
					</div>
					
					
        <!-- footer content -->
<?php include '_partial/partial_footer.php'; ?>
        <!-- /footer content -->
      </div>
    </div>
<?php include '_partial/partial_footscripts.php'; ?>
  </body>
</html>
