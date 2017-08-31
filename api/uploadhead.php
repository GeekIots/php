<?php
  function upload(){        
	$file = request()->file('file');  
    // 移动到框架应用根目录/public/uploads/ 目录下        
	$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');       
    $reubfo = array();  //定义一个返回的数组        
    if($info){            
    	$reubfo['info']= 1;           
    	$reubfo['savename'] = $info->getSaveName();        
     }else{            // 上传失败获取错误信息            
     	$reubfo['info']= 0;           
     	$reubfo['err'] = $file->getError();       
     }        
     return $reubfo; 
 }
 function index(){   
		echo('arg1');     
		$ret = array();  //返回的上传文件状态数组 
		if ($_FILES["file"]["error"] > 0)        
		{           
			$ret["message"] =  $_FILES["file"]["error"] ;            
			$ret["status"] = 0;           
			$ret["src"] = "";            
			return json($ret);          
		}
		else
		{               
			$pic =  upload();               
			if($pic['info']== 1){                   
				$url = '/'.$pic['savename'];               
			} 
			else {                   
				$ret["message"] = $this->error($pic['err']);                   
				$ret["status"] = 0;                 
			}                
			$ret["message"]= "图片上传成功！";                
			$ret["status"] = 1;                  
			$ret["src"] = $url;                
			return json($ret);        
		}     
      }     //图片上传代码     

 index();
// echo('arg1');
// $data = file_get_contents('php://input'); 
// print_r(urldecode($data));
// function console($value='')
// {
//     echo("<script>console.log('{$value}');</script>");
// }
// console('ceshi');
// console($_GET['name']);
// public function upload()
// {
	// UploadFile uf=getFile(parameterName:"file");
	// File file = uf.getFile();
	 // move_uploaded_file($_FILES["files"]["tmp_name"],'1212.jpg');
// }

// session_start();
// //是否登录
// // if ($_SESSION['login']) {
// 	$dstname='1.jpg';
// 	if(move_uploaded_file($_FILES["files"]["tmp_name"],'userheadimg/'.$dstname))
// 		$res='ok';
// 	else
// 		$res='fail';
// // }
// // else
// // {
// // 	$res='请先登录！';
// // }
//    echo json_encode(array('code'=>'0'));
?>