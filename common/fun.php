<?php 
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    header('Content-type:application/json');
    /** 
        * 配置文件操作(查询了与修改) 
        * 默认没有第三个参数时，按照字符串读取 
        * 如果有第三个参数,并且为int时按照int处理。 
        *调用demo 
            ----config.php-----
            $name="admin";
            $bb='234';
            -------------------
            $bb=getconfig("./config.php", "bb", "string"); 
            updateconfig("./config.php", "name", "admin"); 
    */ 
    // 读取配置
    function get_config($file, $ini, $type="string"){ 
        if(!file_exists($file)) return false; 
        $str = file_get_contents($file); 
            if ($type=="int"){ 
            $config = preg_match("/".preg_quote($ini)."=(.*);/", $str, $res); 
            return $res[1]; 
        } 
        else{ 
            $config = preg_match("/".preg_quote($ini)."=\"(.*)\";/", $str, $res); 
            if($res[1]==null){ 
                $config = preg_match("/".preg_quote($ini)."='(.*)';/", $str, $res); 
            } 
            return $res[1]; 
        } 
    } 

    // 更新配置
    function update_config($file, $ini, $value,$type="string"){ 
        if(!file_exists($file)) return false; 
        $str = file_get_contents($file); 
        $str2=""; 
        if($type=="int"){ 
            $str2 = preg_replace("/".preg_quote($ini)."=(.*);/", $ini."=".$value.";",$str); 
        } 
        else{ 
            $str2 = preg_replace("/".preg_quote($ini)."=(.*);/",$ini."=\"".$value."\";",$str); 
        } 
        file_put_contents($file, $str2); 
    } 

    // 参数获取函数，如果must默认是false，如果设置为ture，则必须传递参数
    function get_post_para($value='',$must=false)
    {
        $val='';
        if (isset($_GET[$value])) {
            $val = $_GET[$value];
        } 
        else if (isset($_POST[$value])){
            $val = $_POST[$value];
        }
        else if ($must==true) {
            // 参数不存在
            $myArray["msg"] = "缺少字段:{$value}";
            $myArray["resault"] = 'fail';
            $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
            echo $json;
            exit();
        }
        return $val;
    }

    // 判断字段是否存在,存在返回用户信息，不存在返回错误信息并退出
    // 搜索内容：describ
    function find($describ='',$con)
    {
        $sql_select = "select * from user where userid = '{$describ}'"; //SQL语句
        $result = mysqli_query($con,$sql_select);//执行SQL语句
        $row = mysqli_fetch_array($result);
        // mysqli_close($con);
        if ($row) {
            return $row;
        }
        else
        {
            // 字段内容不存在
            $myArray["msg"] = "{$field}:'{$describ}'不存在!:";
            $myArray["resault"] = 'fail';
            $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
            echo $json;
            exit();
        }
    }

    // 判断密码是否正确
    function psd_verify($userid='',$psd='',$con)
    {
        $psw = md5($psd);
        $sql_select = "select password from user where userid = '{$userid}'"; //SQL语句
        $result = mysqli_query($con,$sql_select);//执行SQL语句
        $row=mysqli_fetch_array($result);
        // print_r($row);
        if ($row['password'] == $psw) {
            return true;
        }
        else
        {
            // 字段内容不存在
            $myArray["msg"] = "密码不正确!";
            $myArray["resault"] = 'fail';
            $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
            echo $json;
            exit(); 
        }
    }  
 ?>