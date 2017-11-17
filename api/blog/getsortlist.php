<?php 
	/*
	获取榜单列表
	参数：
		type：类型 必须字段
		   └─answer 回贴月榜 用户回复次数排名
		   └─talk   近期热议 被回复次数排名
		   └─browse 最近热帖 浏览次数排名
		num：列表数量  默认值：12
	*/
	date_default_timezone_set("Asia/Shanghai");
	error_reporting(E_ALL^E_NOTICE); //取消警告显示
	header('Content-type:application/json');
	include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";

	// 类型,
	if(isset($_POST['type']))
	{
		$type = $_POST['type'];
	}
	else
	{
		// 返回错误信息
		$myArray["resault"] = 'fail'; 
		$myArray["msg"] = '缺少type字段！';  
		$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
		echo $json;
		exit();
	}

	// 列表数量  默认值：12
	if(isset($_POST['num']))
	{
		//定义每页显示数量
		$num = $_POST['num'];
	}
	else
		$num = 12;

	// 回贴月榜 用户回复次数排名
	if ($type=='answer') {
		$myArray["type"] = 'answer'; 

		$sqlsort = "select userid,count(*) from bloganswer group by userid 
		order by count(*) desc limit {$num}";
		$sqlsort=mysqli_query($con,$sqlsort);
		while($top=mysqli_fetch_array($sqlsort))
		{
		 	// 获取用户信息,用于显示用户头像
			$sql="select * from user where userid='{$top['userid']}'";
			$query=mysqli_query($con,$sql);
			$row = mysqli_fetch_array($query);
			$indexArray["avatar"] = $row['avatar'];//用户头像
			$indexArray["nickname"] = $row['nickname'];//用户昵称
			$indexArray["userid"] = $row['userid'];//用户id
			$indexArray["count"] = $top['count(*)'];//回答次数

			$myArray["list"][] = $indexArray;
		}
	}
	else
	// 近期热议 被回复次数排名
	if ($type=='talk') {
		$myArray["type"] = 'talk'; 
		//获取回复次数排序
		$sqltalk = "select toid,count(*) from bloganswer group by toid 
		order by count(*) desc limit {$num}";
		$sqltalk=mysqli_query($con,$sqltalk);
		while($ans=mysqli_fetch_array($sqltalk))
		{
			//获取热议文章信息
			$sql="select userid,title from blog where id='{$ans['toid']}'";
			$query=mysqli_query($con,$sql);
			$row = mysqli_fetch_array($query);

			$indexArray["id"] = $ans['toid'];//贴子id
			$indexArray["userid"] = $ans['userid'];//发帖人id
			$indexArray["title"] = $row['title'];//帖子标题
			$indexArray["count"] = $ans['count(*)'];//讨论次数

			$myArray["list"][] = $indexArray;
        }
	}
	else
	// 最近热帖 浏览次数排名
	if ($type=='browse') {

		$myArray["type"] = 'browse'; 
		$sqlhit = "select title,hits,id from blog order by hits desc limit {$num}";
		$sqlhit=mysqli_query($con,$sqlhit);
		while($hit=mysqli_fetch_array($sqlhit))
		{
			$indexArray["id"] = $hit['id'];//贴子id
			$indexArray["title"] = $hit['title'];//帖子标题
			$indexArray["count"] = $hit['hits'];//浏览次数

			$myArray["list"][] = $indexArray;
        }
	}

	$myArray["resault"] = 'success';  
	// mysqli_close($con);
	// print_r($myArray); 
	$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
	echo $json;
 ?>