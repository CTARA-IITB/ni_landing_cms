<?php
require_once '../config.php';

/**** used in config_sidebar starts ***/
$arr_sidenav['updates']['add']['active']  = "active"; //used in sidebar;
$arr_sidenav['updates']['active'] 		= "active"; //used in sidebar;
$arr_sidenav['updates']['collapse'] 		= "show"; //used in sidebar;
$arr_sidenav['updates']['expanded']		= "true";
/**** used in config_sidebar ends ***/

$uptid = base64_decode($_GET['uptid']);
$head_text = "Add";
if(isset($_POST['btn_submit']))
{
	require_once 'actions/add_update.php';
}

if($uptid > 0)
{
	$sql = "SELECT upt_title, upt_desc, upt_url FROM tbl_update_master WHERE upt_id=ARG0";
	$arr_res = sql_query($sql, array('numeric'), array($uptid));
	
	$upt_desc = $arr_res['records'][0]['upt_desc'];
	$upt_url = $arr_res['records'][0]['upt_url'];
	$upt_title = $arr_res['records'][0]['upt_title'];
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
                    <h1 class="h3 mb-4 text-gray-800 green-font"><?php echo $head_text; ?> Updates</h1>
					
					<div class="row">
						<form class="" style="width:100%" method="post" action="add_update.php" enctype="multipart/form-data">
							<input type="hidden" name="hdn_uptid" value="<?php echo $uptid; ?>">
							<table class="table table-borderless" width="100%" cellspacing="0">
								<!--
								<tr>
									<td class='w-20'><sup class="text-danger">*</sup> Descriptive Title:</td>
									<td class='w-60'><textarea type="text" class="form-control" id="upt_title" name="upt_title" placeholder="Enter Title" required><?php echo $upt_title;?></textarea></td>
								</tr>
								-->
								<tr>
									<td class='w-20'><sup class="text-danger">*</sup> Descriptive Text:</td>
									<td class='w-60'><textarea type="text" class="form-control" id="upt_desc" name="upt_desc" placeholder="Enter Description" required><?php echo $upt_desc;?></textarea></td>
								</tr>
								<tr>
									<td> URL:</td>
									<td><input type="url" class="form-control" id="upt_url" name="upt_url" placeholder="Enter  URL" value="<?php echo $upt_url;?>"></td>
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