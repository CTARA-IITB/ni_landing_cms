<?php
require_once '../config.php';

/**** used in config_sidebar starts ***/

$arr_sidenav['dashboard']['active'] = "active"; //used in sidebar;

/**** used in config_sidebar ends ***/
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
                    <h1 class="h3 mb-4 text-gray-800">Admin Dashboard</h1>
					
					<div class="col-4 mb-4 float-left">
						<div class="card bg-success text-white shadow p-4 text-center">
							<div class="card-body">
								<a href='lifecycles.php' class='text-white'><h1>Lifecycles</h1></a>
							</div>
						</div>
					</div>
					
					<div class="col-4 mb-4 float-left">
						<div class="card bg-success text-white shadow  p-4 text-center">
							<div class="card-body">
								<a href='categories.php' class='text-white'><h1>Category</h1></a>
							</div>
						</div>
					</div>
					
					<div class="col-4 mb-4 float-left">
						<div class="card bg-success text-white shadow  p-4 text-center">
							<div class="card-body">
								<a href='indicators.php' class='text-white'><h1>Indicators</h1></a>
							</div>
						</div>
					</div>
					<div class="col-4 mb-4 float-left">
						<div class="card bg-warning text-white shadow  p-4 text-center">
							<div class="card-body">
								<a href='updates.php' class='text-white'><h1>Updates</h1></a>
							</div>
						</div>
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