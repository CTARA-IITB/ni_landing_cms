<?php
$arr_param_type 	= array('string','string');
$arr_param_vals 	= array($_POST['email'],$_POST['password']);
$error_message 		= '';
$sql 		= "SELECT pkid, full_name, mobile, email, active FROM admin_users where email='ARG0' AND password=SHA1('ARG1')";
$arr_res 	= sql_query($sql, $arr_param_type, $arr_param_vals);
if($arr_res['records'][0]['active'] == 1)
{
	$_SESSION['user_type'] 	= 'admin';
	$_SESSION['admin_id'] 	= $arr_res['records'][0]['pkid'];
	$_SESSION['full_name'] 	= $arr_res['records'][0]['full_name'];
	$_SESSION['mobile'] 	= $arr_res['records'][0]['mobile'];
	$_SESSION['email_address'] 	= $arr_res['records'][0]['email'];

	header("Location: dashboard.php");
	exit;
}
else
{
	$error_message = "Invalid Login.";
}
?>