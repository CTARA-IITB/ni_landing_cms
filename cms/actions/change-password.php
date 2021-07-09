<?php
if(!empty($_POST['btn_submit']))
{
	if($_POST['password'] !== $_POST['confirm_password']) 
	{
		$error_message = "Passwords mismatch";
	}
	else 
	{
		$sql_upt 		= "UPDATE admin_users SET password=SHA1(ARG0),  modifed_pwd_dt='ARG1' WHERE pkid=ARG2 AND email='ARG3'";
		$arr_res_upt 	= sql_query($sql_upt, array('string','datetime','numeric','string'), array($_POST['password'],date("Y-m-d H:i:s"),$_SESSION['admin_id'],$_SESSION['email_address']));
		$success_message = "Password changed successfully. Login with the new password.";
	}
}
?>