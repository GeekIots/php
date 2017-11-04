<?php 
	error_reporting(E_ALL^E_NOTICE); //取消警告显示
	// https://smtvoice.com/scancode.php?type=set&text=resault&note=note&nick=nickName
	include "conn.php";
	date_default_timezone_set("Asia/Shanghai");
	header('Content-type:application/json');
	$type=$_GET['type'];
	$text=$_GET['text'];
	$note=$_GET['note'];
	$nick=$_GET['nick'];

	$time=date("Y").':'.date("m").':'.date("d").' '.date("H").':'.date("i");
	if (!empty($type)) 
	{
		if (!$con)
		{
			// die('数据库连接失败: '.mysqli_error());
			$myArray["status"] = 'fail';
			$myArray["error"] = '数据库连接失败';	
		}
		else
		{

			if($type=='getnum')
			{
				//获取记录数量
				$result = mysqli_query($con, "SELECT COUNT(*) AS count FROM scancode");
				$row = mysqli_fetch_array($result);
				$count=$row['count']; 
				// var_dump($row);
				if ($row) {
					$myArray["status"] = 'ok';
					$myArray["count"]=$row['count'];
				}
				else
				{
					$myArray["status"] = 'fail';
					$myArray["error"] = '数据不存在';
				}
			}
			else
			if($type=='get')
			{
				//查看是否有数据
				$result = mysqli_query($con, "SELECT * FROM scancode WHERE text = '$text'");
				$row = mysqli_fetch_array($result);
				// var_dump($row);
				if ($row) {
					$myArray["status"] = 'ok';
					$myArray["text"]=$row['text'];
					$myArray["note"]=$row['note'];
					$myArray["nick"]=$row['nick'];
					$myArray["time"]=$row['timer'];
				}
				else
				{
					$myArray["status"] = 'fail';
					$myArray["error"] = '数据不存在';
				}
			}
			else
			if ($type=='set') 
			{
				//判断上传信息是否为空
				if ((!empty($note))&&(!empty($text))&&($note!='undefined')) {
					//搜索是否存在
					$result = mysqli_query($con, "SELECT * FROM scancode WHERE text = '$text'");
					$row = mysqli_fetch_array($result);
					if ($row) {
						//存在,更新数据
						$sql_updata = "UPDATE scancode set note='$note',nick='$nick',timer='$time' where text='$text'";
						// echo($sql_updata);
	    				$sql_updata = mysqli_query($con,$sql_updata);
	    				if ($sql_updata) 
					    {
					    	$myArray["status"] = 'ok';
					    	$myArray["message"] = '更新成功！';
					    } 
					    else
						{
							$myArray["status"] = 'fail';
							$myArray["error"] = '存储失败';
						}
					}
					else
					{
						//不存在，添加数据
						$sql_insert = "insert into scancode (text,note,timer) values('$text','$note','$time')";
						$res_insert = mysqli_query($con,$sql_insert);
						var_dump($res_insert);
					    if ($res_insert) 
					    {
					    	$myArray["status"] = 'ok';
					    	$myArray["message"] = '添加成功！';
					    } 
					    else
						{
							$myArray["status"] = 'fail';
							$myArray["error"] = '存储失败';
						}
					}	
				}
				else
				{
					$myArray["status"] = 'fail';
					$myArray["error"] = '备注信息不能为空！';
				}
			}

		}
		$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
		echo $json;	
	}
?>

