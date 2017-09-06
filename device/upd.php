<?php
/**
 * Created by PhpStorm.
 * User: sunyiming
 * Date: 2016/11/26
 * Time: 下午2:09
 */
//首先是获取到了数据
$type=$_POST['type'];
$userid=$_POST['userid'];
$deviceid=$_POST['deviceid'];
$state=$_POST['state'];
$senddata = '{"type":"'.$type.'","userid":"'.$userid.'","deviceid":"'.$deviceid.'","state":"'.$state.'"}';
$result = udpGet($senddata);
$result=mb_convert_encoding($result,"UTF-8","gb2312");
$arr = json_decode($result,true);
if($arr)
    echo $arr['state'];
else
    echo $result;
//echo  "type=".$type."&userid=".$userid."&deviceid=".$deviceid."&state=".$state
;

function udpGet($sendMsg = '', $ip = '120.27.45.38', $port = '2525'){

    $handle = stream_socket_client("udp://{$ip}:{$port}", $errno, $errstr);
    if( !$handle ){
    die("ERROR: {$errno} - {$errstr}\n");
    }
    fwrite($handle, $sendMsg."\n");
    $result = fread($handle, 1024);
    fclose($handle);
    return $result;
}


