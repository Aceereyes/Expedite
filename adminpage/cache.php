<?php
$cookie_name = 'user';
$cookie_value = 'Lorenz Lorena';

setcookie($cookie_name,$cookie_value, time() + (86400 * 30), '/');

?>

<?php
if(!isset($_COOKIE[$cookie_name])){
	
	echo 'Cookie named';
}else{
	
	echo 'Cookie';
	echo "value is: " .$_COOKIE[$cookie_name];
}
?>
	