<?php
    /**
     * layui + php 上传
     * 
     * 上传文件操作。
     * time:2017-03-20
     */
    date_default_timezone_set("Asia/Shanghai");
    $return = array();
    // 获取type
    if (isset($_GET['type']))
    {
        $type = $_GET['type'];
    }
    else
    {
        $return['code'] = 1;
        $return['msg'] = "缺少type";
        $return['time'] = 3000;
        exit(json_encode($return));
    }
    // 获取url
    if (isset($_GET['url']))
    {
        $url = $_GET['url'];
    }
    else
    {
        $return['code'] = 1;
        $return['msg'] = "缺少url！";
        $return['time'] = 3000;
        exit(json_encode($return));
    }
    // 获取size
    if (isset($_GET['size']))
    {
        $size = $_GET['size'];
    }

    // 上传图片
    if ($type == 'image') {
    //上传图片具体操作
    $file_name = $_FILES['file']['name'];
    $file_type = $_FILES["file"]["type"];
    $file_tmp = $_FILES["file"]["tmp_name"];
    $file_error = $_FILES["file"]["error"];
    $file_size = $_FILES["file"]["size"];

    if ($file_error > 0) { // 出错
        $return['code'] = 1;
        $return['msg'] = $file_error;
        $return['time'] = 3000;
        exit(json_encode($return));
    }
    if (isset($_GET['size'])) {
        if ($file_size > ($size*1024)) { 
            // 文件太大了
            $return['code'] = 1;
            $return['msg'] = "上传文件不能大于".$size."KB";
            $return['time'] = 3000;
            exit(json_encode($return));
        }
    }
    else{
        if ($file_size > (1024*1024)) { // 文件太大了
            $return['code'] = 1;
            $return['msg'] = "上传文件不能大于1MB";
            $return['time'] = 3000;
            exit(json_encode($return));
        }
    }
    if (!isset($url)) {
            //没有指定应用类型
            $return['code'] = 1;
            $return['msg'] = "缺少url！";
            $return['time'] = 3000;
            exit(json_encode($return));
        }
    }

    $file_name_arr = explode('.', $file_name);
    $new_file_name = date('YmdHis') . '.' . $file_name_arr[1];
    $path_head = "../../image/";
    $path_dst = "{$url}/".date('Ymd');
    // 如果没有文件夹则创建--image
    if (!file_exists($path_head)){ 
        mkdir($path_head);
    }
    if (!file_exists($path_head."{$url}")){ 
        mkdir($path_head."{$url}");
    }
    if (!file_exists($path_head.$path_dst)){ 
        mkdir($path_head.$path_dst);
    } 

    $file_path = $path_head.$path_dst."/".$new_file_name;
    if (file_exists($file_path)) {
        $return['code'] = 1;
        $return['msg'] = "此文件已经存在啦";
        $return['time'] = 3000;
        exit(json_encode($return));
    } else {
        // 此函数只支持 HTTP POST 上传的文件
        $upload_result = move_uploaded_file($file_tmp, $file_path); 
        if ($upload_result) {
            $return['code'] = 0;
            $return['msg'] = $file_path;
            $return['root']= 'image/'.$path_dst."/".$new_file_name;
            $return['time'] = 1000;
            $return['data']['src'] = $file_path;
            $return['data']['title'] = $new_file_name;
            exit(json_encode($return));
        } else {
            $return['code'] = 1;
            $return['msg'] = "文件上传失败，请稍后再尝试";
            $return['time'] = 3000;
            exit(json_encode($return));
        }
    }

