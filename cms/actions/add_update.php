<?php
require_once BACKEND_APPROOT.'functions.php';
print_r($_POST);

if(!empty($_POST['hdn_uptid']) && $_POST['btn_submit'] == "Edit")
{
	$arr_param_type 	= array('string','string','numeric','datetime','numeric','string');
	$arr_param_vals 	= array($_POST['upt_desc'],$_POST['upt_url'],$_SESSION['admin_id'],date("Y-m-d H:i:s"),$_POST['hdn_uptid'],$_POST['upt_title']);
	$error_message 		= '';
	$sql 		= "UPDATE tbl_update_master SET upt_desc='ARG0', upt_url='ARG1', last_modified_by='ARG2', last_modified_dt='ARG3', upt_title='ARG5' WHERE upt_id=ARG4";
	$arr_res 	= sql_query($sql, $arr_param_type, $arr_param_vals);
	$upload_files = true;
}
else if($_POST['hdn_process'] == 'order')
{
	foreach($_POST['order_by'] as $pkid => $val)
	{
		$sql 		= "UPDATE tbl_update_master SET order_by='ARG0', last_modified_by='ARG1', last_modified_dt='ARG2' WHERE upt_id=ARG3";
		$arr_res 	= sql_query($sql, array('numeric','numeric','datetime','numeric'), array($val,$_SESSION['admin_id'],date("Y-m-d H:i:s"), $pkid));
	}
}
else if($_POST['btn_submit'] == "Add")
{
	$arr_param_type 	= array('string','string','numeric','datetime','numeric','datetime','string');
	$arr_param_vals 	= array($_POST['upt_desc'],$_POST['upt_url'],$_SESSION['admin_id'],date("Y-m-d H:i:s"),$_SESSION['admin_id'],date("Y-m-d H:i:s"), $_POST['upt_title']);
	$error_message 		= '';
	$sql 		= "INSERT INTO tbl_update_master (upt_desc, upt_url, created_by, created_dt, last_modified_by, last_modified_dt,upt_title) VALUES ('ARG0','ARG1','ARG2','ARG3','ARG4','ARG5','ARG6') ";
	$arr_res 	= sql_query($sql, $arr_param_type, $arr_param_vals);
}
header("Location: ". BACKEND_WEBROOT. "updates.php");
exit;
?>