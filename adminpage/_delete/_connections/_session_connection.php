<?php
include '_connections/_database_connection.php';
session_start();
if(isset($_SESSION['ADMIN_LOGIN'])){
$ADMIN_LOGIN_USERNAME = $_SESSION['ADMIN_LOGIN'];
$ADMIN_LOGIN_SELECT = mysql_query("SELECT * FROM user_admins WHERE user_username = '$ADMIN_LOGIN_USERNAME'");
$ADMIN_LOGIN_VIEW = mysql_fetch_array($ADMIN_LOGIN_SELECT);
//ADMIN ID
$ADMIN_USERID = $ADMIN_LOGIN_VIEW['user_id'];
//ADMIN ACCOUNT
$ADMIN_USERNAME = $ADMIN_LOGIN_VIEW['user_username'];
//ADMIN PERSONAL INFORMATION
$ADMIN_FIRSTNAME = $ADMIN_LOGIN_VIEW['user_firstname'];
$ADMIN_MIDDLENAME = $ADMIN_LOGIN_VIEW['user_middlename'];
$ADMIN_LASTNAME = $ADMIN_LOGIN_VIEW['user_lastname'];
$ADMIN_EMAIL = $ADMIN_LOGIN_VIEW['user_email'];
$ADMIN_BIRTHDAY = $ADMIN_LOGIN_VIEW['user_birthday'];
$ADMIN_PROFILE_PHOTO = $ADMIN_LOGIN_VIEW['user_photo'];
$ADMIN_PRIVILEDGE = $ADMIN_LOGIN_VIEW['user_priviledge_level'];
$ADMIN_DEPARTMENT = $ADMIN_LOGIN_VIEW['user_priviledge'];
$ADMIN_USER_DEPARTMENT = $ADMIN_LOGIN_VIEW['user_dept'];
$ADMIN_PHOTO = $ADMIN_LOGIN_VIEW['user_photo'];
}else{
	header("Location: login.php");
}
?>