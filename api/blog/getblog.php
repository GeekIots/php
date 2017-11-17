<?php  
	/*
	获取帖子列表
	参数：
		id：请求获取的帖子ID 默认值：1
	*/
	date_default_timezone_set("Asia/Shanghai");
	error_reporting(E_ALL^E_NOTICE); //取消警告显示
	header('Content-type:application/json');
	include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";

	if(isset($_POST['id']))
	{
		//定义每页显示数量
		$id = $_POST['id'];
	}
	else
		$id = 1;

	$sql="select * from blog where id='$id'";
	$query=mysqli_query($con,$sql);
	$rs=mysqli_fetch_array($query);
	$myArray["id"] = $rs['id'];//帖子id
	$myArray["title"] = $rs['title'];//帖子标题
	$myArray["contents"] = htmlspecialchars_decode($rs['contents']);//帖子内容
	$myArray["dates"] = $rs['dates'];//发帖时间
	$myArray["count"] = $rs['hits'];//浏览次数
	$myArray["classify"] = $rs['classify'];//分类
	$myArray["userid"] = $rs['userid'];//发帖人id

	// 获取发帖人信息
    $sql22="select * from user where userid='{$rs['userid']}'";
    $query22=mysqli_query($con,$sql22);
    $row22 = mysqli_fetch_array($query22);
    $myArray["avatar"] = $row22['avatar'];//头像
	$myArray["nickname"] = $row22['nickname'];//发帖人昵称

	//增加点击量
	$sql="update blog  set hits = hits+1 where id='$id'";
	mysqli_query($con,$sql);

	//获取回复
	$sqlanswer="select * from bloganswer where toid='$id'";
	$queryanswer=mysqli_query($con,$sqlanswer);
	$floornumber = 0;//楼层
	while ($rsanswer=mysqli_fetch_array($queryanswer)) {
	    $floornumber++;
	    // 获取用户信息,用于显示用户头像
	    $sql11="select * from user where userid='{$rsanswer['userid']}'";
	    $query11=mysqli_query($con,$sql11);
	    $row11 = mysqli_fetch_array($query11);
		
		$indexArray["userid"] = $row11['userid'];//用户ID
		$indexArray["avatar"] = $row11['avatar'];//用户头像
		$indexArray["nickname"] = $row11['nickname'];//用户昵称
	    $indexArray["dates"] = $rsanswer["dates"];//回复时间
	    $indexArray["floor"] = $floornumber;//楼层
	    $indexArray["contents"] = htmlspecialchars_decode($rsanswer["contents"]);//回复内容
	    $myArray["list"][] = $indexArray;
	}
	$myArray["answernum"] =$floornumber;//回复数量
	$myArray["resault"] = 'success';  
	// mysqli_close($con);
	// print_r($myArray); 
	$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
	echo $json;
?>