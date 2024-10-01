<?php		
date_default_timezone_set("Asia/Manila");
//USER DATABASE IDENTIFICATION
$user_staffid = $_POST['user_staffid'];
$user_autoid = $_POST['user_autoid'];
$user_staffdateregistration = $_POST['user_staffdateregistration'];
$user_staff_account_created_by = $_POST['user_staff_account_created_by'];

$date_sent_convert = strtotime(''.$user_staffdateregistration.''); $new_date_sent_converted = date('F d, Y', $date_sent_convert);
//USER PERSONAL DETAILS
$user_staff_first_name = $_POST['user_staff_first_name'];
$user_staff_middle_name = $_POST['user_staff_middle_name'];
$user_staff_last_name = $_POST['user_staff_last_name'];
/*$user_admin_birthdate = $_POST['user_admin_birthdate'];
function ageCalculator($user_admin_birthdate){
	if(!empty($user_admin_birthdate)){
		$birthdate = new DateTime($user_admin_birthdate);
		$today = new DateTime('today');
		$age = $birthdate -> diff($today) -> y;
		return $age;
		}else{
			return 0;
			}
		}
$user_admin_age = ageCalculator($user_admin_birthdate);
*/
function generateRandomString_code($length = 100){
$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < $length; $i++) {
	$randomString .= $characters[rand(0, $charactersLength - 1)];
}
return $randomString;
}
$randomstr = ''.generateRandomString_code().'';

$user_staff_contact = $_POST['user_staff_contact'];
$user_staff_email = $_POST['user_staff_email'];

//ACCOUNT DETAILS
$user_staff_username = $_POST['user_staff_username'];
$user_staff_password = $_POST['user_staff_password'];
$user_staff_password_enc = password_hash($user_staff_password, PASSWORD_DEFAULT);
$user_staff_user_activation = "Not Activated";
$user_staff_user_reason = "User Reason Blocked";
$user_staff_user_dateblocked = "Date Blocked";
/*
function generateMobileAuthenticator($length = 5){
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$user_staff_user_mobileauth = '';
	for ($i = 0; $i < $length; $i++) {
		$user_staff_user_mobileauth .= $characters[rand(0, $charactersLength - 1)];
		}
		return $user_staff_user_mobileauth;
		}
$user_staff_user_authenticator_code = generateMobileAuthenticator();
$user_staff_email_autheticator = $_POST['user_staff_email_autheticator'];
*/
$priviledge_level = $_POST['iCheck'];

$uppercase = preg_match('@[A-Z]@', $user_staff_password);
$lowercase = preg_match('@[a-z]@', $user_staff_password);
$number    = preg_match('@[0-9]@', $user_staff_password);
$specialChars = preg_match('@[^\w]@', $user_staff_password);
								
if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($user_staff_password) < 8) {
	echo '
	<div class="alert alert-warning alert-dismissible fade in" role="alert">
		<i class = "fa fa-info-circle"></i>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.
	</div>';
	echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=user_accounts.php">';
}else{

//Check for existing Email
$CHECKemail = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_email='".$user_staff_email."'");

//Check for existing Username
$CHECKusername = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_username='".$user_staff_username."'");

if(mysqli_num_rows($CHECKemail) > 0){
	echo '
	<div class="alert alert-danger alert-dismissible fade in" role="alert">
		<i class = "fa fa-check-circle"></i> <b>ACCOUNT EXIST!</b>
		</br>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<strong>'.$user_staff_email.'</strong> This email is already exist, please choose new email.
		</br>			
	</div>';
	echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=user_accounts.php">';
}elseif(mysqli_num_rows($CHECKusername) > 0) {
	echo '
	<div class="alert alert-danger alert-dismissible fade in" role="alert">
		<i class = "fa fa-check-circle"></i> <b>ACCOUNT EXIST!</b>
		</br>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<strong>'.$user_staff_username.'</strong> This username is already exist, please choose new username.
		</br>			
	</div>';
	echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=user_accounts.php">';
}else{

$file=$_FILES['user_staff_photo']['tmp_name'];
if($file != ''){
	
$file=$_FILES['user_staff_photo']['tmp_name'];
$user_staff_photo= addslashes(file_get_contents($_FILES['user_staff_photo']['tmp_name']));
$image_name= addslashes($_FILES['user_staff_photo']['name']);
$image_size= getimagesize($_FILES['user_staff_photo']['tmp_name']);
mkdir('_photos/profilephotos/admins/'.$user_staff_first_name.''.$user_staff_middle_name.''.$user_staff_last_name.'');

move_uploaded_file($_FILES["user_staff_photo"]["tmp_name"],"_photos/profilephotos/admins/".$user_staff_first_name."".$user_staff_middle_name."".$user_staff_last_name."/" . $_FILES["user_staff_photo"]["name"]);

$user_staff_photo=$_FILES["user_staff_photo"]["name"];

mysqli_query($conn, "INSERT INTO user_admins 
(user_identification,
user_auto_id,
user_date_registration,
user_createdby,
user_firstname,
user_middlename,
user_lastname,
user_contact,
user_email,
user_username,
user_password,
user_passwordenc,
user_activation,
user_ban_status,
user_ban_date,
user_priviledge_level,
user_photo,
user_age,
user_birthday,
user_address,
user_civil_status,
user_gender,
user_signature,
user_forcechangepass,
random_code,
user_notification)
VALUES 
('$user_staffid',
'$user_autoid',
'$user_staffdateregistration',
'$user_staff_account_created_by',
'$user_staff_first_name',
'$user_staff_middle_name',
'$user_staff_last_name',
'$user_staff_contact',
'$user_staff_email',
'$user_staff_username',
'$user_staff_password',
'$user_staff_password_enc',
'$user_staff_user_activation',
'$user_staff_user_reason',
'$user_staff_user_dateblocked',
'$priviledge_level',
'$user_staff_photo',
'0',
'0',
'0',
'0',
'0',
'0',
'REQUIRE_CHANGE',
'$randomstr',
'ON')");
	echo '
	<div class="alert alert-success alert-dismissible fade in" role="alert">
		<i class = "fa fa-check-circle"></i> <b>ACCOUNT SUCCESSFULLY CREATED!</b>
		</br>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<strong>'.$user_staff_first_name.' '.$user_staff_last_name.'</strong> Has been registered to our system as <strong>'.$priviledge_level.'</strong>
		</br>
		</br>
					User\'s Information has been successfully sent to <b>'.$user_staff_email.'</b>. </br></br>
					<script>
						var timeleft = 3;
						var downloadTimer = setInterval(function(){
						  if(timeleft <= 0){
							clearInterval(downloadTimer);
						  }
						  document.getElementById("progressBar").value = 3 - timeleft;
						  timeleft -= 1;
						}, 1000);
					</script>
					<progress value="0" max="3" id="progressBar"></progress>
	</div>';
	echo '<META HTTP-EQUIV="REFRESH" CONTENT="5; URL=user_accounts.php">';
	
	
	include 'emailer/register_user.php';
}else{
mkdir('_photos/profilephotos/admins/'.$user_staff_first_name.''.$user_staff_middle_name.''.$user_staff_last_name.'');
$user_staff_first_name_1 = substr($user_staff_first_name, 0, 1); 
$user_staff_middle_name_1 = substr($user_staff_middle_name, 0, 1); 
$user_staff_last_name_1 = substr($user_staff_last_name, 0, 1); 
$full_cut_strings = ''.$user_staff_first_name_1.''.$user_staff_middle_name_1.''.$user_staff_last_name_1.'';
$im = imagecreate(50, 50);
// White background and blue text
$bg = imagecolorallocate($im, 255, 255, 255);
$textcolor = imagecolorallocate($im, 0, 0, 0);
// Write the string at the top left
imagestring($im, 5, 14, 17, ''.$full_cut_strings.'', $textcolor);
// Output the image
imagepng($im, '_photos/profilephotos/admins/'.$user_staff_first_name.''.$user_staff_middle_name.''.$user_staff_last_name.'/'.$full_cut_strings.'.png');
$user_staff_photo = ''.$full_cut_strings.'.png';

mysqli_query($conn, "INSERT INTO user_admins 
(user_identification,
user_auto_id,
user_date_registration,
user_createdby,
user_firstname,
user_middlename,
user_lastname,
user_contact,
user_email,
user_username,
user_password,
user_passwordenc,
user_activation,
user_ban_status,
user_ban_date,
user_priviledge_level,
user_photo,
user_age,
user_birthday,
user_address,
user_civil_status,
user_gender,
user_signature,
user_forcechangepass,
random_code)
VALUES 
('$user_staffid',
'$user_autoid',
'$user_staffdateregistration',
'$user_staff_account_created_by',
'$user_staff_first_name',
'$user_staff_middle_name',
'$user_staff_last_name',
'$user_staff_contact',
'$user_staff_email',
'$user_staff_username',
'$user_staff_password',
'$user_staff_password_enc',
'$user_staff_user_activation',
'$user_staff_user_reason',
'$user_staff_user_dateblocked',
'$priviledge_level',
'$user_staff_photo',
'0',
'0',
'0',
'0',
'0',
'0',
'REQUIRE_CHANGE',
'$randomstr')");
	echo '
	<div class="alert alert-success alert-dismissible fade in" role="alert">
		<i class = "fa fa-check-circle"></i> <b>ACCOUNT SUCCESSFULLY CREATED!</b>
		</br>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<strong>'.$user_staff_first_name.' '.$user_staff_last_name.'</strong> Has been registered to our system as <strong>'.$priviledge_level.'</strong>
		</br>
		</br>
					User\'s Information has been successfully sent to <b>'.$user_staff_email.'</b>. </br></br>
					<script>
						var timeleft = 3;
						var downloadTimer = setInterval(function(){
						  if(timeleft <= 0){
							clearInterval(downloadTimer);
						  }
						  document.getElementById("progressBar").value = 3 - timeleft;
						  timeleft -= 1;
						}, 1000);
					</script>
					<progress value="0" max="3" id="progressBar"></progress>
	</div>';
	echo '<META HTTP-EQUIV="REFRESH" CONTENT="5; URL=user_accounts.php">';
	
	include 'emailer/register_user.php';
}
}
}
mysqli_close($conn);
?>