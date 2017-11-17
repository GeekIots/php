<?php 
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    header('Content-type:application/json;');
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    /*
        编辑帖子
        #### 需要传递的参数
        |    参数名 |    关键字    |    重要性    |
        | --------  |    :----:    |    :----:    |
        |    内容   |    contents  |     必须     |
        |    分类   |    classify  |     必须     |
        |    ID号   |    id        |     必须     |
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
    $title = $_POST['title'];

    //获取编辑器内容
    $contents = $_POST['contents'];

    // 获取类型选择内容
    $classify = $_POST['classify']; 

    // 获取ID
    $id = $_POST['id'];
	
	$myArray["resault"] = 'fail';
	// 参数判断
    if (!empty($id)) {
	    if (empty($contents)) {
	    	$myArray["msg"] = '缺少内容字段:contents！';
	    }  
		else
	    if (empty($classify)) {
	    	$myArray["msg"] = '缺少类型字段:classify！';
	    }
	    else{
	    	// 验证通过，更新
			$sql_update="UPDATE blog set title='$title', contents='$contents',classify='$classify',dates=now() where id='$id'";
			if (!mysqli_query($con, $sql_update))
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
    	$myArray["msg"] = '缺少id字段！';
    }
 	// mysqli_close($con);
    // print_r($myArray); 
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>