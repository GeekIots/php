<?php include("/public/header.php");include("/public/api.php");?>
<div class="div1">
<?php
	include("conn.php");
	if(!empty($_GET['del']))
	{ 
		$d = $_GET['del'];
		$con = $_POST['con'];
		$sql="delete from blog where id=$d ";
		mysql_query($sql);

		//写log文件
		$file  = '/log.txt';//要写入文件的文件名（可以是任意文件名），如果文件不存在，将会创建一个
		$city=getCity();//获取用户位置
		if($_SESSION['login'])
		{
			$user = $_SESSION['login'];
		}
		else
			$user = ''; 
		//获取当前时间			
		date_default_timezone_set('PRC'); 
		$time = date('Y-m-d H:i:s');	
  		$content = $time."&nbsp&nbsp第".$d."条记录被".$user."删除!&nbsp&nbsp用户位置:".$city['country']."&nbsp".$city['province']."&nbsp".$city['city'];
		file_put_contents($file, $content."<br>",FILE_APPEND);
		echo '删除成功！';
		echo "<script>location.href='index.php';</script>";
	}
?>
</div>