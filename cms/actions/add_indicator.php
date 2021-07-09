<?php
require_once BACKEND_APPROOT.'functions.php';

if(!empty($_POST['hdn_indid']) && $_POST['btn_submit'] == "Edit")
{
	$arr_param_type = array('numeric','numeric','string','string','numeric','datetime','numeric');
	$error_message 	= '';
	
	foreach($_POST['ind_name'] as $key => $val)
	{
		if(!empty($val) && !empty($_POST['ind_url'][$key]))
		{
			/*
			if(checkDuplicateIndicator($_POST['sel_lcid'], $_POST['sel_catid'],$val ) === true)
			{
				$error_message = "Indicator: ". $val . " cannot be added. It already exists with the selected Lifecycle and Category.";
			}
			else 
			{
			*/
				$arr_param_vals 	= array($_POST['sel_lcid'], $_POST['sel_catid'], $val, $_POST['ind_url'][$key],$_SESSION['admin_id'],date("Y-m-d H:i:s"),$_POST['hdn_indid']);

				$sql 		= "UPDATE tbl_indicators SET lc_id=ARG0, cat_id=ARG1, ind_name='ARG2', ind_url='ARG3', last_modified_by=ARG4, last_modified_dt='ARG5' WHERE ind_id=ARG6";
				$arr_res 	= sql_query($sql, $arr_param_type, $arr_param_vals);
			//}
		}
	}
}
else if($_POST['hdn_process'] == 'order')
{
	foreach($_POST['order_by'] as $indid => $val)
	{
		$sql 		= "UPDATE tbl_indicators SET order_by='ARG0', last_modified_by='ARG1', last_modified_dt='ARG2' WHERE ind_id=ARG3";
		$arr_res 	= sql_query($sql, array('numeric','numeric','datetime','numeric'), array($val,$_SESSION['admin_id'],date("Y-m-d H:i:s"), $indid));
	}
}
else if($_POST['btn_submit'] == "Add")
{
	$arr_param_type = array('numeric','numeric','string','string','numeric','datetime','numeric','datetime');
	$error_message 	= '';
	
	foreach($_POST['ind_name'] as $key => $val)
	{
		if(!empty($val) && !empty($_POST['ind_url'][$key]))
		{
			if(checkDuplicateIndicator($_POST['sel_lcid'], $_POST['sel_catid'],$val ) === true)
			{
				$error_message = "Indicator: ". $val . " cannot be added. It already exists with the selected Lifecycle and Category.";
			}
			else 
			{
				$arr_param_vals 	= array($_POST['sel_lcid'], $_POST['sel_catid'], $val, $_POST['ind_url'][$key],$_SESSION['admin_id'],date("Y-m-d H:i:s"),$_SESSION['admin_id'],date("Y-m-d H:i:s"));

				$sql 		= "INSERT INTO tbl_indicators (lc_id, cat_id, ind_name, ind_url, created_by, created_dt, last_modified_by, last_modified_dt) VALUES (ARG0,'ARG1','ARG2','ARG3',ARG4,'ARG5',ARG6,'ARG7') ";
				$arr_res 	= sql_query($sql, $arr_param_type, $arr_param_vals);
			}
		}
	}
	
}
if(empty($error_message))
{
	header("Location: ". BACKEND_WEBROOT. "indicators.php");
	exit;
}
?>