<?php
include '../_connections/_database_connection.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM user_admins WHERE user_id = '$id'");
?>