<?php
/**
* by www.phpddt.com
*/
header("content-type:text/html;charset=utf-8");
ini_set("magic_quotes_runtime",0);
require 'class.phpmailer.php';
date_default_timezone_set("Asia/Shanghai");
// $sendto:发送到
// $subject:标题
// $body:内容
function sendmail($sendto='15339287330@126.com',$subject='测试标题',$body='<h1>极客物联网邮件系统测试！</h1>')
{
	try {
		$mail = new PHPMailer(true); 
		$mail->SMTPSecure = "ssl";
		$mail->IsSMTP();
		$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
		$mail->SMTPAuth   = true;                  //开启认证
		$mail->Port       = 465;                    
		$mail->Host       = "smtp.126.com"; 
		$mail->Username   = "15339287330@126.com";    
		$mail->Password   = "sun574287254";            
		//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
		$mail->AddReplyTo("15339287330@126.com","geek-iot");//回复地址
		$mail->From       = "15339287330@126.com";
		$mail->FromName   = "www.geek-iot.com";

		$to = $sendto;
		$mail->AddAddress($to);
		$mail->Subject  = $subject;
		$mail->Body = $body;
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
		$mail->WordWrap   = 80; // 设置每行字符串的长度
		//$mail->AddAttachment("f:/test.png");  //可以添加附件
		$mail->IsHTML(true); 
		$mail->Send();
		// echo '邮件已发送';
	} catch (phpmailerException $e) {
		// echo "邮件发送失败：".$e->errorMessage();
	}
}

?>