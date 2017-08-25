<?php 
  error_reporting(E_ALL^E_NOTICE); //取消警告显示
  header('Content-type:application/json');
  include "conn.php";//http
?>
<?php
  if (!$con)
   {
      $myArray["status"]='fail';
      $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
      echo $json;
   }
   else
   {
    if($_GET['type']=='set'&&(!empty($_GET['content']))&&(!empty($_GET['id'])))
    { 
      $result = mysqli_query($con, "UPDATE info set content = '{$_GET['content']}' where id='{$_GET['id']}'");
      if ($result) {
        $myArray["status"] = 'success';  
      }
      else
      {
        $myArray["status"] = 'error';
        $myArray["msg"] = '网络错误！';    
      }
      // var_dump($result);
      $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
      echo $json;
    }
    else
    {
      $myArray["status"] = 'success';  
      $result = mysqli_query($con, "SELECT * FROM info where name = '{$_GET['type']}'");
      $myArray["num"] = $result->num_rows;
      // var_dump($result);
      while ($row = mysqli_fetch_array($result)) {
        $indexArray["id"]=$row['id'];
        $indexArray["content"]=htmlspecialchars_decode($row['content']); 
        $myArray["list"][]=$indexArray;
      }
      $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
      echo $json;
    }
  }
    mysqli_close($con);
?>