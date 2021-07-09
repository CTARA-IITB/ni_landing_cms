	<?php
require_once '../config.php';

//post processing
if(isset($_POST['btn_submit']))
{
	include_once 'actions/forgot-password.php';
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
<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block  align-self-center text-center"> 
								<img src='<?php echo IMAGES_WEBROOT."nutrition-india-logo.png";?>' width="85%" height="85%">
							</div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Admin Forgot Password</h1>
                                    </div>
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
										else 
										{
									?>
									
                                    <form class="user" action="forgot-password.php" method="post">
 										<div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="email" placeholder="Enter Registered Email" required>
                                        </div>
                                        <input type="submit" name="btn_submit" class="btn btn-primary btn-user btn-block" value="Submit" />
                                    </form>
									<?php
										}
									?>
									<br><br>
									<br>
									<hr>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Sign In</a>
                                    </div>
									<br><br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo JS_WEBROOT;?>jquery36.min.js"></script>
    <script src="<?php echo JS_WEBROOT;?>bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo VENDOR_WEBROOT;?>jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo JS_WEBROOT;?>custom.min.js"></script>
</body>
</html>