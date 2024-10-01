<!DOCTYPE html>
<html lang="en">
<?php 
include '_connections/_database_connection.php';
include '_connections/_session_connection.php';
include '_partial/partial_head.php'; 
@$collegedepartment = $_GET['department'];
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
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
                    <div class="clearfix"></div>
					</div>
                  <div class="x_content">
					<table id="datatable" class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
							  <th>Name</th>
							  <th>Email</th>
							  <th>File Name</th>
							  <th>Date</th>
							</tr>
						</thead>
<?php
$sel = mysql_query("SELECT * FROM sent_file WHERE dept_code = '$collegedepartment'");
while($row=mysql_fetch_array($sel))
{
	
	$filename = ''.$row['file_name'].'';
echo '	
			<tr>
				<td>'.$row['name'].'</td>
				<td>'.$row['email'].'</td>
				<td>'.$row['file_name'].'</td>
				<td>'.$row['date_download'].'</td>
			</tr>';
}
				?>
						</tbody>
					</table>
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
<?php include '_partial/partial_footscripts_datatables.php'; ?>
  </body>
</html>
