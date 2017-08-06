<?php session_start();
error_reporting(E_ALL^E_NOTICE); //取消警告显示
?>
<?php
	include("conn.php");
	if(!empty($_POST['data']))
	{ 
		if($_SESSION['login'])
		{
			$userid=$_SESSION['login'];
			$con = $_POST['data'];
			$toid = $_POST['toid'];

			$sql="insert into bloganswer (id,dates,contents,userid,toid) values (null,now(),'$con','$userid','$toid')";
			$resault = mysql_query($sql);
			if($resault)
			{
				echo 'ok';
			}
			else
				echo "error";
		}
		exit();
	}
	else
		echo "数据为空";
?>