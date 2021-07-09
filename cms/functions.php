<?php

/***************************************************
$arr_filetype['cancel_cheque_image'] = array('file_type'=>'image', 'target_dir'=> CHEF_APPROOT."/uploads/".$_SESSION['chef_id']);
$return = upload_files($arr_filetype, $_FILES);
**************************************************/
function upload_files($arr_file_upload, $arr_file)
{
	$arr_msg  = array();
	foreach($arr_file_upload as $key_name => $arr_type)
	{
		if(!empty($arr_file[$key_name]["name"]))
		{
			$uploadOk = 1;
			$err_msg  = "";
			
			$imageFileType 	= strtolower(pathinfo($arr_file[$key_name]["name"],PATHINFO_EXTENSION));
			if(empty($arr_type['file_name']))
			{
				$final_fn 		= $key_name . "." . $imageFileType;
			}
			else 
			{
				$final_fn 		= $arr_type['file_name'] . "." . $imageFileType;
			}
			$target_file = $arr_type['target_dir'] . "/" . $final_fn;
			
			
			if(!dir($arr_type['target_dir']))
			{
				mkdir($arr_type['target_dir']);
			}
			
			// Check if image file is a actual image or fake image
			$check = getimagesize($arr_file[$key_name]["tmp_name"]);
			if($check !== false)
			{
				//echo  "File is an image - " . $check["mime"] . ".\n";
				// check 0 -> width; check 1 is height
				//print_r($check);
				//*
				if(($check[0] >= 190 && $check[0] <= 195) && ($check[1] >= 190 && $check[1] <= 195))
				{
					$uploadOk = 1;	
				}
				else 
				{
					$uploadOk = 0;
					$arr_msg[$key_name]['status']	= 'error';
					$arr_msg[$key_name]['message'] .= strtoupper($key_name) . " Image Dimensions does not match 192 x 192 \n";
				}
				//*/
			} 
			else 
			{
				$arr_msg[$key_name]['status']	= 'error';
				$arr_msg[$key_name]['message'] .= strtoupper($key_name) . " File is not an image.\n";
				$uploadOk = 0;
			}

			// Check if file already exists
			/*
			if (file_exists($target_file)) {
			  echo "Sorry, file already exists.";
			  $uploadOk = 0;
			}
			*/

			// Check file size
			/*
			if ($arr_file[$key_name]["size"] > 500000) {
			  echo "Sorry, your file is too large.";
			  $uploadOk = 0;
			}
			*/

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$arr_msg[$key_name]['status']	= 'error';
				$arr_msg[$key_name]['message'] .= strtoupper($key_name) . " - Only JPG, JPEG, PNG & GIF files are allowed.\n";
				$uploadOk = 0;
			}

			if ($uploadOk == 1)
			{
				// if everything is ok, try to upload file
				//echo $target_file;
				
				if (move_uploaded_file($arr_file[$key_name]["tmp_name"], $target_file)) {
					//echo "The file ". htmlspecialchars( basename( $arr_file[]["name"])). " has been uploaded.";
					chmod($target_file, 0755);
					$arr_msg[$key_name]['status']	= 'success';
					$arr_msg[$key_name]['file_upload_path']	= $final_fn;
					$arr_msg[$key_name]['message']	= strtoupper($key_name) . ' File upload successful.';
				} else {
					
					$arr_msg[$key_name]['status']	= 'error';
					$arr_msg[$key_name]['message']	.= strtoupper($key_name) . 'There was an error uploading.';
					//echo "Sorry, there was an error uploading your file.";
				}
			}
		}
		else 
		{
			$arr_msg[$key_name]['status']	= 'error';
			$arr_msg[$key_name]['message']	= '';
		}
	}
	
	return $arr_msg;
}


function getOptions_Lifecycles($selected)
{
	$str_html_opts = false;
	
	$sql = "SELECT lc_id, lc_name FROM tbl_lifecycle_master WHERE lc_active=1 ORDER BY order_by ASC";
	$arr_res = sql_query($sql, array(), array());
	if($arr_res['num_rows'] > 0)
	{
		foreach($arr_res['records'] as $k => $arr_vals)
		{
			if($selected == $arr_vals['lc_id'])
				$str_html_opts .= "<option selected value='".$arr_vals['lc_id']."'>".$arr_vals['lc_name']."</option>";
			else 
				$str_html_opts .= "<option value='".$arr_vals['lc_id']."'>".$arr_vals['lc_name']."</option>";
		}
	}
	return $str_html_opts;
}

function checkDuplicateCategory($lcid, $catname)
{
	$sql = "SELECT tc.cat_name, lm.lc_id FROM tbl_category tc LEFT JOIN tbl_lifecycle_master lm ON tc.lc_id=lm.lc_id WHERE tc.lc_id=ARG0 AND tc.cat_name='ARG1'";
	$res = sql_query($sql, array('numeric','string'), array($lcid, $catname));
	if($res['num_rows'] > 0)
		return true;
	else 
		return false;
}

function checkDuplicateLifecycle($lcname)
{
	$sql = "SELECT lc_name FROM tbl_lifecycle_master WHERE lc_name='ARG0'";
	$res = sql_query($sql, array('string'), array($lcname));
	if($res['num_rows'] > 0)
		return true;
	else 
		return false;
}

function checkDuplicateIndicator($lcid, $catid, $indname)
{
	$sql = "SELECT lc_id, cat_id, ind_name FROM tbl_indicators WHERE lc_id=ARG0 AND cat_id=ARG1 AND ind_name='ARG2'";
	$res = sql_query($sql, array('numeric','numeric','string'), array($lcid, $catid, $indname));
	if($res['num_rows'] > 0)
		return true;
	else 
		return false;
}

function getOptions_Category($lcid, $selected)
{
	$str_html_opts = false;
	
	$sql = "SELECT cat_id, cat_name FROM tbl_category WHERE lc_id=ARG0 ORDER BY order_by ASC";
	$arr_res = sql_query($sql, array('numeric'), array($lcid));
	if($arr_res['num_rows'] > 0)
	{
		$str_html_opts = "<option value='0'>-- Select --</option>";
		foreach($arr_res['records'] as $k => $arr_vals)
		{
			if($selected == $arr_vals['cat_id'])
				$str_html_opts .= "<option selected value='".$arr_vals['cat_id']."'>".$arr_vals['cat_name']."</option>";
			else 
				$str_html_opts .= "<option value='".$arr_vals['cat_id']."'>".$arr_vals['cat_name']."</option>";
		}
	}
	return $str_html_opts;

}

function getCountCategoryAndIndicators($lc_id)
{
	$arr_return = false;
	$sql = "SELECT sum(cat_cnt) as cat_cnt, sum(ind_cnt) as ind_cat FROM ( SELECT count(1) as cat_cnt, 0 as ind_cnt FROM tbl_category WHERE lc_id = ARG0 UNION SELECT 0 as cat_cnt, count(1) as ind_cnt FROM tbl_indicators WHERE lc_id=ARG0) as temp";
	$arr_res = sql_query($sql, array('numeric'), array($lc_id));
	if($arr_res['num_rows'] > 0)
	{
		$arr_return = $arr_res['records'][0];
	}
	return $arr_return;
}

function getCountIndicators($lc_id, $cat_id)
{
	$arr_return = false;
	$sql = "SELECT count(1) as ind_cnt FROM tbl_indicators WHERE lc_id=ARG0 AND cat_id=ARG1";
	$arr_res = sql_query($sql, array('numeric','numeric'), array($lc_id,$cat_id));
	//print_r( return_safe_sql($sql,array('numeric','numeric'), array($lc_id,$cat_id)) );
	
	if($arr_res['num_rows'] > 0)
	{
		$arr_return = $arr_res['records'][0];
	}
	return $arr_return;
}

?>