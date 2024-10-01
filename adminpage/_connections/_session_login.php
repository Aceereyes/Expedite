<?php
include '_connections/_database_connection.php';
session_start();
if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
$ADMIN_LOGIN_USERNAME = $_SESSION['ADMIN_LOGIN'];
$ADMIN_LOGIN_SELECT = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_username = '$ADMIN_LOGIN_USERNAME'");
$ADMIN_LOGIN_VIEW = mysqli_fetch_array($ADMIN_LOGIN_SELECT);
//ADMIN ID
$ADMIN_USERID = $ADMIN_LOGIN_VIEW['user_id'];
//ADMIN ACCOUNT
$ADMIN_USERNAME = $ADMIN_LOGIN_VIEW['user_username'];
//ADMIN PERSONAL INFORMATION
$ADMIN_FIRSTNAME = $ADMIN_LOGIN_VIEW['user_firstname'];
$ADMIN_MIDDLENAME = $ADMIN_LOGIN_VIEW['user_middlename'];
$ADMIN_LASTNAME = $ADMIN_LOGIN_VIEW['user_lastname'];
$ADMIN_PROFILE_PHOTO = $ADMIN_LOGIN_VIEW['user_photo'];
$ADMIN_DEPARTMENTCOL = $ADMIN_LOGIN_VIEW['user_priviledge'];
$ADMIN_DEPARTMENT = $ADMIN_LOGIN_VIEW['user_dept'];
}else{
	
}
?>