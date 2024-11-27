<?php
require_once '../config.php';

/**** used in config_sidebar starts ***/
$arr_sidenav['lifecycle']['add']['active']  = "active"; //used in sidebar;
$arr_sidenav['lifecycle']['active'] 		= "active"; //used in sidebar;
$arr_sidenav['lifecycle']['collapse'] 		= "show"; //used in sidebar;
$arr_sidenav['lifecyle']['expanded']		= "true";
/**** used in config_sidebar ends ***/

$lcid = base64_decode($_GET['lcid']);
$head_text = "Add";
if(isset($_POST['btn_submit']))
{
	require_once 'actions/add_lifecycle.php';
}

if($lcid > 0)
{
	$sql = "SELECT lc_name, lc_desc, lc_url, lc_image FROM tbl_lifecycle_master WHERE lc_id=ARG0";
	$arr_res = sql_query($sql, array('numeric'), array($lcid));
	
	$lc_name = $arr_res['records'][0]['lc_name'];
	$lc_desc = $arr_res['records'][0]['lc_desc'];
	$lc_url = $arr_res['records'][0]['lc_url'];
	$lc_image = $arr_res['records'][0]['lc_image'];
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
                    <h1 class="h3 mb-4 text-gray-800 green-font"><?php echo $head_text; ?> Lifecycle</h1>
					
					<?php if(!empty($error_message)) { echo show_error($error_message); } ?>
					
					<div class="row">
						<form class="" style="width:100%" method="post" action="add_lifecycle.php" enctype="multipart/form-data">
							<input type="hidden" name="hdn_pkid" value="<?php echo $lcid; ?>">
							<table class="table table-borderless" width="100%" cellspacing="0">
								<tr>
									<td class="w-20"><sup class="text-danger">*</sup> Lifecyle Name:</td>
									<td><input type="text" class="form-control" id="lc_name" name="lc_name" placeholder="Enter Lifecyle Name" value="<?php echo $lc_name;?>" required></td>
								</tr>
								<tr>
									<td><sup class="text-danger">*</sup> Lifecyle Descriptive Text:</td>
									<td><textarea type="text" class="form-control" id="lc_desc" name="lc_desc" placeholder="Enter Lifecyle Description" required><?php echo $lc_desc;?></textarea></td>
								</tr>
								
								<tr>
									<td><sup class="text-danger">*</sup> Lifecyle Image:</td>
									<td>
										<input type="file" class="form-control" id="lc_image" name="lc_image" placeholder="Choose Lifecyle Image" style="width: 30%; float:left;">
										<?php
											if(!empty($lc_image))
											{
										?>
										<img src='<?php echo IMAGES_WEBROOT."lifecycle/" .$lc_image;?>' class="pl-3">
										<?php
											}
										?>
									</td>
								</tr>
								
								<tr>
									<td> Lifecyle URL:</td>
									<td><input type="text" class="form-control" id="lc_url" name="lc_url" placeholder="Enter Lifecyle URL" value="<?php echo $lc_url;?>"></td>
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