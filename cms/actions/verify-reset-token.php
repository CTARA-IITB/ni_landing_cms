<?php
require_once '../config.php';

$arr_param_type 	= array('string');
$arr_param_vals 	= array($_GET['token']);
$error_message 		= '';
$sql 		= "SELECT token FROM reset_password WHERE token='ARG0'";
$arr_res 	= sql_query($sql, $arr_param_type, $arr_param_vals);
if(!empty($arr_res['records'][0]['token']))
{
	$success_message = "Token verified successfully";
}
else
{
	$error_message = "Invalid Token";
}
?>