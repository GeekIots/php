<?php
include "public/conn.php";
// function getpicture(){
    if (!$con)
    {
        die('数据库连接失败: '.mysqli_error());
    }
    else
    {
        $result = mysqli_query($con, "SELECT * FROM video WHERE id = 0 ");
        $row = mysqli_fetch_array($result);
        $result = 'data:image/jpeg;base64,'.$row['base64'];
    }
    mysqli_close($con);
    // $result = 'sadf';
    echo $result;
// }

?>