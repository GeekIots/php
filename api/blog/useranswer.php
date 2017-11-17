<?php  
	/*
	某个用户的回复列表
	参数：
		userid：用户id  必须字段
	*/
	date_default_timezone_set("Asia/Shanghai");
	error_reporting(E_ALL^E_NOTICE); //取消警告显示
	header('Content-type:application/json');
	include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";

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
	//获取当前用户所有回复的帖子
	$sql="select * from bloganswer where userid = '{$userid}' order by dates desc limit 10";
	$query=mysqli_query($con,$sql); 
	$num=0;
	while($rs=mysqli_fetch_array($query))
	{
		//获取原帖标题
		$sqlanswer="select title from blog where id='{$rs['toid']}'";
		$queryanswer=mysqli_query($con,$sqlanswer);
		$answer=mysqli_fetch_array($queryanswer);
		// print_r($answernum);

		$indexArray["title"]=$answer['title'];//原帖标题
		$indexArray["id"]=$rs['toid'];//原帖id
		$indexArray["dates"]=$rs['dates'];//回复时间
		$indexArray["contents"] = htmlspecialchars_decode($rs["contents"]);//回复内容

		$myArray["list"][] = $indexArray;
		$num++;
	}

	$myArray["length"] = $num; //list列表元素个数 
	$myArray["resault"] = 'success';  
	// mysqli_close($con);
	// print_r($myArray); 
	$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
	echo $json;
?>