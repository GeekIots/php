<?php  
	/*
	获取、收藏、取消收藏帖子  
	
	获取：
	  type：get
	  userid：用户id
	设置收藏：
	  type：set
	  userid：用户id
	  blogid：收藏的帖子id
	取消收藏：
	  type：cancel
	  userid：用户id
	  blogid：取消收藏的帖子id	
	*/
	date_default_timezone_set("Asia/Shanghai");
	error_reporting(E_ALL^E_NOTICE); //取消警告显示
	header('Content-type:application/json');
	include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";

	// 参数检查
	if(isset($_POST['type']))
	{
		$type = $_POST['type'];
	}
	else
	{
		$myArray["resault"] = 'fail';  
		$myArray["msg"] = '缺少type字段！';
		$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
		echo $json;
		exit();
	}

	if(isset($_POST['userid']))
	{
		$userid = $_POST['userid'];
	}
	else
	{
		$myArray["resault"] = 'fail';  
		$myArray["msg"] = '缺少userid字段！';
		$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
		echo $json;
		exit();
	}

	if ($type=='set'||$type=='cancel') {
		if(isset($_POST['blogid']))
		{
			$blogid = $_POST['blogid'];
		}
		else
		{
			$myArray["resault"] = 'fail';  
			$myArray["msg"] = '缺少blogid字段！';
			$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
			echo $json;
			exit();
		}
	}
	// 获取收藏
	if ($type=='get') {
		$sql="select * from blog_collect where userid = '{$userid}' order by dates desc";
		$query=mysqli_query($con,$sql); 
		$num = 0;
		while($rs=mysqli_fetch_array($query))
		{
			//获取标题
			$sqlblog="select title from blog where id='{$rs['blogid']}'";
			$queryblog=mysqli_query($con,$sqlblog);
			$blog=mysqli_fetch_array($queryblog);
			
			$indexArray["id"]=$rs['blogid'];//帖子id
			$indexArray["title"]=$blog['title'];//帖子标题
			$indexArray["dates"]=$rs['dates'];//收藏时间
			$indexArray["classify"] = $blog['classify'];//分类

			$myArray["list"][] = $indexArray;
			$num++;
		}
	}
	// 设置收藏
	else
	if ($type=='set') {
		
	}
	// 取消收藏
	else
	if ($type=='cancel') {
		
	}

	$myArray["length"] = $num; //list列表元素个数 
	$myArray["resault"] = 'success';  
	mysqli_close($con);
	// print_r($myArray); 
	$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
	echo $json;
?>