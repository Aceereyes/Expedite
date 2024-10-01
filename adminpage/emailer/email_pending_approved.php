<?php
$user_id = $_GET['user_id'];
$signatory = $_POST['signatory'];
$date_download = $_POST['date_download'];
$time_download = $_POST['time_download'];
mysqli_query($conn, "UPDATE file_with_approvals SET approval = '1' WHERE signatory = '$signatory' && user_id = '$user_id' && date_download = '$date_download' && time_download = '$time_download'");
$file_app = mysqli_query($conn, "SELECT * FROM file_with_approvals WHERE signatory = '' && user_id = '$user_id' && date_download = '$date_download' && time_download = '$time_download'"); 
$file_app_display = mysqli_fetch_assoc($file_app); 
$no_approval = $file_app_display['approval'];
	if($no_approval == 0){
		mysqli_query($conn, "UPDATE file_with_approvals SET approval = '1' WHERE signatory = '' && user_id = '$user_id' && date_download = '$date_download' && time_download = '$time_download'");
	}else{
		$file_apps = mysqli_query($conn, "SELECT * FROM file_with_approvals WHERE signatory = '' && user_id = '$user_id' && date_download = '$date_download' && time_download = '$time_download'"); 
		$file_apps_display = mysqli_fetch_assoc($file_apps);
		$nos_approval = $file_apps_display['approval'];
		$new_file_approval_no = $nos_approval + 1;
		mysqli_query($conn, "UPDATE file_with_approvals SET approval = '$new_file_approval_no' WHERE signatory = '' && user_id = '$user_id' && date_download = '$date_download' && time_download = '$time_download'");
	}
}
?>