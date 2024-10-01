<?php
//MYSQL DB
//PDO ERROR
error_reporting(E_ALL ^ E_DEPRECATED);
$db_host		= 'localhost';
$db_user		= 'root';
$db_pass		= '';
$db_database	= 'school_database'; 
$link = mysql_connect($db_host,$db_user,$db_pass) or die(header("location: maintenance.php"));
$getalldata = mysql_select_db($db_database,$link);
mysql_query("SET names UTF8");
/*Full details of user*/
@$details = json_decode(file_get_contents("http://ipinfo.io/"));
/*if($db_database == 'school'){
}else{
	header('location: maintenance.php');
}*/
//MYSQLi DB

/*$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'school';
Connect and select the database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die(header("location: maintenance.php"));
}*/
?>