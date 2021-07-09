<?php

require_once '../config.php';
require_once 'functions.php';
$lcid = $_POST['lcid'];	
$catid = $_POST['catid'];

$return = getOptions_Category($lcid, $catid);

if($return === false)
{
	echo json_encode(array("status"=>"failure", "message"=>""));
}
else 
{
	echo json_encode(array("status"=>"success", "message"=>"", "content"=>$return));
}
?>