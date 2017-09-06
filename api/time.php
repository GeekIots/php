<?php 
	error_reporting(E_ALL^E_NOTICE); //取消警告显示
	header('Content-type:application/json');
	date_default_timezone_set("Asia/Shanghai");

	$myArray["year"] = date("Y");
	$myArray["mouth"] = date("m");
	$myArray["day"] = date("d");

	$myArray["week"] = date("N");

	$myArray["hour"] = date("H");
	$myArray["minute"] = date("i");
	$myArray["second"] = date("s");
	// print_r($myArray);	
	$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
	echo $json;
?>

