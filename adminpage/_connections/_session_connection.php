<?php
include '_connections/_database_connection.php';
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}else{
$ADMIN_LOGIN_ID = $_SESSION["id"];
$ADMIN_LOGIN_SELECT = mysqli_query($conn, "SELECT * FROM tbl_admins WHERE id = '$ADMIN_LOGIN_ID'");
$ADMIN_LOGIN_VIEW = mysqli_fetch_array($ADMIN_LOGIN_SELECT);
//ADMIN ID
$id = $ADMIN_LOGIN_VIEW['id'];
//ADMIN ACCOUNT
//ADMIN PERSONAL INFORMATION
$firstName = $ADMIN_LOGIN_VIEW['firstName'];
$lastName = $ADMIN_LOGIN_VIEW['lastName'];
$email = $ADMIN_LOGIN_VIEW['email'];
$password = $ADMIN_LOGIN_VIEW['password'];
$department = $ADMIN_LOGIN_VIEW['department'];
$created_at = $ADMIN_LOGIN_VIEW['created_at'];
$updated_at = $ADMIN_LOGIN_VIEW['updated_at'];
$priviledge = $ADMIN_LOGIN_VIEW['priviledge'];
$priviledge = $ADMIN_LOGIN_VIEW['photo'];
}
?>