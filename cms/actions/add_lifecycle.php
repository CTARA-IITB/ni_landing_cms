<?php
require_once BACKEND_APPROOT.'functions.php';

if(!empty($_POST['hdn_pkid']) && $_POST['btn_submit'] == "Edit")
{
	$arr_param_type 	= array('string','string','string','numeric','datetime','numeric');
	$arr_param_vals 	= array($_POST['lc_name'],$_POST['lc_desc'],$_POST['lc_url'],$_SESSION['admin_id'],date("Y-m-d H:i:s"),$_POST['hdn_pkid']);
	$error_message 		= '';
	$sql 		= "UPDATE tbl_lifecycle_master SET lc_name='ARG0', lc_desc='ARG1', lc_url='ARG2', last_modified_by='ARG3', last_modified_dt='ARG4' WHERE lc_id=ARG5";
	$arr_res 	= sql_query($sql, $arr_param_type, $arr_param_vals);
	$upload_files = true;
	$success_message = "Record updated successfully";
	$error_message = "";
}
else if($_POST['hdn_process'] == 'order')
{
	$upload_files = false;
	foreach($_POST['order_by'] as $pkid => $val)
	{
		$sql 		= "UPDATE tbl_lifecycle_master SET order_by='ARG0', last_modified_by='ARG1', last_modified_dt='ARG2' WHERE lc_id=ARG3";
		$arr_res 	= sql_query($sql, array('numeric','numeric','datetime','numeric'), array($val,$_SESSION['admin_id'],date("Y-m-d H:i:s"), $pkid));
	}
	$success_message = "Record updated successfully";
	$error_message = "";
}
else if($_POST['btn_submit'] == "Add")
{
	$success_message = "Record updated successfully";
	$error_message = "";
	$upload_files = true;
	$arr_param_type 	= array('string','string','string','numeric','datetime','numeric','datetime');
	$arr_param_vals 	= array($_POST['lc_name'],$_POST['lc_desc'],$_POST['lc_url'],$_SESSION['admin_id'],date("Y-m-d H:i:s"),$_SESSION['admin_id'],date("Y-m-d H:i:s"));
	$error_message 		= '';
	$sql 		= "INSERT INTO tbl_lifecycle_master (lc_name, lc_desc, lc_url, created_by, created_dt, last_modified_by, last_modified_dt) VALUES ('ARG0','ARG1','ARG2','ARG3','ARG4','ARG5','ARG6') ";
	$arr_res 	= sql_query($sql, $arr_param_type, $arr_param_vals);
}
if($upload_files == true)
{
	// upload files takes place here. it returns whether file was successfully uploaded or not.
	$arr_filetype['lc_image'] = array('file_type'=>'image', 'target_dir'=> IMAGES_APPROOT."/lifecycle/", 'file_name'=>remove_spl_chars($_POST['lc_name']));
	$arr_return = upload_files($arr_filetype, $_FILES);

	// if an error then we do not update the images_name field in database.
	if($arr_return['lc_image']['status'] == 'error')
	{
		$error_message = $arr_return['lc_image']['message'];
	}
	else 
	{
		$success_message = $arr_return['lc_image']['message']. "\n";
		$arr_json_vals['lc_image'] = "'". $arr_return['lc_image']['file_upload_path']."'";

		$sql 		= "UPDATE tbl_lifecycle_master SET lc_image='ARG0', last_modified_by='ARG1', last_modified_dt='ARG2' WHERE lc_name='ARG3'";
		$arr_res 	= sql_query($sql, array('string','numeric','datetime','string'), array($arr_return['lc_image']['file_upload_path'],$_SESSION['admin_id'],date("Y-m-d H:i:s"), $_POST['lc_name']));
	}
}

if(empty($error_message))
{
	header("Location: ". BACKEND_WEBROOT. "lifecycles.php");
	exit;
}
?>