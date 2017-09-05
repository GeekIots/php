<?php
error_reporting(E_ALL^E_NOTICE); //取消警告显示
header('Content-type:application/json');
include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
require_once('email.class.php'); 

//初始化发送邮件类
$smtp = new smtp('','','',true,'');
//$smtp->mail("15339287330@126.com", "群发", "测试");

if (!empty($_GET["nickname"])) {
	$nickname = $_GET["nickname"];

	$sql="update user set active='1' where nickname=$nickname";
	mysqli_query($con,$sql);
	if (mysqli_affected_rows($con)) {
		echo("激活成功！");
	}
	else
		echo("激活失败！");
}  
?>  