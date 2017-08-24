<?php
session_start();
error_reporting(E_ALL^E_NOTICE); //取消警告显示
header('Content-type:application/json');
//是否登录
if ($_SESSION['login']) {
	$dstname=$_SESSION['login'].'.jpg';
	if(move_uploaded_file($_FILES["files"]["tmp_name"],'userheadimg/'.$dstname))
		$res='ok';
	else
		$res='fail';
}
else
{
	$res='请先登录！';
}
   echo json_encode(array('resault'=>$res));
?>