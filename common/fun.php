<?php 
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    header('Content-type:application/json');
    $conn_root=$_SERVER['DOCUMENT_ROOT']."/api/conn.php";
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

    // 判断字段是否存在,存在true，不存在false
    // 表名：table
    // 字段名：field
    // 搜索内容：describ
    function find($table='',$field='',$describ='')
    {
        include_once($conn_root);
        $_field = mysqli_query($con,"{$describ} {$table} {$field}");  
        // $_field = mysqli_fetch_array($_field);  
        // if($_field[0]){ 
        //     print_r($_field) ;
        //   return true;
        // }else{  
        //   return false;
        // }  
    }



        
 ?>