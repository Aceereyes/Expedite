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
					if(isset($_POST['create_album'])){
						echo '<img src="_photos/systemimages/loading.gif"><meta http-equiv="refresh" content="5; url=gallery.php">';
						
					}elseif(isset($_POST['edit_album_photo'])){
						echo '<img src="_photos/systemimages/loading.gif"><meta http-equiv="refresh" content="5; url=gallery.php">';
						
					}else{
					echo '<i class="fa fa-photo"></i> Albums';
					}
					?>
					</h2>
					
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a type="button" class="btn" data-toggle="modal" data-target=".bs-example-modal-add_new_album"><i class="fa fa-plus"></i> Add New Album</a></li>
                      <li></li>
                    </ul>
					
					<!-- ADD NEW ALBUM -->
					<div class="modal fade bs-example-modal-add_new_album" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-sm">
						  <div class="modal-content">

							<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
							  </button>
							  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-plus"></i> Create New Album</h4>
							</div>
								<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
							<div class="modal-body">
								<label for="album_name">Album Name:</label>
								<input type="text" id="album_name" class="form-control" name="album_name" data-parsley-trigger="change" required />
								
								<label for="album_description">Album Description:</label>
								<input type="text" id="album_description" class="form-control" name="album_description" data-parsley-trigger="change" required />
							
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-time"></i> Close</button>
							  <button type="submit" name = "create_album" class="btn btn-primary"><i class="fa fa-save"></i> Create Album</button>
							</div>
								</form>
						  </div>
						</div>
					</div>
					<!-- /ADD NEW ALBUM -->
					
					
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <?php
				  
				  if(isset($_POST['create_album'])){
					  $album_name = $_POST['album_name'];
					  $album_description = $_POST['album_description'];
						$datetime_today = date("F d, Y - h:i A");
				mysqli_query($conn, "INSERT INTO gallery_album (album_name, album_description,date)VALUES('$album_name','$album_description','$datetime_today')");
				mkdir('_photos/gallery/'.$album_name.'', 0777);
					  echo '
                  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <i class="fa fa-info-circle"></i> You\'re album '.$album_name.' was successfully added in our database.
                  </div>
					<meta http-equiv="refresh" content="3; url=gallery.php">
				  ';
				  
				  }elseif(isset($_POST['delete_album_photo'])){
					  $delete_album_id = $_POST['delete_album_id'];
					   $delete_slider = mysqli_query($conn, "DELETE FROM  gallery_album WHERE id = '$delete_album_id'");					  
					   echo '
                  <div class="alert alert-warning alert-dismissible fade in" role="alert">
                    <i class="fa fa-info-circle"></i> Album was successfully removed in our database.
                  </div>
					<meta http-equiv="refresh" content="3; url=gallery.php">
				  ';
				  }
				  
				  if(isset($_POST['save_slider_photo'])){
					  $slider_description = $_POST['slider_description'];
					  $file_slider_image=$_FILES['slider_image']['tmp_name'];
					  @$slider_image= addslashes(file_get_contents($_FILES['slider_image']['tmp_name']));
					  @$image_name= addslashes($_FILES['slider_image']['name']);
					  @$image_size= getimagesize($_FILES['slider_image']['tmp_name']);
					$save_slider_image=$_FILES["slider_image"]["name"];
			if ($image_size==FALSE) {	
				echo '
					  <div class="alert alert-warning">
						<i class="fa fa-warning"></i> You\'re image file size was too large. Please makesure that the image file size will not exceed 1.5MB.
					  </div>
				';		
			}else{	
				move_uploaded_file($_FILES["slider_image"]["tmp_name"],"_photos/sliderphotos/" . $_FILES["slider_image"]["name"]);
				mysqli_query($conn, "INSERT INTO inquiry_slider (slider_photo, description)VALUES('$save_slider_image','$slider_description')");
					  echo '
                  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <i class="fa fa-info-circle"></i> You\'re slider photo and description was successfully added in our database.
                  </div>
					<meta http-equiv="refresh" content="3; url=gallery.php">
				  ';
				  }
				  }else{
					  
				  }
				  
				  if(isset($_POST['edit_album'])){
					  $edit_album_name = $_POST['edit_album_name'];
					  $edit_old_album_name = $_POST['edit_old_album_name'];
					  $edit_album_description = $_POST['edit_album_description'];
					  $edit_album_id = $_POST['edit_album_id'];
				mysqli_query($conn, "UPDATE gallery_album SET album_name = '$edit_album_name', album_description = '$edit_album_description' WHERE id='$edit_album_id'");
				mysqli_query($conn, "UPDATE gallery_photos SET gallery_name = '$edit_album_name', description = '$edit_album_description' WHERE gallery_name='$edit_old_album_name'");
					rename('_photos/gallery/'.$edit_old_album_name.'','_photos/gallery/'.$edit_album_name.'');
					 echo '
                  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <i class="fa fa-info-circle"></i> You\'re album '.$edit_album_name.' was successfully updated in our database.
                  </div>
					<meta http-equiv="refresh" content="3; url=gallery.php">
				  ';
				  }
				  
				  if(isset($_POST['add_photo'])){
					  $album_id = $_POST['album_id'];
					  $album_name = $_POST['album_name'];
					  $album_description = $_POST['album_description'];
					  $datetime_today = date("F d, Y - h:i A");
						
$countfiles = count($_FILES['file']['name']);
 // Looping all files
 for($i=0;$i<$countfiles;$i++){
  $filename = $_FILES['file']['name'][$i];
 
  // Upload file
  move_uploaded_file($_FILES['file']['tmp_name'][$i],'_photos/gallery//'.$album_name.'/'.$filename);
  
  mysqli_query($conn, "INSERT INTO gallery_photos (date, gallery_name, description, photo, album_id)VALUES('$datetime_today', '$album_name','$album_description','$filename','$album_id')");
					
 }
				 echo '
                  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <i class="fa fa-info-circle"></i> You\'re album '.$album_name.' was successfully added in our database.
                  </div>
					<meta http-equiv="refresh" content="1; url=gallery.php">
				  ';
				  
				  
				  }
				  
				  echo '
				  
                    <table id="datatable" class="table table-hover table-bordered">
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>ALBUM NAME</th>
                          <th>ALBUM DESCRIPTION</th>
                          <th>ACTION</th>
                        </tr>
                      </thead>
					  
                      <tbody>';
					$album_photos = mysqli_query($conn, "select * FROM gallery_album");
					while($get_album_photos=mysqli_fetch_array($album_photos))
					{
				  echo '
                        <tr>
							<td>'.$get_album_photos['id'].'</td>
							<td>'.$get_album_photos['album_name'].'</td>
							<td>'.$get_album_photos['album_description'].'</td>
							<td>	
								<a type="button" class="btn btn-xs btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-add_photo_album'.$get_album_photos['id'].'"><i class="fa fa-plus"></i> ADD NEW PHOTO</a>
								<a href="gallery_photos.php?id='.$get_album_photos['id'].'" target = "_blank" class="btn btn-xs btn btn-success"><i class="fa fa-eye"></i> GALLERY PHOTOS PHOTO</a>
								<a type="button" class="btn btn-xs btn btn-info" data-toggle="modal" data-target=".bs-example-modal-details'.$get_album_photos['id'].'"><i class="fa fa-eye"></i> VIEW DETAILS</a>
                                <a type="button" class="btn btn-xs btn btn-warning" data-toggle="modal" data-target=".bs-example-modal-edit'.$get_album_photos['id'].'"><i class="fa fa-pencil"> EDIT</i></a>
								<a type="button" class="btn btn-xs btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-delete'.$get_album_photos['id'].'"><i class="fa fa-trash"></i> DELETE</a>
							</td>
                        </tr>
					  ';
					echo '
					<div class="modal fade bs-example-modal-add_photo_album'.$get_album_photos['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-sm">
						  <div class="modal-content">

							<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
							  </button>
							  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-upload"></i> Upload Photo to <b>'.$get_album_photos['album_name'].'</b></h4>
							</div>
								<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
							<div class="modal-body">
							
								<label for="album_name">Album Name:</label>
								<input type="hidden" name="album_id" value = "'.$get_album_photos['id'].'" />
								<input readonly type="text" id="album_name" class="form-control" name="album_name" value = "'.$get_album_photos['album_name'].'" data-parsley-trigger="change" required />
								
								<label for="album_description">Album Description:</label>
								<input readonly type="text" id="album_description" class="form-control" name="album_description" value = "'.$get_album_photos['album_description'].'" data-parsley-trigger="change" required />
								
								<label for="album_image">Photo:</label>
								<input type="file" name="file[]" id="file" multiple>
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
							  <button type="submit" name = "add_photo" class="btn btn-primary"><i class="fa fa-save"></i> Create Album</button>
							</div>
								</form>
						  </div>
						</div>
					</div>
					';
					  echo '
                  <div class="modal fade bs-example-modal-delete'.$get_album_photos['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-trash"></i> Delete Album <b>'.$get_album_photos['album_name'].'</b></h4>
                        </div>
							<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
                        <div class="modal-body">
							  <label for="slider_description">Album Name:</label>
							  '.$get_album_photos['album_name'].'
							  <input type="hidden" id="delete_album_id" value = "'.$get_album_photos['id'].'" class="form-control" name="delete_album_id" data-parsley-trigger="change" required />
							  
							<br>
							  <label for="slider_description">Album Description:</label>
							  '.$get_album_photos['album_description'].'
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
                  <div class="modal fade bs-example-modal-edit'.$get_album_photos['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-info"></i> Edit Album Details <b>'.$get_album_photos['album_name'].'</b></h4>
                        </div>
							<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
                        <div class="modal-body">
							  <input type="hidden" id="edit_album_id" value = "'.$get_album_photos['id'].'" class="form-control" name="edit_album_id" data-parsley-trigger="change" required />
							  
							  <label for="edit_album_name">Album Name:</label>
							  <input type="hidden" id="edit_old_album_name" value = "'.$get_album_photos['album_name'].'" class="form-control" name="edit_old_album_name" data-parsley-trigger="change" required />

							  <input type="text" id="edit_album_name" value = "'.$get_album_photos['album_name'].'" class="form-control" name="edit_album_name" data-parsley-trigger="change" required />

							  <label for="edit_album_description">Album Description:</label>
							  <input type="text" id="edit_album_description" value = "'.$get_album_photos['album_description'].'" class="form-control" name="edit_album_description" data-parsley-trigger="change" required />

						</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                          <button type="submit" name = "edit_album" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
                        </div>
							</form>
                      </div>
                    </div>
                  </div>
				  ';
					  echo '
                  <div class="modal fade bs-example-modal-details'.$get_album_photos['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-photo"></i> Album Name <b>'.$get_album_photos['album_name'].'</b></h4>
                        </div>
                        <div class="modal-body">
							  <label for="slider_description">Album Name:</label>
							  '.$get_album_photos['album_name'].'
							  <label for="slider_description">Album Description:</label>
							  '.$get_album_photos['album_description'].'
						</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
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
					  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

                  <!-- Small modal -->
                  <!-- /modals -->

                  <!-- ADD SLIDER PHOTO -->
                  <div class="modal fade bs-example-modal-add_new_slider_photo" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Modal title</h4>
                        </div>
							<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
                        <div class="modal-body">
							  <label for="slider_photo">Photo:</label>
							  <input type="file" name = "slider_image" id="slider_photo" class="form-control" required />

							  <label for="slider_description">Description:</label>
							  <input type="text" id="slider_description" class="form-control" name="slider_description" data-parsley-trigger="change" required />

						</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" name = "save_slider_photo" class="btn btn-primary">Save changes</button>
                        </div>
							</form>
                      </div>
                    </div>
                  </div>
                  <!-- /ADD SLIDER PHOTO -->
        <!-- footer content -->
<?php include '_partial/partial_footer.php'; ?>
        <!-- /footer content -->
      </div>
    </div>
<?php include '_partial/partial_footscripts_datatables.php'; ?>
  </body>
</html>
