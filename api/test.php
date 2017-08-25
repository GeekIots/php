<?php  
header('Content-type:application/json');     //这句是重点，它告诉接收数据的对象此页面输出的是json数据；  
$json='{"n":"name1","p":"pass2"}'; 
echo $json;  
?>