<?php
include "../../public/header.php";
//phpinfo();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>更新头像</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<script type="text/javascript" src="js/cropbox.js"></script>
<main>
	<div class="container">
	  <div id="images" class="imageBox">
	    <div class="thumbBox"></div>
	    <div class="spinner" style="display: none">Loading...</div>
	  </div>
	  <div class="action"> 
	    <!-- <input type="file" id="file" style=" width: 200px">-->
	    <div class="new-contentarea tc"> <a href="javascript:void(0)" class="upload-img">
	      <label for="upload-file">选择</label>
	      </a>
	      <input type="file" class="" name="upload-file" id="upload-file" />
	    </div>
	    <input type="button" id="btnupload"   class="Btnsty_peyton" value="上传">
	    <input type="button" id="btnZoomIn" class="Btnsty_peyton" value="+"  >
	    <input type="button" id="btnZoomOut" class="Btnsty_peyton" value="-" >
	  </div>
	  <!-- 右边预览图 -->
	  <div class="cropped"></div>
	</div>	
</main>

<script type="text/javascript">

document.getElementById('images').onmousewheel = function(event) { 
if (!event) event = window.event; 
this.scrollTop = this.scrollTop - (event.wheelDelta ? event.wheelDelta : -event.detail * 10); 
return false; 
}
var cropper;
$(window).load(function() {
	console.log('2');
	var options =
	{
		thumbBox: '.thumbBox',
		spinner: '.spinner',
		imgSrc: 'default.jpg'
	}
	cropper = $('.imageBox').cropbox(options);
	$('#upload-file').on('change', function(){
		var reader = new FileReader();
		reader.onload = function(e) {
			options.imgSrc = e.target.result;
			cropper = $('.imageBox').cropbox(options);
		}
		reader.readAsDataURL(this.files[0]);
		// this.files = [];
	})
	 // 更新预览
    var img = cropper.getDataURL();
    $('.cropped').html('');
    $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:64px;margin-top:4px;border-radius:64px;box-shadow:0px 0px 12px #7E7E7E;" ><p>64px*64px</p>');
    $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:128px;margin-top:4px;border-radius:128px;box-shadow:0px 0px 12px #7E7E7E;"><p>128px*128px</p>');
    $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:180px;margin-top:4px;border-radius:180px;box-shadow:0px 0px 12px #7E7E7E;"><p>180px*180px</p>');
	// 缩小图像
	$('#btnZoomIn').on('click', function(){
		cropper.zoomIn();
		console.log('btnZoomIn');
	})
	// 放大图像
	$('#btnZoomOut').on('click', function(){
		cropper.zoomOut();
		console.log('btnZoomOut');
	})
});


  function getBlobBydataURI(dataURI,type) 
	 {   
	 	console.log(dataURI);
	    var binary = atob(dataURI.split(',')[1]);  
	    var array = [];  
	    for(var i = 0; i < binary.length; i++) {   
	        array.push(binary.charCodeAt(i));      
	    }       
	    return new Blob([new Uint8Array(array)], {type:type });   
	}  


	$('#btnupload').on('click', function(){
		upload();
	})

	/***上传*/  
	function upload(){        //base64 转 blob       
	  var $Blob= getBlobBydataURI(document.getElementsByTagName("img")[1].currentSrc,'image/jpeg');
	  var formData = new FormData();
	  	  formData.append("files", $Blob ,"file_"+Date.parse(new Date())+".jpeg");//组建XMLHttpRequest 上传文件       
	  var request = new XMLHttpRequest();//上传连接地址        
	  request.open("POST", "uploadhead.php");
	  request.onreadystatechange=function(res){
	  	if (request.readyState==4){
	  		if(request.status==200){
	  		var obj = JSON.parse(res.currentTarget.response);  
			console.log(obj.resault);
  			console.log("上传成功");
  			if (obj.resault=='ok') {
  				alert('上传成功！')
  				//返回上一页并刷新
  				self.location=document.referrer;
  			}else
  				alert(obj.resault);}
  			else{        
  				console.log("上传失败,检查上传地址是否正确");           
  			}          
	  	}        
	  }           
	 	request.send(formData);      
	 }  
</script>

</body>
</html>
