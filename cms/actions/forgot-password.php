<?php

$arr_param_type 	= array('string');
$arr_param_vals 	= array($_POST['email']);
$error_message 		= '';
$sql 		= "SELECT pkid, full_name, email, active, mobile FROM admin_users where email='ARG0'";
$arr_res 	= sql_query($sql, $arr_param_type, $arr_param_vals);
//print_r($arr_res);
if($arr_res['records'][0]['active'] == 1)
{
	$token = password_hash($arr_res['records'][0]['pkid']."|".$arr_res['records'][0]['email'], PASSWORD_BCRYPT);

	$arr_param_type 	= array('string','string','string','string');
	$arr_param_vals 	= array($arr_res['records'][0]['email'], $token, date('Y-m-d H:m:s'), $_SERVER['REMOTE_ADDR']);
	
	$sql_ins = "INSERT INTO reset_password (email, token, token_date, token_ipaddress) VALUES ('ARG0', 'ARG1', 'ARG2', 'ARG3')";
	$arr_ins = sql_query($sql_ins, $arr_param_type, $arr_param_vals);
	
	$arr_emails[$arr_res['records'][0]['email']] = $arr_res['records'][0]['full_name'];
	$subject = "Reset Your Password";
	$mail_body = " Click on the link below to reset your password. <br>";
	$mail_body .= "<a target='_blank' href='".BACKEND_WEBROOT."reset-password.php?token=$token'>Reset My Password</a>";
	
	//*
	$to 		= $arr_res['records'][0]['email'];
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: sneha@proditech.co.in";
	//*/
	
	/*
	echo $to;
	echo "<br>";
	echo $subject;
	echo "<br>";
	echo $mail_body;
	echo "<br>";
	echo $headers;
	echo "<br>";
	*/
	
	if(mail($to,$subject,$mail_body,$headers))
	{
		//echo $mail_body;
		$success_message = 'Email sent successfully';
	}
	else 
	{
		$error_message = "Unable to send email at this time! Please try again later.";
	}
	//include_once BACKEND_APPROOT.'/send-email.php';
}
else
{
	$error_message = "User not registered with us!";
}
?>