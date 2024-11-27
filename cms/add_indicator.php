<?php
require_once '../config.php';
require_once 'functions.php';

/**** used in config_sidebar starts ***/
$arr_sidenav['indicators']['add']['active']  = "active"; //used in sidebar;
$arr_sidenav['indicators']['active'] 		= "active"; //used in sidebar;
$arr_sidenav['indicators']['collapse'] 		= "show"; //used in sidebar;
$arr_sidenav['indicators']['expanded']		= "true";
/**** used in config_sidebar ends ***/

$indid 			= base64_decode($_GET['indid']);
$head_text 		= "Add";
$error_message 	= "";
if(isset($_POST['btn_submit']))
{
	require_once 'actions/add_indicator.php';
}

if($indid > 0)
{
	$sql = "SELECT tind.lc_id, tind.cat_id, tind.ind_name, tind.ind_url FROM tbl_indicators tind 
				LEFT JOIN tbl_category tc ON tind.cat_id = tc.cat_id 
				LEFT JOIN tbl_lifecycle_master lm ON tind.lc_id=lm.lc_id 
				WHERE tind.ind_id=ARG0 
			";
	$arr_res = sql_query($sql, array('numeric'), array($indid));
	
	$lc_id = $arr_res['records'][0]['lc_id'];
	$cat_id = $arr_res['records'][0]['cat_id'];
	$ind_name = $arr_res['records'][0]['ind_name'];
	$ind_url = $arr_res['records'][0]['ind_url'];
	$head_text = "Edit";
}
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
                    <h1 class="h3 mb-4 text-gray-800 green-font"><?php echo $head_text; ?> Indicator</h1>
					<?php if(!empty($error_message)) { echo show_error($error_message); } ?>
					<div class="bg-warning w-50 text-center" id="div_error"></div>
					<div class="row">
						<form id="frm_indicator" name="frm_indicator" class="" style="width:100%" method="post" action="add_indicator.php" onsubmit="return validate();">
							<input type="hidden" name="hdn_indid" value="<?php echo $indid; ?>">
							<table class="table table-borderless" width="100%" cellspacing="0">
								<tr>
									<td class="w-20"><sup class="text-danger">*</sup> Select Lifecyle:</td>
									<td>
										<select class="form-control w-30" name="sel_lcid" id="sel_lcid"  required>
											<option value='0'>-- Select --</option>
										<?php 
												echo getOptions_Lifecycles($lc_id);
										?>
										</select>
									</td>
								</tr>
								<tr>
									<td class="w-20"><sup class="text-danger">*</sup> Select Category:</td>
									<td>
										<select class="form-control w-30" name="sel_catid" id="sel_catid" required>
											<option value='0'>-- Select --</option>
										<?php 
											if(!empty($lc_id) && !empty($cat_id))
												echo getOptions_Category($lc_id, $cat_id);
										?>
										</select>
									</td>
								</tr>
								
								<tr>
									<td colspan='2'>
										<div class="float-left w-30">
											<sup class="text-danger">*</sup> Indicator Name 1:
											<input type="text" class="form-control enabled-table-row w-auto" name="ind_name[]" placeholder="Enter Indicator Name" required value="<?php echo $ind_name;?>" id="indname1">
										</div>
										<div class="float-left w-50">
											<sup class="text-danger">*</sup> Indicator URL 1:
											<input type="text" class="form-control enabled-table-row w-70" name="ind_url[]" placeholder="Enter Indicator URL" value="<?php echo $ind_url;?>" required  id="indurl1">
										</div>
									</td>
								</tr>
<?php
	if($head_text == "Add")
	{
?>
								<tr>
									<td colspan='2'>
										<div class="float-left w-30">
											Indicator Name 2:
											<input type="text" class="form-control enabled-table-row w-auto" name="ind_name[]" placeholder="Enter Indicator Name" value="<?php echo $ind_name;?>" id="indname2">
										</div>
										<div class="float-left w-50">
											Indicator URL 2:
											<input type="text" class="form-control enabled-table-row w-70" name="ind_url[]" placeholder="Enter Indicator URL" value="<?php echo $ind_url;?>"  id="indurl2">
										</div>
									</td>
								</tr>
								<tr>
									<td colspan='2'>
										<div class="float-left w-30">
											Indicator Name 3:
											<input type="text" class="form-control enabled-table-row w-auto" name="ind_name[]" placeholder="Enter Indicator Name" value="<?php echo $ind_name;?>"  id="indname3">
										</div>
										<div class="float-left w-50">
											Indicator URL 3:
											<input type="text" class="form-control enabled-table-row w-70" name="ind_url[]" placeholder="Enter Indicator URL" value="<?php echo $ind_url;?>"  id="indurl3">
										</div>
									</td>
								</tr>
								
								
								<tr>
									<td colspan='2'>
										<div class="float-left w-30">
											Indicator Name 4:
											<input type="text" class="form-control enabled-table-row w-auto" name="ind_name[]" placeholder="Enter Indicator Name" value="<?php echo $ind_name;?>"  id="indname4">
										</div>
										<div class="float-left w-50">
											Indicator URL 4:
											<input type="text" class="form-control enabled-table-row w-70" name="ind_url[]" placeholder="Enter Indicator URL" value="<?php echo $ind_url;?>"  id="indurl4" >
										</div>
									</td>
								</tr>
								
								<tr>
									<td colspan='2'>
										<div class="float-left w-30">
											Indicator Name 5:
											<input type="text" class="form-control enabled-table-row w-auto" name="ind_name[]" placeholder="Enter Indicator Name" value="<?php echo $ind_name;?>" id="indname5">
										</div>
										<div class="float-left w-50">
											Indicator URL 5:
											<input type="text" class="form-control enabled-table-row w-70" name="ind_url[]" placeholder="Enter Indicator URL" value="<?php echo $ind_url;?>"  id="indurl5">
										</div>
									</td>
								</tr>
<?php
	}
?>
								<tr>
									<td colspan="2"><input type="submit" name="btn_submit" class="btn btn-primary btn-block" value="<?php echo $head_text;?>"></td>
								</tr>
							</table>
						</form>
					</div>
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

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo JS_WEBROOT;?>jquery36.min.js"></script>
    <script src="<?php echo JS_WEBROOT;?>bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo VENDOR_WEBROOT;?>jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo JS_WEBROOT;?>custom.min.js"></script>
	
	<script>
		$("#sel_lcid").change(function(){
			$.ajax({
                url: "ajax_category.php",
                method: "POST",
                dataType: "json",
                data: {
                    lcid: $(this).val(),
                    catid: ''
                },
                success: function (response) {
                    //alert(response.status)
                    if (response.status == 'success') {
						$("#sel_catid").empty().append(response.content);
                    }
					else if (response.status == 'error') {
						$("#sel_catid").empty();
                    }
                }
            });
		});
		
		function validate()
		{
			var err = '';
			if($("#sel_lcid").prop('selectedIndex') < 1)
			{
				err += 'Please select Lifecyle<br>';
			}
			
			if($("#sel_catid").prop('selectedIndex') < 1)
			{
				err += 'Please select Category<br>';
			}
			
			if( ($("#indname1").val() == '')  || ($("#indurl1").val() == ''))
			{
				err += 'Please enter Indicator Name and URL 1<br>';
			}
			
			if(($("#indname2").val() != '' && $("#indurl2").val() == '') || ($("#indname2").val() == '' && $("#indurl2").val() != ''))
			{
				err += 'Please enter Indicator Name and URL 2<br>';
			}
			
			if(($("#indname3").val() != '' && $("#indurl3").val() == '') || ($("#indname3").val() == '' && $("#indurl3").val() != ''))
			{
				err += 'Please enter Indicator Name and URL 3<br>';
			}
			
			if(($("#indname4").val() != '' && $("#indurl4").val() == '') || ($("#indname4").val() == '' && $("#indurl4").val() != ''))
			{
				err += 'Please enter Indicator Name and URL 4<br>';
			}
			
			if(($("#indname5").val() != '' && $("#indurl5").val() == '') || ($("#indname5").val() == '' && $("#indurl5").val() != ''))
			{
				err += 'Please enter Indicator Name and URL 5<br>';
			}
			
			if(err != '')
			{
				$("#div_error").html(err);
				return false;
			}
			else 
			{
				$("#frm_indicator").submit();
			}
		}
	</script>
</body>
</html>