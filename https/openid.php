<?php 
	$appid = 'wx51dc296dee8fc4ab';
	$appsecret = 'e8dd72b21e6dd0a77359c5b2367305b3';
	$loginCode = isset($_GET['loginCode']) ? htmlspecialchars($_GET['loginCode']) : '';
	$url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'&secret='.$appsecret.'&grant_type=authorization_code&js_code='.$loginCode;
    $result = file_get_contents($url);
    echo $result;
?>

