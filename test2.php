 
<?php 
	// header("Content-type: text/html; charset=utf-8");
	// 唯一id生成
	// echo md5(time().mt_rand());
?>

<?php
    // // 设置session
    // session_start();
    // error_reporting(E_ALL^E_NOTICE); //取消警告显示
    // // header('Content-type:application/json');
    // include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    require_once('/api/email.class.php'); 
    // date_default_timezone_set("Asia/Shanghai");
    //初始化发送邮件类
    $smtp = new smtp('','','',true,'');
    $smtp->mail("15339287330@126.com", "群发", "<h1>just test!</h1>".date("YmdHis"));


	// require_once ('/api/email.class.php');
	// //##########################################
	// $smtpserver = "smtp.126.com";//SMTP服务器
	// $smtpserverport =25;//SMTP服务器端口
	// $smtpusermail = "15339287330@126.com";//SMTP服务器的用户邮箱
	// $smtpemailto = "15339287330@126.com";//发送给谁
	// $smtpuser = "15339287330@126.com";//SMTP服务器的用户帐号
	// $smtppass = "sun574287254";//SMTP服务器的用户密码
	// $mailsubject = "ijquery.cn 测试邮件系统";//邮件主题
	// $mailbody = "<h1> 这是一个测试程序 ijquery.cn </h1>";//邮件内容
	// $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	// ##########################################
	// $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	// $smtp->debug = true;//是否显示发送的调试信息
	// $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);

?>  

<script>
<a href="mailto:15339287330@126.com;15339287330@126.com?CC=15339287330@126.com&BCC=15339287330@126.com&Subject=Hello&Body=你好">给我发邮件</a>
</script>