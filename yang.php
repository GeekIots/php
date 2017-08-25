<?php
$url ='https://www.sojson.com/open/api/weather/json.shtml?city=%E8%A5%BF%E5%AE%89%E5%B8%82';
	$ch = curl_init();
	
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_HEADER,1);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
	
	
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

	
	$output = curl_exec($ch);
	curl_close($ch);
	echo $output;	

?>
