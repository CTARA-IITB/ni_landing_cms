<?php
require_once '../config.php';
require_once 'functions.php';

/**** used in config_sidebar starts ***/
$arr_sidenav['category']['active'] = "active"; //used in sidebar;
$arr_sidenav['category']['collapse'] = "show"; //used in sidebar;
$arr_sidenav['category']['expanded']	= "true";
$arr_sidenav['category']['show_all']['active'] = "active"; //used in sidebar;

/**** used in config_sidebar ends ***/

if(isset($_POST['btn_submit']))
{
	require_once 'actions/add_category.php';
}

$sql = "SELECT tc.cat_id, tc.cat_name, tc.cat_desc, tc.order_by as tc_orderby, lm.order_by, lm.lc_name, lm.lc_id, tc.cat_active FROM tbl_category tc LEFT JOIN tbl_lifecycle_master lm ON tc.lc_id=lm.lc_id ORDER BY lm.order_by, tc.order_by";
$arr_res = sql_query($sql, array(), array());

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Nutrition India</title>
    <!-- Custom fonts for this template-->
    <link href="<?php echo VENDOR_WEBROOT;?>fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    
	<link href="<?php echo CSS_WEBROOT;?>custom.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
		<?php 
			include_once 'sidebar.php';
		?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
				<?php
					include_once 'topbar.php';
				?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Categories</h1>
					<div class="small text-danger m-2">** Categories can be activated/deactivated/deleted only if it does NOT have indicators associated with it.</div>
					<table class="table bordered">
						<tr>
							<th class='w-20'>Lifecycle Name</th>
							<th class='w-20'>Order By</th>
							<th class='w-20'>Category Name</th>
							<th>Category Desc</th>
							<th>Action</th>
						</tr>
<?php
if($arr_res['num_rows'] > 0)
{
	echo "<form name='frm_catorder' method='post' action='categories.php'> ";
	echo "<input type='hidden' name='hdn_process' value='order' >";
	foreach($arr_res['records'] as $key => $arr_vals)
	{
		$arr_cnt = getCountIndicators($arr_vals['lc_id'], $arr_vals['cat_id']);
		if($arr_vals['cat_active'] > 0)
			$cat_active = "checked";
		else 
			$cat_active = "";
		
		if($prev_lc_name != $arr_vals['lc_name'])
		{
			echo "<tr>";
			echo "<td class='w-20'><a href='javascript: void(0);' onclick='show(".$arr_vals['lc_id'].")'><span id='span_".$arr_vals['lc_id']."'>(+)</span> ".$arr_vals['lc_name']."</a></td>";
			echo "<td colspan='4'></td>";
			echo "</tr>";
		}

		echo "<tr id='tr_".$arr_vals['lc_id']."_".$arr_vals['cat_id']."' class='disabled-table-row'>";
		echo "<td class='w-20'></td>";
		echo "<td class='w-20'><input type='text' name='order_by[".$arr_vals['cat_id']."]' value='".$arr_vals['tc_orderby']."' size='2'></td>";
		echo "<td><a href='add_category.php?catid=".base64_encode($arr_vals['cat_id'])."' >".$arr_vals['cat_name']."</a></td>";
		echo "<td>".$arr_vals['cat_desc']."</td>";
		if($arr_cnt['ind_cnt'] < 1)
		{
			echo "<td>
					<label class='switch'>
					<input type='checkbox' name='chk_ind_".$arr_vals['cat_id']."' id='chk_ind_".$arr_vals['cat_id']."' onclick='status_id(\"assign\",this,".$arr_vals['cat_id'].");'  data-toggle='modal' data-target='#CategoryModal' ".$cat_active.">
					<span class='slider round'></span>
					</label>
					&nbsp;<a href='javascript: void(0);' class='btn btn-danger btn-circle btn-sm' onclick='delete_id(\"assign\",".$arr_vals['cat_id'].");' data-toggle='modal' data-target='#CategoryModal'><i class='fas fa-trash'></i></a>
				</td>";
		}
		else 
		{
			echo "<td></td>";
		}
		echo "</tr>";	

		$prev_lc_name = $arr_vals['lc_name'];
	}
	
	echo "<tr>";
	echo "<td colspan='5'><input type='submit' name='btn_submit' value='Update' class='btn btn-primary' ></td>";
	echo "</tr>";
	echo "</form>";
}
else 
{
	echo "<tr><td colspan='2'>No records found</td></tr>";
}
?>
					</table>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            
			<?php 
				//include_once '../copyright.php';
			?>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
		<!-- Modal-->
		<div class="modal fade" id="CategoryModal" tabindex="-1" role="dialog" aria-labelledby="CategoryModal"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="CategoryModal">Are you sure ?</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body text-danger"></div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<a class="btn btn-danger" href="javascript: void(0);" onclick="submit_action();" id="actionid">Delete</a>
					</div>
				</div>
			</div>
		</div>
		<form name="frm_action" id="frm_action" method="post" action="ajax_actions.php">
			<input type='hidden' name="hdn_type" id="hdn_type" value=''>
			<input type='hidden' name="hdn_id" id="hdn_id" value=''>
			<input type='hidden' name="hdn_action" id="hdn_action" value=''>
		</form>
		<!-- End of Modal -->
		
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo JS_WEBROOT;?>jquery36.min.js"></script>
    <script src="<?php echo JS_WEBROOT;?>bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo VENDOR_WEBROOT;?>jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo JS_WEBROOT;?>custom.min.js"></script>
	<script>
		function show(lcid)
		{
			if($("span[id^='span_"+lcid+"']").html() == "(+)")
			{
				$("tr[id^='tr_"+lcid+"']").removeClass("disabled-table-row");
				$("tr[id^='tr_"+lcid+"']").addClass("enabled-table-row");
				$("span[id^='span_"+lcid+"']").html("(-)");
			}
			else 
			{
				$("tr[id^='tr_"+lcid+"']").addClass("disabled-table-row");
				$("tr[id^='tr_"+lcid+"']").removeClass("enabled-table-row");
				$("span[id^='span_"+lcid+"']").html("(+)");
			}
		}
	</script>
	<script>
		
		function submit_action()
		{
			$("#frm_action").submit();
		}
		
		function delete_id(action, cat_id='')
		{
			if(action == 'assign')
			{
				$("#hdn_type").val('category');
				$("#hdn_id").val(cat_id);
				$("#hdn_action").val('delete');
				$("#actionid").html('Delete');
				$(".modal-body").html("This CATEGORY will be deleted permanently.");
			}
			else if(action == 'status')
			{
				$("#frm_action").submit();
			}
		}

		function status_id(action, ele='', cat_id='')
		{
			var act = '';
			var act_txt = '';
			if(ele.checked)
			{
				act = 'active';
				act_txt = 'activated';
				$("#actionid").html('Yes, Activate');
			}
			else 
			{
				act = 'deactive';
				act_txt = 'deactivated temporarily';
				$("#actionid").html('Delete');
				$("#actionid").html('Yes, Deactivate');
			}
			
			if(action == 'assign')
			{
				$("#hdn_type").val('category');
				$("#hdn_id").val(cat_id);
				$("#hdn_action").val(act);
				$(".modal-body").html("This CATEGORY will be "+act_txt+" along with all its indicators!");
			}
			else if(action == 'active' || action == 'deactive' )
			{
				$("#frm_action").submit();
			}
		}
	</script>

</body>
</html>