<?php

if(preg_match("/localhost/",$_SERVER['HTTP_HOST']))
{
	//local
	define("APP_ROOT",__DIR__);
	define("WEB_ROOT","http://localhost/nutritionindia/");
	define("DB_SERVER","localhost");
	define("DB_USER","root");
	define("DB_PASS","");
	define("DB_NAME","xxxxx");
}
else if(preg_match("/demo/",$_SERVER['PHP_SELF']))
{
	//demo
	define("APP_ROOT",__DIR__);
	define("WEB_ROOT","https://prodi.tech/demo/nutrition_india/");
	define("DB_SERVER","xxxxx");
	define("DB_USER","xxxxx");
	define("DB_PASS","xxxxx");
	define("DB_NAME","xxxxx");
}
else if(preg_match("/nindia/",$_SERVER['PHP_SELF']) || preg_match("/52.66.249.188/",$_SERVER['HTTP_HOST']))
{
	// nindia development server
	define("APP_ROOT",__DIR__);
	define("WEB_ROOT","http://52.66.249.188/nindia/");
	define("DB_SERVER","localhost");
	define("DB_USER","xxxxx");
	define("DB_PASS","xxxxx");
	define("DB_NAME","xxxxx");
}
else 
{
	// production server
	define("APP_ROOT",__DIR__);
	define("WEB_ROOT","http://134.209.155.210/");
	define("DB_SERVER","xxxx");
	define("DB_USER","xxxx");
	define("DB_PASS","xxxx");
	define("DB_NAME","xxxx");
}

define("CSS_WEBROOT",WEB_ROOT."css/");
define("JS_WEBROOT",WEB_ROOT."js/");
define("FONTS_WEBROOT",WEB_ROOT."fonts/");
define("INCLUDES_APPROOT", APP_ROOT."/includes/"); 	// for file structure
define("INCLUDES_WEBROOT",WEB_ROOT."includes/"); 	// for access via url
define("IMAGES_WEBROOT",WEB_ROOT."images/"); 		// for access via url
define("IMAGES_APPROOT",APP_ROOT."/images/"); 		// for access via url
define("SCRIPTS_WEBROOT",WEB_ROOT."scripts/");
define("BACKEND_APPROOT",APP_ROOT."/cms/");
define("BACKEND_WEBROOT",WEB_ROOT."cms/");
define("VENDOR_WEBROOT",BACKEND_WEBROOT."vendor/");

define("DUBAI_MOBILE_CODE","+971");

$GLOBALS['maintenance_fend'] = false;
$GLOBALS['maintenance_bend'] = false;

date_default_timezone_set("Asia/Kolkata");

require_once APP_ROOT. '/config_sql_safe.php';
require_once APP_ROOT. '/check_session.php';
require_once BACKEND_APPROOT. 'config_sidebar.php';

?>
