<?php
session_start();

if($GLOBALS['maintenance_fend'] === true)
{
	require WEB_ROOT. "/maintenance.php";
	exit;
}
else if(preg_match("/bend/",$_SERVER['PHP_SELF']))
{
	// this is for admin section
	if($GLOBALS['maintenance_bend'] === true)
	{
		require BACKEND_APPROOT. "/maintenance.php";
		exit;
	}
	else 
	{
		
	}
}
else 
{
	// these pages do not require sessions.
	$files_not_for_session = "index.php|register.php|login.php|forgot-password.php|reset-password.php";
	if(!preg_match("/$files_not_for_session/i",$_SERVER['PHP_SELF']))
	{
		// if session is empty but cookies has values then update the session
		if(empty($_SESSION['user_type']))
		{
			// else : if session and cookie is both empty then redirect to signin page
			header("Location: ". BACKEND_WEBROOT. "login.php");
			exit;
		}
		else 
		{
			// if session and cookie are both present then do nothing
		}
	}
}

?>