<?php
error_reporting(E_ALL^E_NOTICE); //取消警告显示
// header('Content-type:application/json');
header("Content-type: text/html; charset=utf-8");
include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";

if (!empty($_GET["userid"])) {
	$userid = $_GET["userid"];

	$sql="update user set active='1' where userid=$userid";
	mysqli_query($con,$sql);
	if (mysqli_affected_rows($con)) {
		echo("激活成功！");
	}
	else
		echo("激活失败！");
}  
?>  