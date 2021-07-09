<?php
require_once BACKEND_APPROOT.'functions.php';

if(!empty($_POST['hdn_catid']) && $_POST['btn_submit'] == "Edit")
{
	$arr_param_type 	= array('string','string','string','numeric','datetime','numeric','numeric');
	$arr_param_vals 	= array($_POST['cat_name'],$_POST['cat_desc'],$_POST['cat_url'],$_SESSION['admin_id'],date("Y-m-d H:i:s"),$_POST['hdn_catid'], $_POST['sel_catid']);
	
	$error_message 		= '';
	/*
	if(checkDuplicateCategory($_POST['sel_catid'], $_POST['cat_name']) === true)
	{
		$error_message = "Category Name: ". $_POST['cat_name'] . " cannot be added. It already exists with the selected Lifecycle.";
	}
	else 
	{
	*/
		$sql 		= "UPDATE tbl_category SET cat_name='ARG0', cat_desc='ARG1', cat_url='ARG2', last_modified_by='ARG3', last_modified_dt='ARG4', lc_id='ARG6'	WHERE cat_id=ARG5";
		$arr_res 	= sql_query($sql, $arr_param_type, $arr_param_vals);
	//}
}
else if($_POST['hdn_process'] == 'order')
{
	foreach($_POST['order_by'] as $pkid => $val)
	{
		$sql 		= "UPDATE tbl_category SET order_by='ARG0', last_modified_by='ARG1', last_modified_dt='ARG2' WHERE cat_id=ARG3";
		$arr_res 	= sql_query($sql, array('numeric','numeric','datetime','numeric'), array($val,$_SESSION['admin_id'],date("Y-m-d H:i:s"), $pkid));
	}
}
else if($_POST['btn_submit'] == "Add")
{
	$arr_param_type 	= array('numeric','string','string','string','numeric','datetime','numeric','datetime');
	$arr_param_vals 	= array($_POST['sel_catid'],$_POST['cat_name'],$_POST['cat_desc'],$_POST['cat_url'],$_SESSION['admin_id'],date("Y-m-d H:i:s"),$_SESSION['admin_id'],date("Y-m-d H:i:s"));
	$error_message 		= '';
	
	if(checkDuplicateCategory($_POST['sel_catid'], $_POST['cat_name']) === true)
	{
		$error_message = "Category Name: ". $_POST['cat_name'] . " cannot be added. It already exists with the selected Lifecycle.";
	}
	else 
	{
		$sql 		= "INSERT INTO tbl_category (lc_id, cat_name, cat_desc, cat_url, created_by, created_dt, last_modified_by, last_modified_dt) VALUES (ARG0,'ARG1','ARG2','ARG3',ARG4,'ARG5',ARG6,'ARG7') ";
		$arr_res 	= sql_query($sql, $arr_param_type, $arr_param_vals);
	}
}
if(empty($error_message))
{
	header("Location: ". BACKEND_WEBROOT. "categories.php");
	exit;
}
?>