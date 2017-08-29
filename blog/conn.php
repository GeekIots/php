<?php
	@mysql_connect("127.0.0.1","root","root") or die("mysql连接失败！");
	@mysql_select_db("web")or die("数据库连接失败！");
	mysql_set_charset("utf8");
?>