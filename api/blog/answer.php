<?php session_start();
error_reporting(E_ALL^E_NOTICE); //取消警告显示
header('Content-type:application/json;');
include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
?>
<?php
    //获取编辑器内容
    $contents = $_POST['contents'];

    // 获取昵称
    $nickname = $_POST['nickname'];

    // 获取原帖id
    $toid = $_POST['toid'];
	
	$myArray["resault"] = 'fail';
	// 参数判断
    if (!empty($nickname)) {
    	// 判断昵称是否存在
        $sql = "select nickname from user where nickname = '$nickname'"; //SQL语句
        $result = mysqli_query($con,$sql);//执行SQL语句
        if (mysqli_num_rows($result)) {
		    
		    if (empty($contents)) {
		    	$myArray["msg"] = '缺少内容字段:contents！';
		    } 
		    else
		    if (empty($toid)) {
		    	$myArray["msg"] = '缺少原帖id字段:toid';
		    }  
		    else{
		    	// 验证通过，存储新帖
				$sql_insert="insert into bloganswer (id,dates,contents,nickname,toid) values (null,now(),'$contents','$nickname','$toid')";
				if (!mysqli_query($con, $sql_insert))
                {
                    // die('Error: ' . mysqli_error($con));
                    $myArray["msg"]=mysqli_error($con);
                    $myArray["resault"] = 'fail';
                }
                else
                {
                    $myArray["resault"] = 'success';
                }
		    } 		
    	}
    	else{
    		// 昵称不存在
    		$myArray["msg"] = '昵称不存在，请确认后再试！';
    	}
    }
    else{
    	$myArray["msg"] = '缺少昵称:nickname！';
    }
 	mysqli_close($con);
    // print_r($myArray); 
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>