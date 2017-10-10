<?php session_start();
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    header('Content-type:application/json;');
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";

    /*
        发布回复到服务器
        #### 需要传递的参数
        |    参数名 |    关键字    |    重要性    |
        | --------  |    :----:    |    :----:    |
        |    内容   |    contents  |     必须     |
        |   原帖id  |    toid      |     必须     |
        |   用户id  |    userid    |     必须     |
        ```
        {
            "status": "success"
        }
        ```
        ```
        {
            "status": "fail",
            "msg": "错误信息！"
        }
        ```
    */

    //获取编辑器内容
    $contents = $_POST['contents'];

    // 获取用户id
    $userid = $_POST['userid'];

    // 获取原帖id
    $toid = $_POST['toid'];
	
	$myArray["resault"] = 'fail';
	// 参数判断
    if (!empty($userid)) {
    	// 判断用户是否存在
        $sql = "select userid from user where userid = '$userid'"; //SQL语句
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
				$sql_insert="insert into bloganswer (id,dates,contents,userid,toid) values (null,now(),'$contents','$userid','$toid')";
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
    	$myArray["msg"] = '缺少昵称:userid！';
    }
 	mysqli_close($con);
    // print_r($myArray); 
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>