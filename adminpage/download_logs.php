<!DOCTYPE html>
<html lang="en">
<?php 
include '_connections/_database_connection.php';
include '_connections/_session_connection.php';
include '_partial/partial_head.php'; 
@$collegedepartment = $_GET['department'];
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
                    <h2><i class="fa fa-file"></i> <b><?php echo $collegedepartment; ?></b> DOWNLOAD LOG FORMS</h2>
                    <ul class="nav navbar-right panel_toolbox">
					  <li><button type="button" class = "btn btn-sm btn-success" data-toggle="modal" data-target=".bs-example-modal-search-file"><i class="fa fa-search"></i> Search Record </button>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
					</div>
                  <div class="x_content">
				  <?php
			if(isset($_POST['search_file'])){
			@$file_description = $_POST['file_description'];
			if($file_description != ''){
			if($file_description == 'all_files'){
			$date_from = $_POST['date_from'];
			$date_to = $_POST['date_to'];

			$count_form_downloads = mysql_query("SELECT count(*) AS file_downloads FROM file_downloads WHERE date_download between '$date_from' and '$date_to'");
			$count_form_downloads_show=mysql_fetch_array($count_form_downloads);
			$total_forms = $count_form_downloads_show['file_downloads']; 

			$count_form_sent = mysql_query("SELECT count(*) AS file_sent FROM sent_file WHERE date_sent between '$date_from' and '$date_to'");
			$count_form_sent_show=mysql_fetch_array($count_form_sent);
			$total_forms_sent = $count_form_sent_show['file_sent']; ?>

                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month"><?php echo date('M', strtotime($date_from)); ?></p>
                        <p class="day"><?php echo date('d', strtotime($date_from)); ?></p>
						<span class = "month"><center><?php echo date('Y', strtotime($date_from)); ?></center></span>
                      </a>
                      <a class="pull-left date">
                        <p class="month"><?php echo date('M', strtotime($date_to)); ?></p>
                        <p class="day"><?php echo date('d', strtotime($date_to)); ?></p>
						<span class = "month"><center><?php echo date('Y', strtotime($date_to)); ?></center></span>
                      </a>
                      <div class="media-body">
                        <p class="title"><b><?php echo date('F d, Y', strtotime($date_from)); ?> - <?php echo date('F d, Y', strtotime($date_to)); ?></b></p>
                        <p><b><?php echo $collegedepartment; ?></b> got <b><?php echo $total_forms; ?></b> total downloads and <b><?php echo $total_forms_sent; ?></b> received.</p>
						<form method = "POST" target="_blank" action = "_pdf/fullreport.php">
						<input type = "hidden" name = "file_description" value = "<?php echo $file_description; ?>" />
						<input type = "hidden" name = "date_from" value = "<?php echo $date_from; ?>" />
						<input type = "hidden" name = "date_to" value = "<?php echo $date_to; ?>" />
							<button name = "find_report" class="btn btn-xs btn-success"><i class="fa fa-download"></i> <i class="fa fa-print"></i> Click to download <b><?php echo $file_description; ?></b> report</button>
						</form>
					  </div>
                    </article>
					<div class="divider"></div>
					<table id="datatable" class="table table-bordered">
								<thead>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>File Name</th>
										<th>Date</th>
										<th>File Description</th>
									</tr>
								</thead>
								<tbody>
			<?php
			if(isset($_POST['search_file'])){
				$file_description = $_POST['file_description'];
				$date_from = $_POST['date_from']; 
				$date_to = $_POST['date_to'];
			$sel = mysql_query("SELECT * FROM file_downloads WHERE date_download between '$date_from' and '$date_to'");
			while($row=mysql_fetch_array($sel))
			{
								echo '	
									<tr>
										<td>'.$row['name'].'</td>
										<td>'.$row['email'].'</td>
										<td>'.$row['file_name'].'</td>
										<td>'.$row['date_download'].'</td>
										<td>'.$row['file_description'].'</td>
									</tr>';
			}
			}
							?>
								</tbody>
					</table>
<?php
}else{
$date_from = $_POST['date_from'];
$date_to = $_POST['date_to'];
$count_form_downloads = mysql_query("SELECT count(*) AS file_downloads FROM file_downloads WHERE file_description = '$file_description' && date_download between '$date_from' and '$date_to'");
$count_form_downloads_show=mysql_fetch_array($count_form_downloads);
$total_forms = $count_form_downloads_show['file_downloads']; 

$count_form_sent = mysql_query("SELECT count(*) AS file_sent FROM sent_file WHERE description = '$file_description' && date_sent between '$date_from' and '$date_to'");
$count_form_sent_show=mysql_fetch_array($count_form_sent);
$total_forms_sent = $count_form_sent_show['file_sent']; 
?>
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month"><?php echo date('M', strtotime($date_from)); ?></p>
                        <p class="day"><?php echo date('d', strtotime($date_from)); ?></p>
						<span class = "month"><center><?php echo date('Y', strtotime($date_from)); ?></center></span>
                      </a>
                      <a class="pull-left date">
                        <p class="month"><?php echo date('M', strtotime($date_to)); ?></p>
                        <p class="day"><?php echo date('d', strtotime($date_to)); ?></p>
						<span class = "month"><center><?php echo date('Y', strtotime($date_to)); ?></center></span>
                      </a>
                      <div class="media-body">
                        <p class="title"><b><?php echo date('F d, Y', strtotime($date_from)); ?> - <?php echo date('F d, Y', strtotime($date_to)); ?></b></p>
                        <p><b><?php echo $file_description; ?></b> got <b><?php echo $total_forms; ?></b> total downloads and <b><?php echo $total_forms_sent; ?></b> received.</p>
						<form method = "POST" target="_blank" action = "_pdf/index.php">
						<input type = "hidden" name = "file_description" value = "<?php echo $file_description; ?>" />
						<input type = "hidden" name = "date_from" value = "<?php echo $date_from; ?>" />
						<input type = "hidden" name = "date_to" value = "<?php echo $date_to; ?>" />
							<button name = "find_report" class="btn btn-xs btn-success"><i class="fa fa-download"></i> <i class="fa fa-print"></i> Click to download <b><?php echo $file_description; ?></b> report</button>
						</form>
					  </div>
                    </article>
					<div class="divider"></div>
					<table id="datatable" class="table table-bordered">
								<thead>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>File Name</th>
										<th>Date</th>
										<th>File Description</th>
									</tr>
								</thead>
								<tbody>
			<?php
			if(isset($_POST['search_file'])){
				$file_description = $_POST['file_description'];
				$date_from = $_POST['date_from']; 
				$date_to = $_POST['date_to'];
			$sel = mysql_query("SELECT * FROM file_downloads WHERE file_description = '$file_description' && date_download between '$date_from' and '$date_to'");
			while($row=mysql_fetch_array($sel))
			{
								echo '	
									<tr>
										<td>'.$row['name'].'</td>
										<td>'.$row['email'].'</td>
										<td>'.$row['file_name'].'</td>
										<td>'.$row['date_download'].'</td>
										<td>'.$row['file_description'].'</td>
									</tr>';
			}
			}
							?>
								</tbody>
					</table>
<?php } }else{
echo '
					<div class="alert alert-danger alert-dismissible fade in" role="alert">
						<i class = "fa fa-warning"></i>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						Please select file name.</strong>
					</div>';
					echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=download_logs.php?department='.$collegedepartment.'">';
	?>

					<table id="datatable" class="table table-bordered">
								<thead>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>File Name</th>
										<th>Date</th>
										<th>File Description</th>
									</tr>
								</thead>
								<tbody>
			<?php
			$sel = mysql_query("SELECT * FROM file_downloads where dept_code = '$collegedepartment'");
			while($row=mysql_fetch_array($sel))
			{
								echo '	
									<tr>
										<td>'.$row['name'].'</td>
										<td>'.$row['email'].'</td>
										<td>'.$row['file_name'].'</td>
										<td>'.$row['date_download'].'</td>
										<td>'.$row['file_description'].'</td>
									</tr>';
			}
							?>
								</tbody>
					</table>
<?php } }else{ ?> 
					<table id="datatable" class="table table-bordered">
								<thead>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>File Name</th>
										<th>Date</th>
										<th>File Description</th>
									</tr>
								</thead>
								<tbody>
			<?php
			$sel = mysql_query("SELECT * FROM file_downloads where dept_code = '$collegedepartment'");
			while($row=mysql_fetch_array($sel))
			{
								echo '	
									<tr>
										<td>'.$row['name'].'</td>
										<td>'.$row['email'].'</td>
										<td>'.$row['file_name'].'</td>
										<td>'.$row['date_download'].'</td>
										<td>'.$row['file_description'].'</td>
									</tr>';
			}
							?>
								</tbody>
					</table>
<?php } ?> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

<div class="modal fade bs-example-modal-search-file" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2"><i class="fa fa-search"></i> Search File Reports <b><?php echo $collegedepartment; ?></b></h4>
			</div>
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="modal-body">
							<label for="files[]">File Name:</label>
							<select required class="form-control" name="file_description" id = "user_staff_priviledge" >
								<option style = "font-weight: bold; font-size: 15px;" disabled selected>SELECT <?php echo $collegedepartment; ?>'S FILE NAME</option>
								<option value = "all_files">All files</option>
								<?php
									$files = mysql_query("SELECT * FROM file_uploads WHERE department_code = '$collegedepartment'");
										while($files_show=mysql_fetch_array($files))
										{
											echo '<option>'.$files_show['description'].'</option>';
											}
											?>
							</select>			
							<label for="date_from">From Date:</label>
							<input class = "form-control" type="date" name="date_from" value = "<?php echo''.date('Y-m-d').''; ?>"/>
							
							<label for="date_to">To Date:</label>
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
        <!-- footer content -->
<?php include '_partial/partial_footer.php'; ?>
        <!-- /footer content -->
      </div>
    </div>
<?php include '_partial/partial_footscripts_datatables.php'; ?>
  </body>
</html>
