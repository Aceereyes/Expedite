<?php
	include('app/bootstrap.php');
	session_destroy();
	redirect('index.php');
?>