<?php
if(isset($_SESSION['ADMIN_LOGIN'])){
	
}elseif(isset($_SESSION['STAFF_LOGIN'])){
	
}elseif(isset($_SESSION['STUDENT_LOGIN'])){{
	
}else{
	header("Location: ../login.php");
}
?>