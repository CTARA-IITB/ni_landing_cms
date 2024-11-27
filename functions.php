<?php

function getCategoriesAndIndicators()
{
	$sql = "SELECT 
				tlm.lc_name, tlm.lc_desc, tlm.lc_image, tlm.lc_url, tcat.cat_name, tcat.cat_desc, tind.lc_id, tind.cat_id, tind.ind_id, tind.ind_name, tind.ind_url, tind.ind_active, tlm.order_by as lcorder_by, tcat.order_by as catorderby,  tind.order_by as indorderby,   tlm.lc_default, tcat.cat_active , tlm.lc_active 
			FROM tbl_lifecycle_master tlm 
			LEFT JOIN tbl_category tcat ON tlm.lc_id = tcat.lc_id 
			LEFT JOIN tbl_indicators tind ON tlm.lc_id=tind.lc_id AND tind.cat_id=tcat.cat_id 
			ORDER BY tlm.order_by ASC, tcat.order_by ASC, tind.order_by ASC";
	$res = sql_query($sql, array('numeric'), array($lcid));
	$arr_return = array();
	if($res['num_rows'] > 0)
	{
		$lcorder_by = 0;
		$catorderby = 0;
		$indorderby = 0;
		
		foreach($res['records'] as $k => $arr_vals)
		{
			
			if($arr_vals['lcorder_by'] == 0) $lcorder_by++;
			else $lcorder_by = $arr_vals['lcorder_by'];
			
			if($arr_vals['catorderby'] == 0) $catorderby++;
			else $catorderby = $arr_vals['catorderby'];
			
			if($arr_vals['indorderby'] == 0) $indorderby++;
			else $indorderby = $arr_vals['indorderby'];
			
			
			if($arr_vals['lc_active'] > 0)
			{
			$arr_return[$lcorder_by]['lc_id'] = $arr_vals['lc_id'];
			$arr_return[$lcorder_by]['lc_name'] = $arr_vals['lc_name'];
			$arr_return[$lcorder_by]['lc_desc'] = $arr_vals['lc_desc'];
			$arr_return[$lcorder_by]['lc_image'] = $arr_vals['lc_image'];
				$arr_return[$lcorder_by]['lc_url'] = $arr_vals['lc_url'];
			$arr_return[$lcorder_by]['lc_default'] = $arr_vals['lc_default'];
			
				if($arr_vals['cat_active'] > 0)
				{
			$arr_return[$lcorder_by]['category'][$catorderby]['cat_id'] = $arr_vals['cat_id'];
			$arr_return[$lcorder_by]['category'][$catorderby]['cat_name'] = $arr_vals['cat_name'];
			$arr_return[$lcorder_by]['category'][$catorderby]['cat_desc'] = $arr_vals['cat_desc'];
			
			if($arr_vals['ind_active'] > 0)
			{
				$arr_return[$arr_vals['lcorder_by']]['category'][$arr_vals['catorderby']]['indicator'][$indorderby]['ind_id'] = $arr_vals['ind_id'];
				$arr_return[$arr_vals['lcorder_by']]['category'][$arr_vals['catorderby']]['indicator'][$indorderby]['ind_name'] = $arr_vals['ind_name'];
				$arr_return[$arr_vals['lcorder_by']]['category'][$arr_vals['catorderby']]['indicator'][$indorderby]['ind_url'] = $arr_vals['ind_url'];
					}
				}
			}
		}
	}
	return $arr_return;
}

function getAllUpdates()
{
	$sql = "SELECT upt_desc, upt_url FROM tbl_update_master ORDER BY order_by ASC";
	$res = sql_query($sql, array(), array());
	if($res['num_rows'] > 0)
	{
		return $res['records'];
	}
}
?>