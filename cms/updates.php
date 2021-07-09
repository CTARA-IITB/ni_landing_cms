<?php
require_once '../config.php';

/**** used in config_sidebar starts ***/
$arr_sidenav['updates']['active'] = "active"; //used in sidebar;
$arr_sidenav['updates']['collapse'] = "show"; //used in sidebar;
$arr_sidenav['updates']['expanded']	= "true";
$arr_sidenav['updates']['show_all']['active'] = "active"; //used in sidebar;

/**** used in config_sidebar ends ***/

if(isset($_POST['btn_submit']))
{
	require_once 'actions/add_update.php';
}

$sql 	 = "SELECT upt_id, upt_desc, order_by, upt_active FROM tbl_update_master ORDER BY order_by";
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
                    <h1 class="h3 mb-4 text-gray-800">Lifecycles</h1>
					
					<table class="table bordered">
						<tr>
							<th class='w-10'>Order By</th>
							<th class='w-70'>Description</th>
							<th>Actions</th>
						</tr>
<?php
if($arr_res['num_rows'] > 0)
{
	echo "<form name='frm_uptorder' method='post' action='updates.php'> ";
	echo "<input type='hidden' name='hdn_process' value='order' >";
	foreach($arr_res['records'] as $key => $arr_vals)
	{
		if($arr_vals['upt_active'] > 0) $checked = "checked"; else $checked = "";
		
		echo "<tr>";
		echo "<td><input type='text' name='order_by[".$arr_vals['upt_id']."]' value='".$arr_vals['order_by']."' size='2'></td>";
		echo "<td>".$arr_vals['upt_desc']."</td>";
		echo "<td>
		<label class='switch'>
  <input type='checkbox' name='chk_ind_".$arr_vals['upt_id']."' id='chk_ind_".$arr_vals['upt_id']."' onclick='status_id(\"assign\",this,".$arr_vals['upt_id'].");'  data-toggle='modal' data-target='#DeleteModal' ".$checked.">
<span class='slider round'></span>
</label>
<a href='add_update.php?uptid=".base64_encode($arr_vals['upt_id'])."' class='btn btn-warning btn-circle btn-sm'><i class='fas fa-edit'></i></a>

<a href='javascript: void(0);' class='btn btn-danger btn-circle btn-sm' onclick='delete_id(\"assign\", ".$arr_vals['upt_id'].");' data-toggle='modal' data-target='#DeleteModal'><i class='fas fa-trash'></i></a>

		</td>";
		echo "</tr>";
	}
	
	echo "<tr>";
	echo "<td colspan='3'><input type='submit' name='btn_submit' value='Update' class='btn btn-primary' ></td>";
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
	<Script>
		
		function submit_action()
		{
			$("#frm_action").submit();
		}
		
		function delete_id(action, upt_id='')
		{
			if(action == 'assign')
			{
				$("#hdn_type").val('updates');
				$("#hdn_id").val(upt_id);
				$("#hdn_action").val('delete');
				$("#actionid").html('Delete');
				$(".modal-body").html("This update will be deleted permanently.");
			}
			else if(action == 'status')
			{
				$("#frm_action").submit();
			}
		}

		function status_id(action, ele='', upt_id='')
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
				$("#hdn_type").val('updates');
				$("#hdn_id").val(upt_id);
				$("#hdn_action").val(act);
				$(".modal-body").html("This update will be "+act_txt+".");
			}
			else if(action == 'active' || action == 'deactive' )
			{
				$("#frm_action").submit();
			}
		}
	</Script>
</body>
</html>