<?php
	//用来获取用户真实IP。
	function get_client_ip() {  
	  if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))  
	    $ip = getenv("HTTP_CLIENT_IP");  
	  else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"),  
	"unknown"))  
	    $ip = getenv("HTTP_X_FORWARDED_FOR");  
	  else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))  
	    $ip = getenv("REMOTE_ADDR");  
	  else if (isset ($_SERVER['REMOTE_ADDR']) &&  
	$_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))  
	    $ip = $_SERVER['REMOTE_ADDR'];  
	  else 
	    $ip = "unknown";  
	  return ($ip);  
	}
	//随机数
	function create_uuid($prefix = ""){    //可以指定前缀
	    $str = md5(uniqid(mt_rand(), true));   
	    $uuid  = substr($str,0,8) . '-';   
	    $uuid .= substr($str,8,4) . '-';   
	    $uuid .= substr($str,12,4) . '-';   
	    $uuid .= substr($str,16,4) . '-';   
	    $uuid .= substr($str,20,12);   
	    return $prefix.$uuid;
	}
	include_once($_SERVER ['DOCUMENT_ROOT'].'/public/conn.php'); //连接数据库  
	
	$timeout = 30;//过期时间,50秒

	$ip = get_client_ip(); //获取客户端IP  
	$time = time();  
	
	if(!$_COOKIE['geoData']){//如果不存在cookie 
	    $api = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=$ip";  
	    $json = file_get_contents($api);// 
	    $arr = json_decode($json,true);//解析json  
	    $province = $arr['province'];//获取省份 
	    $city = $arr['city'];//获取城市

	    if($_SESSION['login'])
		{
			$user = $_SESSION['login'];
		}
		else
			$user = '游客'; 
		$uuid=create_uuid();
	    setcookie('geoData',$uuid,$time+$timeout); //设置cookie，设置过期时间为10分钟  
		//将访客信息插入到数据表中  
		mysqli_query($con,"insert into online (ip,province,addtime,city,user,uuid) values ('$ip','$province','$time','$city','$user','$uuid')"); 
	}  
	else{//如果存在，则更新该用户访问时间 
	  $uuid = $_COOKIE['geoData'];
	  mysqli_query($con,"update online set addtime='$time' where uuid='$uuid'");  
	}  
	
	//删除已过期的记录  
	$outtime = $time-$timeout;  
	mysqli_query($con,"delete from online where addtime<".$outtime);  
	//统计总记录数，即在线用户数  
	list($totalOnline) = mysqli_fetch_array(mysqli_query($con,"select count(*) from online"));  
	$_SESSION['nowonline'] = $totalOnline;  
?>