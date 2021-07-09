<?php
require_once '../config.php';
//print_r($_SESSION);

$success_message = '';
$error_message = '';

//post processing
if(!empty($_POST['btn_submit']))
{
	include_once 'actions/change-password.php';
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
                    <h1 class="h3 mb-4 text-gray-800">Change Password</h1>
					<div class="col-lg-6">
						<div class="p-5">
							<?php 
								if(!empty($error_message))
								{
							?>
							<div class="text-center">
							<a href="#" class="btn btn-danger btn-icon-split">
								<span class="icon text-white-50">
									<i class="fas fa-exclamation-triangle"></i>
								</span>
								<span class="text"><?php echo $error_message; ?></span>
							</a>
							<br><br>
							</div>
							<?php
								}
							?>
							<?php 
								if(!empty($success_message))
								{
							?>
							<div class="text-center">
							<a href="#" class="btn btn-success btn-icon-split">
								<span class="icon text-white-50">
									<i class="fas fa-check"></i>
								</span>
								<span class="text"><?php echo $success_message; ?></span>
							</a>
							<br><br>
							</div>
							<?php
								}
							?>
							<div class="text-center">
								<span class="small">Enter any 4 digits that you can remember.</span>
							</div>
							
							<form class="user" action="change_password.php" method="post">
								<input type="hidden" name="token" value="<?php echo $token; ?>">
								<div class="form-group">
									<input type="password" class="form-control form-control-user" name="password" placeholder="Enter Password" maxlength="4" required>
								</div>
								<div class="form-group">
									<input type="password" class="form-control form-control-user" name="confirm_password" placeholder="Confirm Password" maxlength="4" required>
								</div>
								<input type="submit" name="btn_submit" class="btn btn-primary btn-user btn-block" value="Submit" />
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
    <!-- Custom scripts for all pages-->
    <script src="<?php echo JS_WEBROOT;?>custom.min.js"></script>
</body>
</html>