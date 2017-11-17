<?php  
	/*
	获取帖子列表
	参数：
		num：单页帖子数量 默认值：8
		page：当前页码    默认值：1
	*/
	date_default_timezone_set("Asia/Shanghai");
	error_reporting(E_ALL^E_NOTICE); //取消警告显示
	header('Content-type:application/json');
	include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";

	if(isset($_POST['num']))
	{
		//定义每页显示数量
		$InPageNumber = $_POST['num'];
	}
	else
		$InPageNumber = 8;

	if(isset($_POST['page']))
	{
		//当前页面号
		$NowPageNuber = $_POST['page'];
	}
	else
		$NowPageNuber = 1;

	//获取帖子总量
	$sqlselect="select count(*) from blog";
	$queryselect=mysqli_query($con,$sqlselect);
	$_tempnumber=mysqli_fetch_array($queryselect);
	$noteTotalNumber=$_tempnumber[0];

	//总页数
	$PageNumber = ceil($noteTotalNumber/$InPageNumber);//向上取整，有小数就加1 ceil(),向下取整：floor()

	// 如果当前页面号为小于0，默认为1
	$NowPageNuber = ($NowPageNuber>0) ? $NowPageNuber : 1 ;  
	// 如果当前页面号大于总页面数，设置为总页面数
	$NowPageNuber = ($NowPageNuber>$PageNumber) ? $PageNumber : $NowPageNuber ;

	// 获取选择的一段列表
	$startNum = ($NowPageNuber-1)*$InPageNumber;
	$sql="select * from blog order by dates desc limit {$startNum}, {$InPageNumber}";
	$query=mysqli_query($con,$sql); 

	$myArray["total"] = $noteTotalNumber;//贴子总数
	$myArray["page"] = $NowPageNuber;//当前页

	while($rs=mysqli_fetch_array($query))
	{
		//读取回复数量
		$sqlanswer="select count(*) from bloganswer where toid='".$rs['id']."'";
		$queryanswer=mysqli_query($con,$sqlanswer);
		$answernum=mysqli_fetch_array($queryanswer);
		// print_r($answernum);
		// 获取用户信息
		$sql11="select * from user where userid='{$rs['userid']}'";
		$query11=mysqli_query($con,$sql11);
		$row11 = mysqli_fetch_array($query11);


		$indexArray["id"]=$rs['id'];//帖子id
		$indexArray["avatar"]=$row11['avatar'];//用户头像
		$indexArray["title"]=$rs['title'];//帖子标题
		$indexArray["nickname"]=$row11['nickname'];//发帖人昵称
		$indexArray["userid"]=$row11['userid'];//发帖人昵称
		$indexArray["dates"]=$rs['dates'];//发布时间
		$indexArray["answer"] = $answernum[0];//回复数
		$indexArray["browser"] = $rs['hits'];//浏览量
		$indexArray["classify"] = $rs['classify'];//分类

		$myArray["list"][] = $indexArray;
	}
	$myArray["resault"] = 'success';  
	// mysqli_close($con);
	// print_r($myArray); 
	$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
	echo $json;
?>