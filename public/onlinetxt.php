<?php include("../public/header.php");?>
<!DOCTYPE HTML>
<html>
<head>
  
</head>
<body>
  <main>
  <div style="margin-left: 10%;margin-right: 10%;margin-top: 1% ">
    <p style="font-size: 20px;color: blue;">
    <table class="table">
      <thead>
        <tr>
          <th>id</th>
          <th>uuid</th>
          <th>ip</th>
          <th>user</th>          
          <th>addtime</th>         
          <th>province</th>
          <th>city</th>
        </tr>
      </thead>
      <tbody>
      <?php
        include_once('conn.php');//连接数据库  
        //查询区域统计  
        $sql = "select * from online";  
        $result = mysqli_query($con,$sql);  
        while($row=mysqli_fetch_array($result)){   
            ?>
        <tr>
          <td><?php echo $row['id'];?></td>
          <td><?php echo $row['uuid'];?></td>
          <td><?php echo $row['ip'];?></td>
          <td><?php echo $row['user'];?></td>
          <td><?php date_default_timezone_set('PRC');  echo date('Y-m-d H:i:s',$row['addtime']);?></td>
          <td><?php echo $row['province'];?></td>
          <td><?php echo $row['city'];?></td>
        </tr>
      <?php
        }  
      ?> 
      </tbody>
      </table>
    </p> 
   </div>
 </main>
</body>
</html>
<?php include '../public/footer.php';?>