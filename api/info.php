<?php 
  error_reporting(E_ALL^E_NOTICE); //取消警告显示
  header('Content-type:text/json');
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
    if(!empty($_GET['type']))
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