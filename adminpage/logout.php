<?php
session_start();
 
// Unset all of the session variables
//$_SESSION = array();
 
// Destroy the session.
unset($_SESSION['loggedin'])
//session_destroy($_SESSION['loggedin']);
 
// Redirect to login page
?>
<script>
window.location.href = "login.php";
</script>
<?php
header("location: login.php");
exit;
?>