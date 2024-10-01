<?php
include '_connections/_database_connection.php';
include '_connections/_session_connection.php';
$id = $_GET['id'];
$unread_sent = 0;
mysql_query("UPDATE sent_file SET notification_status = '$unread_sent' WHERE id = '$id'");
?>