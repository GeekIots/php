<?php session_start();
	error_reporting(E_ALL^E_NOTICE); //取消警告显示
	include "conn.php";
	header('Content-type:text/json');
	$username=isset($_GET['username']) ? htmlspecialchars($_GET['username']) : '';;
	$password=isset($_GET['password']) ? htmlspecialchars($_GET['password']) : '';;

	if($username&&$password)
	{
		if (!$con)
		{
			// die('数据库连接失败: '.mysqli_error());
			$res='fail';
		}
		else
		{
			$res='success';

			//检查用户名
			$result = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");
			$row = mysqli_fetch_array($result);
			// var_dump($row);
			if ($row) {
				//用户名存在,检查密码
				$passwordmd5 = md5($password);

				$result = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' and password = '$passwordmd5'");
				$row = mysqli_fetch_array($result);
				if ($row) {
					//用户名密码正确，检查是否验证
					$result = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' and password = '$passwordmd5'");
					$row = mysqli_fetch_array($result);
					if ($row['active']=='1') {
						//已验证,登录成功
						$myArray["status"] = 'success';

						$myArray["username"] = $row['username'];
						$myArray["password"] = $password;
						$myArray["phonenumber"] = $row['phonenumber'];
						$myArray["email"] = $row['email'];
						$myArray["address"] = $row['address'];
						$myArray["qq"] = $row['qq'];


						 //用户头像
	                    $file = "../public/upload-head/userheadimg/".$row['username'].".jpg";
	                    if(file_exists($file))
	                    {
	                        //存在
	                        $avatar = "http://www.smtvoice.com/public/upload-head/userheadimg/".$row['username'].".jpg";;
	                    }
	                    else
	                    {
	                        //不存在
	                        $avatar = "http://www.smtvoice.com/public/upload-head/default.jpg";
	                    }
						$myArray["head"] = $avatar;

			            $_SESSION['login'] = $row['username'];
					}
					else
					{
						$myArray["status"] = 'fail';
						$myArray["error"] = '账号未激活！';
					}
				}
				else
				{
					$myArray["status"] = 'fail';
					$myArray["error"] = '密码不正确!';
				}
			}
			else
			{
				$myArray["status"] = 'fail';
				$myArray["error"] = '用户名不存在！';
			}
		}

	$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
	echo $json;
	}
?>

