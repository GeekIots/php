<?php  
/**
 * 获取地理位置
 * 淘宝IP接口
 * @Return: array
 */
function getCity($ip = '')
{         
    if($ip == ''){
        $url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json";
        $ip=json_decode(file_get_contents($url),true);
        $data = $ip;
    }else{
        $url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
        $ip=json_decode(file_get_contents($url));   
        if((string)$ip->code=='1'){
           return false;
        }
        $data = (array)$ip->data;
    }
    
    return $data;   
}

// var_dump(getCity());
// $city=getCity();

// echo $city['country'];
// echo $city['province'];
// echo $city['city'];



 /********************
 1、写入内容到文件,追加内容到文件
 2、打开并读取文件内容
 ********************/
  // $file  = 'log.txt';//要写入文件的文件名（可以是任意文件名），如果文件不存在，将会创建一个
  // $content = "第一次写入的内容<br>";
  
  // if($f  = file_put_contents($file, $content,FILE_APPEND)){// 这个函数支持版本(PHP 5) 
  //  echo "写入成功。<br />";
  // }
  // $content = "第二次写入的内容<br>";
  // if($f  = file_put_contents($file, $content,FILE_APPEND)){// 这个函数支持版本(PHP 5)
  //     echo "写入成功。<br />";
  // }
  // if($data = file_get_contents($file)){; // 这个函数支持版本(PHP 4 >= 4.3.0, PHP 5) 
  //  echo "写入文件的内容是：$data";
  // }
