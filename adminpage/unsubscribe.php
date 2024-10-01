<?php
include 'adminpage/_connections/_database_connection.php';
if(isset($_GET['email'])){
$email = $_GET['email'];
$unsubscribe=mysqli_query($conn, "SELECT * FROM subscribe WHERE email = '$email'");
$unsubscribe_show=mysqli_fetch_array($unsubscribe);
$unsubscribe_email = ''.$unsubscribe_show['email'].'';
include 'newsletter_unsubscribe.php';
mysqli_query($conn, "DELETE FROM subscribe WHERE email = '$unsubscribe_email'");
}
?>
<script type="text/javascript">
setTimeout(
function ( )
{
  self.close();
}, 500 );
</script>