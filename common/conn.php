<?php
	include_once($_SERVER['DOCUMENT_ROOT']."/common/config.php");
	$con = mysqli_connect($db_host, $db_user, $db_pw,$db_name);
	mysqli_query($con,"set character set '{$db_charset}'");//读库 
	mysqli_query($con,"set names '{$db_charset}'");//写库
?>