<?php 
//ADD ADMIN
	function add_administrator_user_account(){
		if(isset($_POST['save_staff_user_account'])){
			include '_connections/_database_connection.php';
			//QUERY
			include '_user_accounts/_admin_add.php';
		}
	}
//RECOVERY
	function user_recovery(){
		if(isset($_POST['user_forgot_button'])){
			include '_connections/_database_connection.php';
				$usernameemail = $_POST['usernameemail'];
				$single_quotation = "'";
				if(strpos($usernameemail, $single_quotation) !== false){
					echo '
					<div style = "text-align:left;"class="alert alert-warning alert-dismissible fade in" role="alert">
						<i class = "fa fa-check-circle"></i> <b>ACCOUNT RECOVERY!</b>
						<br/><br/>
						<b>'.$usernameemail.'</b> is an invalid credentials.
					</div>';
					echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=dashboard.php">';
				}else{
				$LOGIN_date = date('F j, Y - l');
				$LOGIN_time = date('g:i A');
				$date_recov = date('mmjjyY');
	//ACCOUNT RECOVERY
	$ADMIN_login_select = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_username = '$usernameemail' || user_email = '$usernameemail'");
	$ADMIN_login_select_view = mysqli_fetch_array($ADMIN_login_select);
		$ADMIN_id = $ADMIN_login_select_view['user_id'];
			if($ADMIN_login_select_view > 0){
			$select_user = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$ADMIN_id'");
			$select_user_view = mysqli_fetch_array($select_user);
				$user_id = $select_user_view['user_id'];
				$user_username_ENC = md5(sha1($select_user_view['user_username']));
				$user_username = $select_user_view['user_username'];
				$user_password = $select_user_view['user_password'];
				$user_firstname = $select_user_view['user_firstname'];
				$user_middlename = $select_user_view['user_middlename'];
				$user_lastname = $select_user_view['user_lastname'];
				$user_email = $select_user_view['user_email'];
				$user_contact = $select_user_view['user_contact'];
				$user_username = $select_user_view['user_username'];
				$user_username_ENC = md5(sha1($select_user_view['user_password']));
				$user_password = $select_user_view['user_password'];
				$user_dept = $select_user_view['user_dept'];
				$user_priviledge = $select_user_view['user_priviledge'];
				$user_priviledge_level = $select_user_view['user_priviledge_level'];
				$random_code_enc = md5(sha1($select_user_view['random_code']));
				
				include 'emailer/forgotpassword_user.php';
				echo '
				<div style = "text-align:left;"class="alert alert-success alert-dismissible fade in" role="alert">
					<i class = "fa fa-check-circle"></i> <b>ACCOUNT RECOVERY!</b>
					<br/><br/>
					Recovery instruction was successfully sent to <b>'.$user_email.'</b>.
				</div>';
				echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=dashboard.php">';
			}else{
				echo '
				<div style = "text-align:left;"class="alert alert-warning alert-dismissible fade in" role="alert">
					<i class = "fa fa-check-circle"></i> <b>ACCOUNT RECOVERY!</b>
					<br/><br/>
					<b>'.$usernameemail.'</b> is an invalid credentials.
				</div>';
				echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=dashboard.php">';
			}
				}
		}
	}
	
?>