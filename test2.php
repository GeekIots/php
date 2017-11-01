<?php 
	// 唯一id生成
	echo md5(time().mt_rand());
?>

<?php
    // 设置session
    session_start();
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    header('Content-type:application/json');
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    require_once('/api/email.class.php'); 
    date_default_timezone_set("Asia/Shanghai");
    //初始化发送邮件类
    $smtp = new smtp('','','',true,'');
    $smtp->mail("15339287330@126.com", "群发", "测试");

?>  