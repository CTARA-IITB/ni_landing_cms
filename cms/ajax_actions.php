<?php
require_once '../config.php';
if(!empty($_POST['hdn_type']) && !empty($_POST['hdn_id']))
{
	if($_POST['hdn_action'] == 'delete')
	{
		if($_POST['hdn_type'] == 'indicator')
		{
			$sql = "DELETE FROM tbl_indicators WHERE ind_id=ARG0";
			$res = sql_query($sql, array('numeric'), array($_POST['hdn_id']));
		}
		else if($_POST['hdn_type'] == 'category')
		{
			$sql1 = "DELETE FROM tbl_indicators WHERE cat_id=ARG0";
			$res1 = sql_query($sql1, array('numeric'), array($_POST['hdn_id']));

			$sql2 = "DELETE FROM tbl_category WHERE cat_id=ARG0";
			$res2 = sql_query($sql2, array('numeric'), array($_POST['hdn_id']));
		}
		else if($_POST['hdn_type'] == 'lifecycle')
		{
			$sql1 = "DELETE FROM tbl_indicators WHERE lc_id=ARG0";
			$res1 = sql_query($sql1, array('numeric'), array($_POST['hdn_id']));

			$sql2 = "DELETE FROM tbl_category WHERE lc_id=ARG0";
			$res2 = sql_query($sql2, array('numeric'), array($_POST['hdn_id']));
			
			$sql3 = "DELETE FROM tbl_lifecycle_master WHERE lc_id=ARG0";
			$res3 = sql_query($sql3, array('numeric'), array($_POST['hdn_id']));
		}
		else if($_POST['hdn_type'] == 'updates')
		{
			$sql1 = "DELETE FROM tbl_update_master WHERE upt_id=ARG0";
			$res1 = sql_query($sql1, array('numeric'), array($_POST['hdn_id']));
		}
	}
	else if($_POST['hdn_action'] == 'deactive' || $_POST['hdn_action'] == 'active')
	{
		if($_POST['hdn_action'] == 'deactive')
			$active = 0;
		else if($_POST['hdn_action'] == 'active')
			$active = 1;
		
		if($_POST['hdn_type'] == 'indicator')
		{
			$sql = "UPDATE tbl_indicators SET ind_active=$active WHERE ind_id=ARG0";
			$res = sql_query($sql, array('numeric'), array($_POST['hdn_id']));
		}
		else if($_POST['hdn_type'] == 'category')
		{
			$sql1 = "UPDATE tbl_indicators SET ind_active=$active  WHERE cat_id=ARG0";
			$res1 = sql_query($sql1, array('numeric'), array($_POST['hdn_id']));

			$sql2 = "UPDATE tbl_category  SET cat_active=$active  WHERE cat_id=ARG0";
			$res2 = sql_query($sql2, array('numeric'), array($_POST['hdn_id']));
		}
		else if($_POST['hdn_type'] == 'lifecycle')
		{
			$sql1 = "UPDATE tbl_indicators SET ind_active=$active WHERE lc_id=ARG0";
			$res1 = sql_query($sql1, array('numeric'), array($_POST['hdn_id']));

			$sql2 = "UPDATE tbl_category SET cat_active=$active WHERE lc_id=ARG0";
			$res2 = sql_query($sql2, array('numeric'), array($_POST['hdn_id']));
			
			$sql3 = "UPDATE tbl_lifecycle_master SET lc_active=$active  WHERE lc_id=ARG0";
			$res3 = sql_query($sql3, array('numeric'), array($_POST['hdn_id']));
		}
		else if($_POST['hdn_type'] == 'updates')
		{
			$sql1 = "UPDATE tbl_update_master SET upt_active=$active WHERE upt_id=ARG0";
			$res1 = sql_query($sql1, array('numeric'), array($_POST['hdn_id']));
		}
	}
	else if($_POST['hdn_action'] == 'default')
	{
		$sql1 = "UPDATE tbl_lifecycle_master SET lc_default=0";
		$res1 = sql_query($sql1, array(), array());
		
		$sql2 = "UPDATE tbl_lifecycle_master SET lc_default=1 WHERE lc_id=ARG0";
		$res2 = sql_query($sql2, array('numeric'), array($_POST['hdn_id']));
	}
}
if($_POST['hdn_type'] == 'updates')
{
	header("Location: updates.php");
	exit;
}
else if($_POST['hdn_type'] == 'lifecycle')
{
	header("Location: lifecycles.php");
	exit;
}
else if($_POST['hdn_type'] == 'category')
{
	header("Location: categories.php");
	exit;
}
else if($_POST['hdn_type'] == 'indicator')
{
	header("Location: indicators.php");
	exit;
}
?>