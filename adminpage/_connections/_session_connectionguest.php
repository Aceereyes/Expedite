<?php
include '_connections/_database_connection.php';
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}else{
$ADMIN_LOGIN_ID = $_SESSION["id"];
$ADMIN_LOGIN_SELECT = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$ADMIN_LOGIN_ID'");
$ADMIN_LOGIN_VIEW = mysqli_fetch_array($ADMIN_LOGIN_SELECT);
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
}
?>