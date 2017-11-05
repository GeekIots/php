<?php 
  error_reporting(E_ALL^E_NOTICE); //取消警告显示
  header('Content-type:application/json');
  include $_SERVER ['DOCUMENT_ROOT']."/api/conn.php";//http
  date_default_timezone_set("Asia/Shanghai");
?>
<?php

  //获取参数
  $type = $_GET['type'];
  $name = $_GET['name'];
  $id = $_GET['id'];
  $filed = $_GET['filed'];
  $content = $_POST['content'];
  if (!$con)
   {
      $myArray["status"]='fail';
      $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
      echo $json;
   }
   else
   {
      //设置信息 
      if ($type == 'set') {
        if (!empty($filed)&&!empty($id)) {
            $latest = date("Y-m-d H:i:s",time());
            $updatesql="UPDATE info set $filed='$content' ,latest = '$latest' where id='$id'";
            $result = mysqli_query($con,$updatesql);
            if ($result) {
              $myArray["status"] = 'success';  
            }
            else
            {
              $myArray["status"] = 'fail';
              $myArray["error"] = '存储错误！';   
              $myArray["msg"] = $updatesql; 
              $myArray['result'] = $result;
            }
            // var_dump($result);
            $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
            echo $json;
        }
        else
        {
          $myArray["status"] = 'fail';
          $myArray["error"] = 'filed和id不能为空';
        }
      }
      else//查询信息
      if ($type == 'get') {
        // 检查ID是否有效
        if (!empty($name)) {
            $myArray["status"] = 'success';  
            $result = mysqli_query($con, "SELECT * FROM info where name = '$name'");
            $myArray["num"] = $result->num_rows;
            // var_dump($result);
            while ($row = mysqli_fetch_array($result)) {
              $indexArray["id"]=$row['id'];
              $indexArray["name"]=$row['name'];
              $indexArray["des"]=$row['des'];
              $indexArray["content_md"]=htmlspecialchars_decode($row['content_md']); 
               $indexArray["content_html"]=htmlspecialchars_decode($row['content_html']); 
              $indexArray["datatime"]=$row['latest'];
              $myArray["list"][]=$indexArray;
            }
            $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
            echo $json;
        }
        else
        {
          $myArray["status"] = 'fail';
          $myArray["error"] = 'name不能为空';
        }
      }
  }
    mysqli_close($con);
?>