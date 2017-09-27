<?php  
	/*
	某个用户的发帖列表
	参数：
		nickname：昵称  必须字段
	*/
	date_default_timezone_set("Asia/Shanghai");
	error_reporting(E_ALL^E_NOTICE); //取消警告显示
	header('Content-type:application/json');
	include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";

	if(isset($_POST['nickname']))
	{
		//定义每页显示数量
		$nickname = $_POST['nickname'];
	}
	else
	{
		$myArray["resault"] = 'fail';  
		$myArray["msg"] = '缺少nickname字段！';
		$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
		echo $json;
		exit();
	}
	$sql="select * from blog where nickname='$nickname' order by dates desc";
	$query=mysqli_query($con,$sql); 
	while($rs=mysqli_fetch_array($query))
	{
		//读取回复数量
		$sqlanswer="select count(*) from bloganswer where toid='".$rs['id']."'";
		$queryanswer=mysqli_query($con,$sqlanswer);
		$answernum=mysqli_fetch_array($queryanswer);
		// print_r($answernum);

		$indexArray["id"]=$rs['id'];//帖子id
		$indexArray["title"]=$rs['title'];//帖子标题
		$indexArray["dates"]=$rs['dates'];//发布时间
		$indexArray["answer"] = $answernum[0];//回复数
		$indexArray["browser"] = $rs['hits'];//浏览量

		$myArray["list"][] = $indexArray;
	}
	$myArray["resault"] = 'success';  
	mysqli_close($con);
	// print_r($myArray); 
	$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
	echo $json;
?>