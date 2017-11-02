 
<?php 
	// header("Content-type: text/html; charset=utf-8");
	// 唯一id生成
	// echo time();
	// // echo microtime();
	// // echo md5(uniqid());
	// echo('</br>');
	// echo uniqid();
	// 毫秒级时间戳
	function uuid() {
	list($t1, $t2) = explode(' ', microtime());
	return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
	}
	echo uuid();
?>
