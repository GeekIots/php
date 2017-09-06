<?php
$con = mysqli_connect("127.0.0.1", "root", "root","web");
mysqli_query($con,"set character set 'utf8'");//读库 
mysqli_query($con,"set names 'utf8'");//写库
?>