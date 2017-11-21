<?php
    include $_SERVER['DOCUMENT_ROOT']."/common/fun.php";
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    header('Content-type:application/json');
    //上传图片API，支持get，post
    /*
    上传头像：
      type：avatar
      userid：用户id
      size：图像大小,单位kb
    上传帖子图片：
      type：blog
      userid：用户id
      blogid：帖子id
      size：图像大小,单位kb
    上传回帖图片：
      type：answer
      userid：用户id
      blogid：帖子id
      size：图像大小,单位kb
    上传系统默认图片：
      type：default
      name：图片名称
      size：图像大小,单位kb
    上传传感器图片：
      type：sensor
      userid：用户id
      sensorid：传感器id
      size：图像大小,单位kb
    上传开关图片：
      type：switch
      userid：用户id
      switchid：开关id
      size：图像大小,单位kb
    */
    //获取type
    $type = get_post_para('type',true);

    //获取userid
    if ($type!='default') {
        $userid = get_post_para('userid',true);
        // 判断userid是否存在
        check_userid($userid,$con);     
    }

    //获取blogid
    if (($type=='blog')||($type=='answer')) {
        //获取blogid,获取时不需要blogid
        $blogid = get_post_para('blogid',true);
    }

    //获取sensorid
    if ($type=='sensor') {
        $sensorid = get_post_para('sensorid',true);
    }

    //获取switchid
    if ($type=='switch') {
        $switchid = get_post_para('switchid',true);
    }

    //获取size
    $size = get_post_para('size',false);
///////////////////上传图片具体操作//////////////////////////////
   
    $file_name = $_FILES['file']['name'];
    $file_type = $_FILES["file"]["type"];
    $file_tmp = $_FILES["file"]["tmp_name"];
    $file_error = $_FILES["file"]["error"];
    $file_size = $_FILES["file"]["size"];
    $file_name_arr = explode('.', $file_name);
    
    // 出错
    if ($file_error > 0) { 
        $myArray['code'] = 1;
        $myArray['msg'] = $file_error;
        exit(json_encode($myArray,JSON_UNESCAPED_UNICODE));
    }
    // 文件太大了
    if ($size) {
        if ($file_size > ($size*1024)) { 
            $myArray['code'] = 1;
            $myArray['msg'] = "上传文件不能大于".$size."KB";
            exit(json_encode($myArray,JSON_UNESCAPED_UNICODE));
        }
    }
    else{
        if ($file_size > (500*1024)) {
            $myArray['code'] = 1;
            $myArray['msg'] = "上传文件不能大于500KB";
            exit(json_encode($myArray,JSON_UNESCAPED_UNICODE));
        }
    }
    
    // 如果没有文件夹则创建
    if (!file_exists('../../image')){ 
        mkdir('../../image');
    }
    // 如果没有文件夹则创建
    if (!file_exists('../../image/avatar')){ 
        mkdir('../../image/avatar');
    }
    // 如果没有文件夹则创建
    if (!file_exists('../../image/blog')){ 
        mkdir('../../image/blog');
    }
    // 如果没有文件夹则创建
    if (!file_exists('../../image/default')){ 
        mkdir('../../image/default');
    }

    // 如果没有文件夹则创建
    if (!file_exists('../../image/sensor')){ 
        mkdir('../../image/sensor');
    }

    // 如果没有文件夹则创建
    if (!file_exists('../../image/switch')){ 
        mkdir('../../image/switch');
    }

    //上传头像
    if ($type=='avatar') {
        $file_path = '../../image/avatar';
        $new_file_name = "$userid.{$file_name_arr[1]}";
        $myArray['root']= "http://www.geek-iot.com/image/avatar/{$new_file_name}";
    }
    else
    //上传帖子图片
    if ($type=='blog') {
        $uuid = uuid();
        $file_path = "../../image/blog/{$blogid}/blog";
        $new_file_name = "{$uuid}.{$file_name_arr[1]}";//uuid：毫米时间戳
        // 如果没有文件夹则创建
        if (!file_exists("../../image/blog/{$blogid}")){ 
            mkdir("../../image/blog/{$blogid}");
        }
    }
    else
    //上传回帖图片
    if ($type=='answer') {
        $uuid = uuid();
        $file_path = "../../image/blog/{$blogid}/answer";
        $new_file_name = "{$uuid}.{$file_name_arr[1]}";//uuid：毫米时间戳
        // 如果没有文件夹则创建
        if (!file_exists("../../image/blog/{$blogid}")){ 
            mkdir("../../image/blog/{$blogid}");
        }
    }    
    //上传系统默认图片
    else
    if ($type=='default') {
        $file_path = '../../image/default';
        $new_file_name = "$name.{$file_name_arr[1]}";
    }
    //上传传感器认图片
    else
    if ($type=='sensor') {
        $file_path = "../../image/sensor/{$userid}";
        $new_file_name = "$sensorid.{$file_name_arr[1]}";
    }
    //上传开关认图片
    else
    if ($type=='switch') {
        $file_path = "../../image/switch/{$userid}";
        $new_file_name = "$switchid.{$file_name_arr[1]}";
    }
    else
    {
        $myArray["msg"] = "不支持类型：{$type}!"; //list列表元素个数 
        $myArray["resault"] = 'false';
        exit(json_encode($myArray,JSON_UNESCAPED_UNICODE));
    }

    // 如果没有文件夹则创建
    if (!file_exists($file_path)){ 
        mkdir($file_path);
    }

    $file_path = "$file_path/$new_file_name";
    // 此函数只支持 HTTP POST 上传的文件
    $upload_result = move_uploaded_file($file_tmp, $file_path); 
    if ($upload_result) {
        $myArray['code'] = 0;
        $myArray['msg'] = $file_path;
        $myArray['data']['src'] = $file_path;
        $myArray['data']['title'] = $new_file_name;
        exit(json_encode($myArray,JSON_UNESCAPED_UNICODE));
    } else {
        $myArray['code'] = 1;
        $myArray['msg'] = "文件上传失败，请稍后再尝试";
        exit(json_encode($myArray,JSON_UNESCAPED_UNICODE));
    }
?>

