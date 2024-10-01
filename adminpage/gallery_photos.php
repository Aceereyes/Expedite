<?php 
include '_connections/_database_connection.php';
include '_connections/_session_connection.php';
include '_partial/partial_head.php'; 
?>
<!DOCTYPE html>
<html lang="en">
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
                    <h2>
					<?php
					$getid = $_GET['id'];
					$album_photos = mysqli_query($conn, "select * FROM gallery_photos WHERE album_id = $getid");
					$get_album_photos=mysqli_fetch_array($album_photos);
					if($get_album_photos > 0){
					$gallery_name = $get_album_photos['gallery_name'];
					if(isset($_POST['create_album'])){
						echo '<img src="_photos/systemimages/loading.gif"><meta http-equiv="refresh" content="5; url=gallery.php">';
						
					}elseif(isset($_POST['edit_album_photo'])){
						echo '<img src="_photos/systemimages/loading.gif"><meta http-equiv="refresh" content="5; url=gallery.php">';
						
					}else{
					echo '<i class="fa fa-photo"></i> Albums Name <b>'.$gallery_name.'</b>';
					}
					}else{
						echo 'No Image';
						echo '<meta http-equiv="refresh" content="1; url=gallery.php">';
					}
					?>
					</h2>
					
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <?php
				  if(isset($_POST['delete_album_photo'])){
					  $delete_album_id = $_POST['delete_album_id'];
					  $get_id = $_POST['get_id'];
					   $delete_slider = mysqli_query($conn, "DELETE FROM  gallery_photos WHERE id = '$delete_album_id'");					  
					   echo '
                  <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <i class="fa fa-info-circle"></i> Photo was successfully removed in our database.
                  </div>
					<meta http-equiv="refresh" content="1; url=gallery_photos.php?id='.$get_id.'">
				  ';
				  }
				  $getid = $_GET['id'];
				  $album_photos = mysqli_query($conn, "select * FROM gallery_photos WHERE album_id = '$getid'");
					while($get_album_photos=mysqli_fetch_array($album_photos))
					{
					echo '
                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div style="width: 100%; height: 100%; display: block;" class="image view view-first">
                            <img data-toggle="modal" data-target=".bs-example-modal-view_photo" style="cursor: pointer; width: 100%; height: 100%;" src="_photos/gallery/'.$get_album_photos['gallery_name'].'/'.$get_album_photos['photo'].'" alt="image" />

                            <div style="width: 100%; height: 100%;" class="mask">
                              <div class="tools tools-bottom">
                                <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg-'.$get_album_photos['id'].'"><i class="fa fa-eye"></i> View</a>
                                <a href="#" data-toggle="modal" data-target=".bs-example-modal-xs-delete-'.$get_album_photos['id'].'"><i class="fa fa-trash"></i> Delete</a>
                              </div>
                            </div>                         
						 </div>
                        </div>
                      </div>
					';
					echo '
                  <div class="modal fade bs-example-modal-xs-delete-'.$get_album_photos['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-trash"></i> Delete Photo <b>'.$get_album_photos['gallery_name'].'</b></h4>
                        </div>
							<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
                        <div class="modal-body">
						<input type = "hidden" name = "get_id" value = "'.$getid.'">
						<input type = "hidden" name = "delete_album_id" value = "'.$get_album_photos['id'].'">
						<img style="width: 100%; height: 100%;" src="_photos/gallery/'.$get_album_photos['gallery_name'].'/'.$get_album_photos['photo'].'" alt="image" />					
						
							  <label for="slider_description">Album Name:</label>
							  '.$get_album_photos['gallery_name'].'
							<br>
							  <label for="slider_description">Album Description:</label>
							  '.$get_album_photos['description'].'
							  <br>
							  <br>
							  <b>Are you sure you want to delete this photo?</b>
						</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                          <button type="submit" name = "delete_album_photo" class="btn btn-danger"><i class="fa fa-trash"></i> Delete Photo</button>
                        </div>
							</form>
                      </div>
                    </div>
                  </div>
				  ';
					echo '
                  <div class="modal fade bs-example-modal-lg-'.$get_album_photos['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-upload"></i> Photo Uploaded: '.$get_album_photos['date'].'</h4>
                        </div>
                        <div class="modal-body">
                        	<img style="width: 100%; height: 100%;" src="_photos/gallery/'.$get_album_photos['gallery_name'].'/'.$get_album_photos['photo'].'" alt="image" />					
						</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>

                      </div>
                    </div>
                  </div>
				  ';
					}
					?>
				  <?php
				  
				  if(isset($_POST['edit_album'])){
					  $edit_album_name = $_POST['edit_album_name'];
					  $edit_album_description = $_POST['edit_album_description'];
					  $edit_album_id = $_POST['edit_album_id'];
				mysqli_query($conn, "UPDATE gallery_album SET album_name = '$edit_album_name', album_description = '$edit_album_description' WHERE id='$edit_album_id'");
					  echo '
                  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <i class="fa fa-info-circle"></i> You\'re album '.$edit_album_name.' was successfully updated in our database.
                  </div>
					<meta http-equiv="refresh" content="3; url=gallery.php">
				  ';
				  }
				  
					  
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
<?php include '_partial/partial_footscripts_datatables.php'; ?>
  </body>
</html>
