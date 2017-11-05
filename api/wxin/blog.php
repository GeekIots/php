<?php 
  error_reporting(E_ALL^E_NOTICE); //取消警告显示
  header('Content-type:application/json');
  include $_SERVER ['DOCUMENT_ROOT']."/api/conn.php";//http
   if (!$con)
   {
    $myArray["status"]='fail';
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
  }
  else
  {
    if(!empty($_GET['id']))
    { 
      $sql="select * from blog where id='{$_GET['id']}'";
      $query=mysqli_query($con,$sql);
      $rs=mysqli_fetch_array($query);
      // var_dump($rs);
      $conten=htmlspecialchars_decode($rs['contents']); 
      $conten=str_replace("/ueditor","http://www.smtvoice.com/ueditor",$conten);

      $myArray["status"] = 'success';
      $myArray["content"] = $conten;
      $myArray["id"] = $rs['id'];
      $myArray["title"] = $rs['title'];
      $myArray["datetime"] = $rs['dates'];
      $myArray["hit"] = $rs['hits'];
      $myArray["userid"] = $rs['nickname'];
      $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);

      echo $json;

      //浏览量加一
      $sql="update blog set hits = hits+1 where id='{$_GET['id']}'";
      mysqli_query($con,$sql);
      mysqli_close($con);
    }
  }
  ?>