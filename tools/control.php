<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" >
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.bootcss.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <title>遥控器</title>
</head>
<style type="text/css" media="screen">
 *{
 margin:0;
 }
 html {
    -webkit-user-select: none;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
}
.butt{
	width:100%;
	/*margin-left:15%;*/
}

.button1{
	display:block;
	margin: -16px 137px;
	padding: 12px 20px;

	text-align:center;
	font-size:20px;
}
.button2{
	margin: 40px 20px;
	padding: 12px 20px;
	font-size:20px;
}
.button3{
	margin: 10px 10px;
	padding: 12px 20px;
	text-align:center;
	font-size:20px;
}
.button4{
	margin: 40px 20px;
	padding: 12px 20px;
	text-align:center;
	font-size:20px;
}
.button5{
		display:block;
	margin: -16px 137px;
	padding: 12px 20px;
	text-align:center;
	font-size:20px;
}
.button6{
	display:flex;
	margin: -170px 393px;
	padding: 12px 20px;
	text-align:center;
	font-size:20px;
}

.button7{
	display:flex;
	margin: 116px 495px;
	padding: 12px 20px;
	text-align:center;
	font-size:20px;
}

.button8{
	display:flex;
	margin: -97px 393px;
	padding: 12px 20px;
	text-align:center;
	font-size:20px;
}

.button9{
	display:flex;
	margin: 44px 495px;
	padding: 12px 20px;
	text-align:center;
	font-size:20px;
}
h1{text-align:center} 
</style>  
<body onload="info();">
    <h1 style="margin-left: 0;margin-right: 0;">AGV控制</h1>
	<div class="butt">
		<label id="dis" type="text"></label>
        <label id="dis1" type="text"></label>	    
        <button type="button" class="btn btn-primary button1" id="id">前进</button>
		<button type="button" class="btn btn-primary button2" id="id1">左移</button>
        <button type="button" class="btn btn-primary button3" onmousedown="clickup()" >停止</button>
		<button type="button" class="btn btn-primary button4" onmousedown="click4()" onmouseup="clickup()">右移</button>
		<button type="button" class="btn btn-primary button5" onmousedown="click5()" onmouseup="clickup()">后退</button>

		<button type="button" class="btn btn-primary button6" id="id6">左转</button>
		<button type="button" class="btn btn-primary button7" id="id7">右转</button>
		<button type="button" class="btn btn-primary button8" onmousedown="click8()" id="id8">左旋</button>
		<button type="button" class="btn btn-primary button9" id="id9">右旋</button>
	
	</div>
        <!--<hr />
        <textarea value="kong" id="leng" onchange="dislength()" overflow-y:auto height="200"></textarea>
        <label id="dislength" type="text"></label>-->
</body>
</html>

<script>




var documentWidth = document.documentElement.clientWidth;//页面宽度
function info() {
	document.getElementById("dis").innerText = documentWidth;
document.getElementById("id8").onmousedown();
}
function click8() {
	alert("8");
}

var obj = document.getElementById('id');
obj.addEventListener('touchstart', function(event) {
//alert('sdf');
     // 如果这个元素的位置内只有一个手指的话
    if (event.targetTouches.length == 1) {
　　　　 event.preventDefault();// 阻止浏览器默认事件，重要 
        var touch = event.targetTouches[0];
        // 把元素放在手指所在的位置
        obj.style.left = touch.pageX-50 + 'px';
        obj.style.top = touch.pageY-50 + 'px';
		// document.getElementById("dis").innerText = obj.style.left;
		document.getElementById("dis").innerText = "按键1按下";
        }
}, false); 

obj.addEventListener('touchend', function(event) {
document.getElementById("dis").innerText = "按键1抬起";
}, false); 

var obj1 = document.getElementById('id1');
obj1.addEventListener('touchstart', function(event) {
//alert('sdf');
     // 如果这个元素的位置内只有一个手指的话
    if (event.targetTouches.length == 1) {
　　　　 event.preventDefault();// 阻止浏览器默认事件，重要 
        var touch = event.targetTouches[0];
        // 把元素放在手指所在的位置
        obj1.style.left = touch.pageX-50 + 'px';
        obj1.style.top = touch.pageY-50 + 'px';
		// document.getElementById("dis1").innerText = obj1.style.left;
		document.getElementById("dis1").innerText = "按键2按下";
        }
}, false); 
obj1.addEventListener('touchend', function(event) {
document.getElementById("dis1").innerText = "按键2抬起";
}, false); 
    window.onload=function(){
		document.addEventListener('touchmove', function (e) { e.preventDefault(); 
		}, false);
		}
		</script>