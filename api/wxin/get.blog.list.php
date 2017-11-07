<?php 
  error_reporting(E_ALL^E_NOTICE); //取消警告显示
  header('Content-type:application/json');
  include $_SERVER ['DOCUMENT_ROOT']."/api/conn.php";//http
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
        // 所有内容
        if($_GET['type']=='find')
        {
          $sql="select * from blog order by dates desc";
          $result=mysqli_query($con,$sql);
          $myArray["num"] = $result->num_rows;
          // var_dump($result);
          while ($row = mysqli_fetch_array($result)) {
            $indexArray["id"]=$row['id'];
            $indexArray["pic"]=$row['picture'];
            $indexArray["title"]=$row['title']; 
            $indexArray["userid"]=$row['nickname']; 
            $indexArray["dates"]=$row['dates']; 
            $indexArray["hits"]=$row['hits']; 
            $myArray["list"][]=$indexArray;
          }
        }
        else
        if($_GET['type']=='news')
        {
          // 置顶的内容
          $sql="select * from blog order by dates desc limit 5 ";
          $result=mysqli_query($con,$sql);
          $myArray["num"] = $result->num_rows;
          // var_dump($result);
          while ($row = mysqli_fetch_array($result)) {
            $indexArray["id"]=$row['id'];
            $indexArray["pic"]=$row['picture'];
            $indexArray["title"]=$row['title']; 
            $indexArray["dates"]=$row['dates']; 
            $indexArray["hits"]=$row['hits']; 
            $myArray["list"][]=$indexArray;
          }

        }
          $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
          echo $json;  
              }
    }
    mysqli_close($con);
?>