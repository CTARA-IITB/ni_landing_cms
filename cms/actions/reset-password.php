<?php

if(!empty($_POST['token']) && !empty($_POST['btn_submit']))
{
	if($_POST['password'] !== $_POST['confirm_password']) 
	{
		$error_message = "Passwords mismatch";
	}
	else 
	{
		$arr_param_type 	= array('string');
		$arr_param_vals 	= array($_POST['token']);
		$error_message 		= '';
		$sql 		= "SELECT DISTINCT rp.email FROM reset_password as rp INNER JOIN admin_users ON rp.email=admin_users.email WHERE rp.token='ARG0' AND rp.status=0";
		$arr_res 	= sql_query($sql, $arr_param_type, $arr_param_vals);
		if(!empty($arr_res['records'][0]['email']))
		{
			$sql_upt 		= "UPDATE admin_users SET password=SHA1({$_POST['password']}) WHERE email='{$arr_res['records'][0]['email']}'";
			$arr_res_upt 	= sql_query($sql_upt, array(), array());
			
			$sql_upt2 		= "UPDATE reset_password SET status=1, reset_date=NOW(), reset_ipaddress='".$_SERVER['REMOTE_ADDR']."' WHERE email='{$arr_res['records'][0]['email']}' AND status=0 AND token='{$_POST['token']}'";
			$arr_res_upt2 	= sql_query($sql_upt2, array(), array());
		
			$success_message2 = "Password changed successfully. Login with the new password.";
		}
		else 
		{
			$error_message = "Registered Email and Token mismatch.";
		}
	}
}
else if(!empty($_POST['btn_submit']))
{
	if($_POST['password'] !== $_POST['confirm_password']) 
	{
		$error_message = "Passwords mismatch";
	}
	else 
	{
		$sql_upt 		= "UPDATE admin_users SET password=SHA1({$_POST['password']}) WHERE pkid='{$_SESSION['admin_id']}'";
		$arr_res_upt 	= sql_query($sql_upt, array(), array());
		$success_message2 = "Password changed successfully. Login with the new password.";
	}
}
?>