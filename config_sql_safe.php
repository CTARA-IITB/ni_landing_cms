<?php
/****************************************************************
*	© Sneha Sanghadia at Proditech Solutions
*****************************************************************/

global $conn;

// connects to mysql
function sql_connect()
{
	global $conn;
	$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or show_error('DB connection failed...');
	return $conn;
}

// this function is used to prevent sql injections
function return_safe_sql($sql, $arr_param_types, $arr_param_vals, $return_json=false)
{
	$arr_errors = array();
	foreach($arr_param_types as $key => $type)
	{
		if(empty($arr_param_vals[$key]))
		{
			$sql = str_ireplace("ARG".$key, clean_var($arr_param_vals[$key]),$sql);
		}
		else 
		{
			switch($type)
			{
				case 'string':
					if(is_string($arr_param_vals[$key]))
					{
						$sql = str_ireplace("ARG".$key, clean_var($arr_param_vals[$key]),$sql);
					}
					else 
					{
						$arr_errors[] = "key: ". $key . " value: " .  $arr_param_vals[$key];
					}
				break;
				
				case 'numeric';
					if(is_numeric($arr_param_vals[$key]))
					{
						$sql = str_ireplace("ARG".$key, clean_var($arr_param_vals[$key]),$sql);
					}
					else 
					{
						$arr_errors[] = "key: ". $key . " value: " .  $arr_param_vals[$key];
					}
				break;	
				
				case 'date';
					$ret_date = is_date($arr_param_vals[$key]); 
					if($ret_date !== false && !empty($ret_date))
					{
						$sql = str_ireplace("ARG".$key, clean_var($ret_date),$sql);
					}
					else 
					{
						$arr_errors[] = "key: ". $key . " value: " .  $arr_param_vals[$key];
					}
				break;	
				
				case 'datetime';
					$ret_datetime = is_datetime($arr_param_vals[$key]); 
					if($ret_datetime !== false && !empty($ret_datetime))
					{
						$sql = str_ireplace("ARG".$key, clean_var($ret_datetime),$sql);
					}
					else 
					{
						$arr_errors[] = "key: ". $key . " value: " .  $arr_param_vals[$key];
					}
				break;
			}	
		}
	}

	if(count($arr_errors) > 0)
	{
		$msg = "Invalid arguments for : <br>" . implode("<br>",$arr_errors) . "<br>" .$sql ;
		if($return_json === true)
		{
			return array("status"=>"failure", "message"=>$msg);
		}
		else 
		{
			show_error($msg);
		}
	}
	else 
	{
		//echo $sql;
		return array("status"=>"success", "sql"=>$sql);
	}
}


/*******
* SQL Query takes 3 parameters
* parameter 1 : sql : $sql = "SELECT col1, col2, col3 FROM table1 WHERE col1='ARG0' AND col2=ARG1";
* parameter 2 : type of parameter used in sql : $arr_param_types 	= array('string','numeric');
* parameter 3 : value of parameter used in sql : $arr_param_values 	= array($_GET['col1'],$_GET['col2']);
******/
function sql_query($sql, $arr_param_type, $arr_param_vals, $return_json=false) 
{
	
	$safe_sql = "";
	
	if(count($arr_param_type) != count($arr_param_vals))
	{
		show_error("SQL argument values do not match the argument types");
	}
	else 
	{
		$arr_sql = return_safe_sql($sql, $arr_param_type, $arr_param_vals, $return_json);
		if($arr_sql['status'] == "success")
		{
			$safe_sql = $arr_sql['sql'];
		}
		else 
		{
			echo json_encode($arr_sql);
		}
	}
	
	global $conn;
	$arr_res = array();
	if(!is_resource($conn))
		$conn = sql_connect();

	if(!empty($safe_sql))
	{
		$res_session = mysqli_query($conn, "SET SESSION sql_mode = ''");
		
		if($result = mysqli_query($conn, $safe_sql))
		{
			$arr_res['status'] = "success";
			if(preg_match('/select/i',$safe_sql))
			{
				$arr_res['num_rows'] 		= mysqli_num_rows($result);
				
				$arr_res['affected_rows'] 	= false;
				$arr_res['last_insert_id'] 	= false;
				if($arr_res['num_rows'] > 0)
				{
					while($row = mysqli_fetch_assoc($result))
					{
						$arr_res['records'][] 	= $row;	
					}
					mysqli_free_result($result);
				}
				$arr_res['message'] = "";
			
			}
			else 
			{
				if(preg_match('/insert/i',$safe_sql))
				{
					$arr_res['last_insert_id'] 	= mysqli_insert_id($conn);
				}
				else 
				{
					$arr_res['last_insert_id'] 	= false;		
				}
				$arr_res['num_rows'] 		= false;
				$arr_res['affected_rows'] 	= mysqli_affected_rows($conn);
				$arr_res['message'] = "Record updated successfully.";
			
			}
			
			if($return_json === true)
			{
				return json_encode($arr_res);
			}
			else 
			{
				return $arr_res;
			}
		}
		else 
		{
			//$msg = 'Mysql Error : ' . mysqli_error($conn) . " \n\n SQL : " . $safe_sql;
			$msg = 'Mysql Error : ' . mysqli_error($conn) . " \n\n SQL : " . $safe_sql;
			if($return_json === true)
			{
				return json_encode(array("status"=>"failure", "message"=>$msg));
			}
			else 
			{
				show_error($msg);
			}
		}
		
	}
}

function clean_var($var)
{
	global $conn;
	if(!is_resource($conn))
		$conn = sql_connect();
		
	return mysqli_real_escape_string($conn, $var);
}

function is_date($date)
{
	if($datetime == 'NULL')
		return $datetime;

	$str_date = strtotime($date);
	
	if($str_date !== false)
	{
		return date('Y-m-d', $str_date);
	}
	return false;
}

function is_datetime($datetime)
{
	if($datetime == 'NULL')
	return $datetime;
	
	$str_date = strtotime($datetime);
	
	if($str_date !== false)
	{
		return date('Y-m-d H:i:s',$str_date);
	}
	return false;
}

function return_DTFormat($datetime, $format)
{
	return date($format, strtotime($datetime));
}


function show_error($msg)
{
	echo '<div class="col-md-6">
			 <div class="card offer-card shadow-sm">
				<div class="card-body">
				   <h5 class="card-title text-danger">Error while processing the request</h5>
				   <p class="card-text">
				   '.$msg.'
				   </p>
				</div>
			 </div>
		  </div>';
	die();
}

function remove_spl_chars($string) {
   return preg_replace('/[^A-Za-z0-9\-\s]/', '', $string); // Removes special chars.
}
?>