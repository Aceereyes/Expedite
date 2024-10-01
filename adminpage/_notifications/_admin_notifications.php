<?php if(isset($_POST['save_administrator_user_account'])){ 
$SMS_user_admin_priviledge = $_POST['user_admin_priviledge'];
$SMS_user_admin_password = md5(sha1($_POST['user_admin_password']));?>
<script type="text/javascript">
	$(document).ready(function(){
		demo.initChartist();
		$.notify({
			icon: "fa fa-info-circle",
			message: "<b>(<?php echo $SMS_user_admin_priviledge; ?>)</b> Account has been created.<br> All Admins will be notified about this new account."
			},{
				type: "success",
				timer: 10000
            });
		});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		demo.initChartist();
		$.notify({
			icon: "fa fa-info-circle",
			message: "<b>(<?php echo $SMS_user_admin_priviledge; ?>)</b> Account has been created.<br> All Admins will be notified about this new account."
			},{
				type: "success",
				timer: 10000
            });
		});
</script>
<?php }else{ ?>
<script type="text/javascript">
	$(document).ready(function(){
		demo.initChartist();
		$.notify({
			icon: "fa fa-check-circle",
			message: "Welcome to <b>Paper Dashboard</b> - a beautiful Bootstrap freebie for<br> your next project."
			},{
				type: "info",
				timer: 20000
            });
		});
</script>
<?php } ?>