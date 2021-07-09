<?php
require_once '../config.php';
require_once 'functions.php';

/**** used in config_sidebar starts ***/
$arr_sidenav['category']['add']['active']  = "active"; //used in sidebar;
$arr_sidenav['category']['active'] 		= "active"; //used in sidebar;
$arr_sidenav['category']['collapse'] 		= "show"; //used in sidebar;
$arr_sidenav['category']['expanded']		= "true";
/**** used in config_sidebar ends ***/

$catid 			= base64_decode($_GET['catid']);
$head_text 		= "Add";
$error_message 	= "";
if(isset($_POST['btn_submit']))
{
	require_once 'actions/add_category.php';
}

if($catid > 0)
{
	$sql = "SELECT tc.cat_id, tc.cat_name, tc.cat_desc, lm.lc_id FROM tbl_category tc LEFT JOIN tbl_lifecycle_master lm ON tc.lc_id=lm.lc_id WHERE tc.cat_id=ARG0";
	$arr_res = sql_query($sql, array('numeric'), array($catid));
	
	$lc_id = $arr_res['records'][0]['lc_id'];
	$cat_name = $arr_res['records'][0]['cat_name'];
	$cat_desc = $arr_res['records'][0]['cat_desc'];
	$cat_url = $arr_res['records'][0]['cat_url'];
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
                    <h1 class="h3 mb-4 text-gray-800 green-font"><?php echo $head_text; ?> Category</h1>
					
					<?php if(!empty($error_message)) { echo show_error($error_message); } ?>
					
					<div class="row">
						<form class="" style="width:100%" method="post" action="add_category.php">
							<input type="hidden" name="hdn_catid" value="<?php echo $catid; ?>">
							<table class="table table-borderless" width="100%" cellspacing="0">
								<tr>
									<td class="w-20"><sup class="text-danger">*</sup> Select Lifecyle:</td>
									<td>
										<select class="form-control w-30" name="sel_catid" required>
										<?php 
											echo getOptions_Lifecycles($lc_id);
										?>
										</select>
									</td>
								</tr>
								
								<tr>
									<td><sup class="text-danger">*</sup> Category Name:</td>
									<td><input type="text" class="form-control w-30" id="cat_name" name="cat_name" placeholder="Enter Category Name" required value="<?php echo $cat_name;?>"></td>
								</tr>
								
								<tr>
									<td><sup class="text-danger">*</sup> Category Descriptive Text:</td>
									<td><textarea type="text" class="form-control" id="cat_desc" name="cat_desc" placeholder="Enter Category Description" required maxlength="300"><?php echo $cat_desc;?></textarea></td>
								</tr>
								
								<tr>
									<td>Category URL:</td>
									<td><input type="text" class="form-control" id="cat_url" name="cat_url" placeholder="Enter Category URL" value="<?php echo $cat_url;?>"></td>
								</tr>
								
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
</body>
</html>