<?php
require_once '../config.php';

/**** used in config_sidebar starts ***/
$arr_sidenav['indicators']['active'] = "active"; //used in sidebar;
$arr_sidenav['indicators']['collapse'] = "show"; //used in sidebar;
$arr_sidenav['indicators']['expanded']	= "true";
$arr_sidenav['indicators']['show_all']['active'] = "active"; //used in sidebar;

/**** used in config_sidebar ends ***/

if(isset($_POST['btn_submit']))
{
	require_once 'actions/add_indicator.php';
}

$sql = "SELECT tind.ind_id, tind.lc_id, lm.lc_name, tind.cat_id, tc.cat_name, tind.ind_name, tind.ind_url, tind.order_by as ind_orderby, tind.ind_active, tc.cat_active, lm.lc_active  
			FROM tbl_indicators tind  
				LEFT JOIN tbl_category tc ON tind.cat_id = tc.cat_id 
				LEFT JOIN tbl_lifecycle_master lm ON tind.lc_id=lm.lc_id ORDER BY lm.order_by, tc.order_by, tind.order_by ";
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
                    <h1 class="h3 mb-4 text-gray-800">Indicators</h1>
					
					<table class="table bordered">
						<tr>
							<th class='w-20'>Lifecycle Name</th>
							<th class='w-20'>Category Name</th>
							<th class='w-20'>Order By</th>
							<th class='w-20'>Indicator Name</th>
							<th>Indicator URL</th>
							<th>Action</th>
						</tr>
<?php
if($arr_res['num_rows'] > 0)
{
	echo "<form name='frm_catorder' method='post' action='indicators.php'> ";
	echo "<input type='hidden' name='hdn_process' value='order' >";
	foreach($arr_res['records'] as $key => $arr_vals)
	{
		if($arr_vals['lc_active'] > 0) $lc_active = "checked"; else $lc_active = ""; 
		if($arr_vals['cat_active'] > 0) $cat_active = "checked"; else $cat_active = ""; 
		if($arr_vals['ind_active'] > 0) $ind_active = "checked"; else $ind_active = ""; 
		
		if($prev_lc_name != $arr_vals['lc_name'])
		{
			echo "<tr>";
			echo "<td class='w-20'><a href='javascript: void(0);' onclick='show_cat(".$arr_vals['lc_id'].")'><span id='spanl_".$arr_vals['lc_id']."'>(+)</span> ".$arr_vals['lc_name']."</a></td>";
			echo "<td colspan='4'></td>";
			echo "<td><a href='#' class='btn btn-danger btn-circle btn-sm' onclick='delete_id(\"assign\", \"lifecycle\", ".$arr_vals['lc_id'].");' data-toggle='modal' data-target='#DeleteModal'><i class='fas fa-trash'></i></a></td>";
			echo "</tr>";
		}

		if($prev_cat_name != $arr_vals['cat_name'])
		{
			echo "<tr id='trl_".$arr_vals['lc_id']."_".$arr_vals['cat_id']."' class='disabled-table-row'>";
			echo "<td></td>";
			echo "<td><a href='javascript: void(0);' onclick='show_ind(".$arr_vals['lc_id'].",".$arr_vals['cat_id']." )'><span id='spani_".$arr_vals['lc_id']."_".$arr_vals['cat_id']."'>(+)</span> ".$arr_vals['cat_name']."</a></td>";
			echo "<td colspan='3'></td>";
			echo "<td><a href='javascript: void(0);' class='btn btn-danger btn-circle btn-sm' onclick='delete_id(\"assign\", \"category\", ".$arr_vals['cat_id'].");'  data-toggle='modal' data-target='#DeleteModal'><i class='fas fa-trash'></i></a></td>";
			echo "</tr>";
		}
		
		
		echo "<tr id='tri_".$arr_vals['lc_id']."_".$arr_vals['cat_id']."_".$arr_vals['ind_id']."' class='disabled-table-row'>";
		echo "<td colspan='2' class='w-20'></td>";
		echo "<td class='w-20'><input type='text' name='order_by[".$arr_vals['ind_id']."]' value='".$arr_vals['ind_orderby']."' size='2'></td>";
		echo "<td>
		<label class='switch'>
		  <input type='checkbox' name='chk_ind_".$arr_vals['ind_id']."' id='chk_ind_".$arr_vals['ind_id']."' onclick='status_id(\"assign\",this,\"indicator\",".$arr_vals['ind_id'].");'  data-toggle='modal' data-target='#DeleteModal' ".$ind_active.">
		<span class='slider round'></span>
		</label>
		&nbsp;
		<a href='add_indicator.php?indid=".base64_encode($arr_vals['ind_id'])."' >".$arr_vals['ind_name']."</a></td>";
		echo "<td>".$arr_vals['ind_url']."</td>";
		echo "<td><a href='javascript: void(0);' class='btn btn-danger btn-circle btn-sm' onclick='delete_id(\"assign\", \"indicator\", ".$arr_vals['ind_id'].");' data-toggle='modal' data-target='#DeleteModal'><i class='fas fa-trash'></i></a></td>";
		echo "</tr>";

		$prev_lc_name = $arr_vals['lc_name'];
		$prev_cat_name = $arr_vals['cat_name'];
	}
	
	echo "<tr>";
	echo "<td colspan='6'><input type='submit' name='btn_submit' value='Update' class='btn btn-primary' ></td>";
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

		<!-- Modal-->
		<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="DeleteModal">Are you sure ?</h5>
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
		<!-- End of Modal -->
    </div>
    <!-- End of Page Wrapper -->
	<form name="frm_action" id="frm_action" method="post" action="ajax_actions.php">
		<input type='hidden' name="hdn_type" id="hdn_type" value=''>
		<input type='hidden' name="hdn_id" id="hdn_id" value=''>
		<input type='hidden' name="hdn_action" id="hdn_action" value=''>
	</form>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo JS_WEBROOT;?>jquery36.min.js"></script>
    <script src="<?php echo JS_WEBROOT;?>bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo VENDOR_WEBROOT;?>jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo JS_WEBROOT;?>custom.min.js"></script>
	<script>
		function show_cat(lcid)
		{
			if($("span[id^='spanl_"+lcid+"']").html() == "(+)")
			{
				$("tr[id^='trl_"+lcid+"']").removeClass("disabled-table-row");
				$("tr[id^='trl_"+lcid+"']").addClass("enabled-table-row");
				$("tr[id^='tri_"+lcid+"']").removeClass("disabled-table-row");
				$("tr[id^='tri_"+lcid+"']").addClass("enabled-table-row");

				$("span[id^='spanl_"+lcid+"']").html("(-)");
			}
			else 
			{
				$("tr[id^='trl_"+lcid+"']").addClass("disabled-table-row");
				$("tr[id^='trl_"+lcid+"']").removeClass("enabled-table-row");
				$("tr[id^='tri_"+lcid+"']").addClass("disabled-table-row");
				$("tr[id^='tri_"+lcid+"']").removeClass("enabled-table-row");

				$("span[id^='spanl_"+lcid+"']").html("(+)");
			}
		}
		
		function show_ind(lcid, catid)
		{
			if($("span[id^='spani_"+lcid+"_"+catid+"']").html() == "(+)")
			{
				$("tr[id^='tri_"+lcid+"_"+catid+"']").removeClass("disabled-table-row");
				$("tr[id^='tri_"+lcid+"_"+catid+"']").addClass("enabled-table-row");
				$("span[id^='spani_"+lcid+"_"+catid+"']").html("(-)");
			}
			else 
			{
				$("tr[id^='tri_"+lcid+"_"+catid+"']").addClass("disabled-table-row");
				$("tr[id^='tri_"+lcid+"_"+catid+"']").removeClass("enabled-table-row");
				$("span[id^='spani_"+lcid+"_"+catid+"']").html("(+)");
			}
		}
		
		function submit_action()
		{
			$("#frm_action").submit();
		}
		
		function delete_id(action, type='' , ind_id='')
		{
			if(action == 'assign')
			{
				$("#hdn_type").val(type);
				$("#hdn_id").val(ind_id);
				$("#hdn_action").val('delete');
				$("#actionid").html('Delete');
				
				if(type == 'indicator')
				{
					$(".modal-body").html("This INDICATOR will be deleted permanently.");
				}
				else if(type == 'category')
				{
					$(".modal-body").html("This CATEGORY will be deleted along with all of its indicators!");
				}
				else if(type == 'lifecycle')
				{
					$(".modal-body").html("This LIFECYCLE will be deleted along with all its categories and indicators!");
				}
			}
			else if(action == 'status')
			{
				$("#frm_action").submit();
			}
		}

		function status_id(action, ele='', type='' , ind_id='')
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
				$("#hdn_type").val(type);
				$("#hdn_id").val(ind_id);
				$("#hdn_action").val(act);
				
				if(type == 'indicator')
				{
					$(".modal-body").html("This INDICATOR will be "+act_txt+".");
				}
				else if(type == 'category')
				{
					$(".modal-body").html("This CATEGORY will be "+act_txt+" along with all of its indicators!");
				}
				else if(type == 'lifecycle')
				{
					$(".modal-body").html("This LIFECYCLE will be "+act_txt+" along with all its categories and indicators!");
				}
			}
			else if(action == 'active' || action == 'deactive' )
			{
				$("#frm_action").submit();
			}
		}
		
	</script>
</body>
</html>