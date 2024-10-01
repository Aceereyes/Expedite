<?php
include '../_connections/_database_connection.php';


$id = $_GET['id'];

$delete_file=mysql_query("SELECT * FROM file_uploads WHERE id = '$id'");
$delete_file_show=mysql_fetch_array($delete_file);
$file_name = ''.$delete_file_show['file_name'].'';
unlink("../file_uploads/$file_name");

mysql_query("DELETE FROM file_uploads WHERE id = '$id'");


?>