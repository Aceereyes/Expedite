<?php
include '../_connections/_database_connection.php';
@$id = $_GET['id'];
$deactivated_user = 'Activated';

//ACTIVITY LOGS RECORD
$description = 'Activated '.$user_names.' account.';
$link = 'user_accounts.php';
$date_today = date("F d, Y");
$time_today = date("h:i A");
mysql_query("INSERT INTO activity_logs (user_id,description,link,date,time)VALUES('$id','$description','$link','$date_today','$time_today')");
mysql_query("UPDATE user_admins SET user_activation = '$deactivated_user' WHERE user_id = $id");

?>