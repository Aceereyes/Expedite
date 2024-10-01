<!DOCTYPE html>
<html lang="en">
<?php 
include '_connections/_database_connection.php';
include '_connections/_session_connection.php';
include '_partial/partial_head.php'; 
@$collegedepartment = $_GET['department'];

$ADMIN_SIDEBAR = $ADMIN_LOGIN_VIEW['user_priviledge'];
if($ADMIN_SIDEBAR != 'Admin' ){
	header("Location: index.php");
}
?>
  <body class="nav-md footer_fixed">
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
                    <h2><i class="fa fa-building"></i> LIST OF DEPARTMENT & COLLEGES</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-plus"></i> Add New Deparment</button>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
					</div>
                  <div class="x_content">
				  <?php
					if(isset($_POST['update_dept_details'])){
						$dept_id = $_POST['dept_id'];
						$old_dept_name = $_POST['old_dept_name'];
						$old_dept_code = $_POST['old_dept_code'];
						$old_email_signature = $_POST['old_email_signature'];
						$dept_name = $_POST['dept_name'];
						$dept_code = $_POST['dept_code'];
						$email_signature = $_POST['email_signature'];
								$CHECK_dept_code=mysql_query("SELECT * FROM collegesdepartment WHERE colleges_department_code='$dept_code' && colleges_department_name='$dept_name' && email_signature = '$email_signature'");
								$DISPLAYdeptcode=mysql_num_rows($CHECK_dept_code);
						if($DISPLAYdeptcode>0){
									echo '
									<div class="alert alert-danger alert-dismissible fade in" role="alert">
										<i class = "fa fa-info-circle"></i>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										Warning!
										</br>
										<b>DEPARTMENT NAME:</b> '.$dept_name.'
										</br>
										<b>DEPARTMENT CODE:</b> '.$dept_code.'
										</br>
										</br>
										<b>No changes has been made.</b>
									</div>';
									echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=deptcolleges_forms.php">';
									}else{
										mysql_query("UPDATE collegesdepartment SET colleges_department_name = '$dept_name', colleges_department_code = '$dept_code', email_signature = '$email_signature' WHERE id = $dept_id");
										mysql_query("UPDATE  sent_file SET dept_code = '$dept_code',dept_name = '$dept_name' where dept_code = '$old_dept_code'");
										mysql_query("UPDATE  file_uploads SET department_name = '$dept_name',department_code = '$dept_code' where department_code = '$old_dept_code'");
										mysql_query("UPDATE  file_downloads SET dept_code = '$dept_code',dept_name = '$dept_name' where dept_code = '$old_dept_code'");
										mysql_query("UPDATE  user_admins SET user_priviledge = '$dept_code',user_dept = '$dept_code' where dept_code = '$old_dept_code'");
									echo '
									<div class="alert alert-success alert-dismissible fade in" role="alert">
										<i class = "fa fa-info-circle"></i>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										<b>'.$dept_name.'</b> Information was successfully updated in our database.
									</div>';
										echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=deptcolleges_forms.php">';
									}
					}
					?>
                  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-building"></i> Add New Department/College</h4>
                        </div>
					<form method = "POST" id="demo-form" enctype="multipart/form-data" data-parsley-validate>
                        <div class="modal-body">
							  <label for="deptname">Name:</label>
							  <input onkeypress="return /[0-9a-zA-Z_ ]/i.test(event.key)" type="text" id="deptname" class="form-control" name="deptname" required />

							  <label for="deptcode">Code:</label>
							  <input onkeypress="return /[0-9a-zA-Z_ ]/i.test(event.key)" type="text" id="deptcode" class="form-control" name="deptcode" required />
							  
							  <label for="deptcode">Email Signature:</label>
							  <input onkeypress="return /[0-9a-zA-Z_ ]/i.test(event.key)" type="text" id="email_signature" class="form-control" name="email_signature" required />
							  
							  <label for="file_head">Letter Header:</label>
							  <input type="file" id="file_head" class="form-control" name="file_head" required />
							  
							  <label for="file_foot">Letter Footer:</label>
							  <input type="file" id="file_foot" class="form-control" name="file_foot" required />

						</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						  <button  type="submit" name = "add_new_department" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
                  <!-- /modals -->
				  <?php
				
if(isset($_POST['add_new_department'])){
	$deptname = $_POST['deptname'];
	$deptcode = $_POST['deptcode'];
	$email_signature = $_POST['email_signature'];
	$CHECK_dept=mysql_query("SELECT * FROM collegesdepartment WHERE colleges_department_name='$deptname' && colleges_department_code = '$deptcode'");
	$DISPLAYdept=mysql_num_rows($CHECK_dept);
	if($DISPLAYdept>0){
		echo '
		<div class="alert alert-danger alert-dismissible fade in" role="alert">
			<i class = "fa fa-info-circle"></i>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong>'.$deptname.'</strong> This file is already exist in our database.
		</div>';
	echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=deptcolleges_forms.php">';
	}else{
		
$file_head= addslashes(file_get_contents($_FILES['file_head']['tmp_name']));
$image_name= addslashes($_FILES['file_head']['name']);
$image_size= getimagesize($_FILES['file_head']['tmp_name']);
move_uploaded_file($_FILES["file_head"]["tmp_name"],"_photos/letterhead/".$_FILES["file_head"]["name"]);
$file_head=$_FILES["file_head"]["name"];

$file_foot= addslashes(file_get_contents($_FILES['file_foot']['tmp_name']));
$image_name= addslashes($_FILES['file_foot']['name']);
$image_size= getimagesize($_FILES['file_foot']['tmp_name']);
move_uploaded_file($_FILES["file_foot"]["tmp_name"],"_photos/letterhead/".$_FILES["file_foot"]["name"]);
$file_foot=$_FILES["file_foot"]["name"];

	$done = MYSQL_QUERY("INSERT INTO collegesdepartment (colleges_department_name,colleges_department_code,email_signature,letter_header,letter_footer) VALUES ('$deptname','$deptcode','$email_signature','$file_head','$file_foot')");
		echo '
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<i class = "fa fa-check-circle"></i>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong>'.$deptname.'</strong> Has been successfully added to our database.
		</div>';
	if($done){
	echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=deptcolleges_forms.php">';
	}
	}	
}

echo '
	<table id="datatable" class="table-hover table table-striped table-bordered">
		<thead>
			<tr>
				<th>Department Name</th>
				<th>Department Code</th>
				<th>Mail Signature</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		';
$sel = mysql_query("SELECT * FROM collegesdepartment");
while($row=mysql_fetch_array($sel))
{
echo '	
			<tr class="record">
				<td>'.$row['colleges_department_name'].'</td>
				<td>'.$row['colleges_department_code'].'</td>
				<td>'.$row['email_signature'].'</td>
				<td>
					<a data-toggle="modal" data-target=".bs-example-modal-download_file_'.$row['id'].'" class = "btn btn-xs btn-warning"><i class="fa fa-pencil"></i> Edit</a>
					<a href="#" id="'.$row['id'].'" title="Click To Delete" class = "delete_dept btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>					
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
						'.$row['colleges_department_name'].'
						<br>
						<br>
							  <input type="hidden" id="dept_id" class="form-control" name="dept_id" value = "'.$row['id'].'" />
							  <input type="hidden" id="old_dept_name" class="form-control" name="old_dept_name" value = "'.$row['colleges_department_name'].'" required />
							  <input type="hidden" id="old_dept_code" class="form-control" name="old_dept_code" value = "'.$row['colleges_department_code'].'" required />
							  <input type="hidden" id="old_email_signature" class="form-control" name="old_email_signature" value = "'.$row['email_signature'].'" required />
							  <label for="dept_name">Department Name:</label>
							  <input onkeypress="return /[0-9a-zA-Z_ ]/i.test(event.key)" type="text" id="dept_name" class="form-control" name="dept_name" value = "'.$row['colleges_department_name'].'" required />
							  <label for="dept_code">Department Code:</label>
							  <input onkeypress="return /[0-9a-zA-Z_ ]/i.test(event.key)" type="text" id="dept_code" class="form-control" name="dept_code" value = "'.$row['colleges_department_code'].'" required />
							  
							  <label for="deptcode">Email Signature:</label>
							  <textarea onkeypress="return /[0-9a-zA-Z_ ]/i.test(event.key)" type="text" id="email_signature" class="form-control" name="email_signature" required >'.$row['email_signature'].'</textarea>
							  
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
}
echo '
</tbody>
</table>';
?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
<?php include '_partial/partial_footer.php'; ?>
        <!-- /footer content -->
      </div>
    </div>
<script src="_plugins/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
$(".delete_dept").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
 if(confirm("Are you sure you want to delete this DEPARTMENT?"))
		  {
 $.ajax({
   type: "GET",
   url: "_delete/delete_dept.php",
   data: info,
   success: function(){   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
 }
return false;
});
});
</script>
<?php include '_partial/partial_footscripts_datatables.php'; ?>
  </body>
</html>

