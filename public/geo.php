<?php
include_once('conn.php');//连接数据库  
//查询区域统计  
$sql = "select province,count(*) as total from online group by province order by total desc";  
$result = mysqli_query($con,$sql);  
while($row=mysqli_fetch_array($result)){  
  $list[] = array(  
    'province' => $row['province'],  
    'total' => $row['total']  
  );   
}  
echo json_encode($list);//以json格式输出
?>