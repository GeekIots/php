<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" >
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>8266测试</title>
</head>
<style type="text/css" media="screen">
 *{
 margin:0;
 }
 html {
    -webkit-user-select: none;
}
.butt{
	width:100%;
	<!-- //margin-left:5%; -->
	<!-- //margin-top:50px; -->
}
html {
  font: 12px/1.5 Tahoma,Helvetica,Arial,'宋体',sans-serif;
  -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
}
.btn {
  padding: 6px 12px; 
  margin-bottom: 0;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.5;
  text-align: center; 

  border: 3px solid transparent;
  border-radius: 5px;
  width: 90px;
  height: 45px;
}
.btn-primary {
  color:darkblue;
  /*background-color: gray;*/
  border-color: lightgray;
}
/*.yao{
	width:100%;
}*/
.button1{
	float:left;
	margin-top:30px;	
	margin-left:0px;	
	/*background-color: red;*/
}
.button2{
	float: left;
	margin-top:30px;
	margin-left:30px;
	/*background-color: red;*/
}
.button3{
	float:left;
	margin-top:100px; 
	margin-left:30px;
	/*background-color: red;*/
}
.button4{ 
	float:left;
	margin-top:100px;
	margin-left:20px;
	/*background-color: red;*/
}
.ziti1{
	float:left;
	margin-top:15px;
	margin-left:18px;
	/*background-color: red;*/
	width: 200px;
}
.ziti2{
	float:left; 
	margin-top:15px;
	margin-left:220px;
	/*background-color: red;*/
	width: 200px;
}
.clear{
	clear:both;
}
</style>  
<body >
	<div class="butt">
	    <p class="ziti1"> 
			前后<br/>
	 		<label id="touchx1" type="text" >TouchX:0</label>
			<label id="touchy1" type="text" >TouchY:0</label>	<br/>
			<label id="josize1" type="text" >josize:0</label>
			<label id="jisize1" type="text" >jisize:0</label><br/>
			<label id="centerX1" type="text" >centerX:0</label>
			<label id="centerY1" type="text" >centerY:0</label><br/>
			<label id="jx1" type="text" >jx:0</label>
			<label id="jy1" type="text" >jy:0</label><br/>
			<label id="touch_in1" type="text" >touchin:0</label>
			<label id="vas1" type="text" ></label>
			<label id="dir1" type="text" ></label><br/>
			<label id="distance" type="text">Distance:0</label>
		</p>
	    <p class="ziti2">
			左右<br/>
	 		<label id="touchx2" type="text" >TouchX:0</label>
			<label id="touchy2" type="text" >TouchY:0</label>	<br/>
			<label id="josize2" type="text" >josize:0</label>
			<label id="jisize2" type="text" >jisize:0</label><br/>
			<label id="centerX2" type="text" >centerX:0</label>
			<label id="centerY2" type="text" >centerY:0</label><br/>
			<label id="jx2" type="text" >jx:0</label>
			<label id="jy2" type="text" >jy:0</label><br/>
			<label id="touch_in2" type="text" >touchin:0</label>
			<label id="vas2" type="text" ></label>
			<label id="dir2" type="text" ></label><br/>
			<label id="angle" type="text">Angle:0</label>
		</p>		
	</div>
	<div class="clear">
	</div>
	<canvas class="button1" id="joystick" height="190" width="190"></canvas>	
	<button class="button3 btn btn-primary" type="button" onclick="distanceClick()">Distance</button>
	<button class="button4 btn btn-primary" type="button" onclick="angleClick()">Angle</button>
	<canvas class="button2" id="joystick2" height="190" width="190"></canvas>		
</body>
</html>

<script>
	var dis = document.getElementById('distance');
	var angle = document.getElementById('angle');
	function distanceClick()
	{
		dis.innerText='Distance:10';
		angle.innerText = 'Angle:0';
		var postData = '{distance}';
		
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "http://192.168.4.1", true);
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xhr.onreadystatechange = function(){
			var XMLHttpReq = xhr;
			if (XMLHttpReq.readyState == 4) {
				if (XMLHttpReq.status == 200) {
					var str = XMLHttpReq.responseText;
					var jsonResult = JSON.parse(str);
                    document.getElementById("dis").innerText = "名称：" + jsonResult.name + "  编号：" + jsonResult.id;
				}
			}
		};
		xhr.send(postData);
	}
	function angleClick()
	{
		angle.innerText = 'Angle:10';
		dis.innerText='Distance:0';
		
		var postData = '{angle}';
		
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "http://192.168.4.1", true);
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xhr.onreadystatechange = function(){
			var XMLHttpReq = xhr;
			if (XMLHttpReq.readyState == 4) {
				if (XMLHttpReq.status == 200) {
					var str = XMLHttpReq.responseText;
					var jsonResult = JSON.parse(str);
                    document.getElementById("dis").innerText = "名称：" + jsonResult.name + "  编号：" + jsonResult.id;
				}
			}
		};
		xhr.send(postData);
	}
</script>

<script>
	var _touchx = document.getElementById("touchx1");
	var _touchy = document.getElementById("touchy1");
	var _josize = document.getElementById("josize1");
	var _jisize = document.getElementById("jisize1");
	var _centerx = document.getElementById("centerX1");
	var _centery = document.getElementById("centerY1");
	var _jx = document.getElementById("jx1");
	var _jy = document.getElementById("jy1");
	var _touchin = document.getElementById("touch_in1");
	var _vas = document.getElementById("vas1");
	var _dir = document.getElementById("dir1");
	
	var _touchx2 = document.getElementById("touchx2");
	var _touchy2 = document.getElementById("touchy2");
	var _josize2 = document.getElementById("josize2");
	var _jisize2 = document.getElementById("jisize2");
	var _centerx2 = document.getElementById("centerX2");
	var _centery2 = document.getElementById("centerY2");
	var _jx2 = document.getElementById("jx2");
	var _jy2 = document.getElementById("jy2");
	var _touchin2 = document.getElementById("touch_in2");
	var _vas2 = document.getElementById("vas2");
	var _dir2 = document.getElementById("dir2");

	var ji = new Image(); //内摇杆图片
	var jo = new Image(); //外摇杆图片
	var joystick = document.getElementById('joystick'); //画板
	var joystick2 = document.getElementById('joystick2'); //画板
	var josize = 150; //外摇杆大小
	var jisize = josize * 0.6; //内摇杆直径
	var centerX = josize / 2; //摇杆中心x坐标或半径
	var centerY = josize / 2; //摇杆中心y坐标或半径
	window.addEventListener('load', load, false);
	var jc = joystick.getContext('2d'); //画布
	var jc2 = joystick2.getContext('2d'); //画布2
	
	var fanwei = centerX - jisize / 2;//摇杆移动的范围,内外摇杆之差
	 
	//摇杆头应当移动到的位置
	var jx = 0,
		jy = 0;
		
	var jx2 = 0,
		jy2 = 0;	
		
	var offset = 20;//画板比图片的四个方向都大20,内摇杆超出外摇杆时能正常显示
	
	var documentWidth = document.documentElement.clientWidth;//页面宽度
	//alert(documentWidth); 
	//获取画板1的位置1
	var vx=0,vy=0;
	//获取画板1的位置2
	var vx2=0,vy2=0;
	
	var effectiveFinger = 0; //当前有效手指
	var effectiveFinger2 = 1; //当前有效手指
	var touchin = 0;
	var touchin2 = 0;
	
	function updataLocation()
	{
		var _op=document.getElementById('joystick');
		vy = 0;
		vx = 0;
		while(_op!=null){
		vy+=_op.offsetTop;
		vx+=_op.offsetLeft;
		_op=_op.offsetParent;
		}
		vy = vy+joystick.height/2;
		vx = vx+joystick.height/2;
		_vas.innerText = " vx: "+vx + " vy: "+ vy;
	
		var _op2=document.getElementById('joystick2');
		vy2 = 0;
		vx2 = 0;
		while(_op2!=null){
		vy2+=_op2.offsetTop;
		vx2+=_op2.offsetLeft;
		_op2=_op2.offsetParent;
		}
		vy2 = vy2+joystick.height/2;
		vx2 = vx2+joystick.height/2;
		_vas2.innerText = " vx: "+vx2 + " vy: "+ vy2;	
	}
	
	//图片加载完成时执行这俩函数
	ji.onload = function() { 
		jc.drawImage(ji, offset, offset, jisize, jisize); //首次绘制内摇杆
		jc2.drawImage(ji, offset, offset, jisize, jisize); //首次绘制内摇杆
	}
	jo.onload = function() {
		jc.drawImage(jo, offset, offset, josize, josize);
		jc2.drawImage(jo, offset, offset, josize, josize);
	}

	//绘图函数（绘制图形的时候就是用户观察到摇杆动了，所以取名是move）
	function move() 
	{
		//清空画板1
		jc.clearRect(0, 0, joystick.height, joystick.height);
		//画底座1
		jc.drawImage(jo, offset, offset, josize, josize);
		//画摇杆头1
		jc.drawImage(ji, fanwei + jx+offset, fanwei + jy+offset, jisize, jisize);
		//清空画板2
		jc2.clearRect(0, 0, joystick.height, joystick.height);
		//画底座2
		jc2.drawImage(jo, offset, offset, josize, josize);
		//画摇杆头2
		jc2.drawImage(ji, fanwei + jx2+offset, fanwei + jy2+offset, jisize, jisize);
		requestAnimationFrame(move); //下一次绘图
	}
	ji.src = 'img/joystickin.png';//加载图片
	jo.src = 'img/joystickout.png';//加载图片
	 
	 
	function touch1(num)
	{
		effectiveFinger = num;
		//判断是否击中摇杆头
		_touchx.innerText = 'TouchX:'+Math.round(event.touches[effectiveFinger].clientX);
		_touchy.innerText = 'TouchY:'+Math.round(event.touches[effectiveFinger].clientY);
		var x = Math.abs(event.touches[effectiveFinger].clientX-vx);
		var y = Math.abs(event.touches[effectiveFinger].clientY-vy);
		if((x<(fanwei+15))&&(y<(fanwei+15)))
		{
			x = event.touches[effectiveFinger].clientX-vx;
			y = event.touches[effectiveFinger].clientY-vy;
			
			jx=Math.round(x);//把数四舍五入为最接近的整数
			jy=Math.round(y);//把数四舍五入为最接近的整数
			touchin = 1;
		}
	}
	
	function touch2(num)
	{
		effectiveFinger2 = num;
		//判断是否击中摇杆头
		_touchx2.innerText = 'TouchX:'+Math.round(event.touches[effectiveFinger2].clientX);
		_touchy2.innerText = 'TouchY:'+Math.round(event.touches[effectiveFinger2].clientY);
		var x2 = Math.abs(event.touches[effectiveFinger2].clientX-vx2);
		var y2 = Math.abs(event.touches[effectiveFinger2].clientY-vy2);
		if((x2<(fanwei+15))&&(y2<(fanwei+15)))
		{
			x2 = event.touches[effectiveFinger2].clientX-vx2;
			y2 = event.touches[effectiveFinger2].clientY-vy2;
			
			jx2=Math.round(x2);//把数四舍五入为最接近的整数
			jy2=Math.round(y2);//把数四舍五入为最接近的整数
			touchin2 = 1;
		}	
	}
	 
	//页面加载时执行该函数
	function load() {
		document.addEventListener('touchstart', touch, false);
		document.addEventListener('touchmove', touch, false);
		document.addEventListener('touchend', touch, false);
	 	//更新摇杆位置
	 	updataLocation();
		//加载的时候先把摇杆绘制出来再说
		move();
	 
		//触摸事件触发函数
		function touch(event) {
			var event = event || window.event;
			
			_centerx.innerText = 'centerX:'+centerX;
			_centery.innerText = 'centerY:'+centerY;
			_josize.innerText = 'josize:'+josize;
			_jisize.innerText = 'jisize:'+jisize;
			_jx.innerText = 'jx:'+jx;
			_jy.innerText = 'jy:'+jy;
			_touchin.innerText = "touchin:"+touchin;
			switch(event.type) {
				case "touchstart":
					updataLocation();
					
					//判断有几个手指
					if(event.touches[0]&&event.touches[1])//第二个手指按下
					{
						if(touchin2){touch1(1);}
						else if(touchin){touch2(1);}
						else{
								if(event.touches[1].clientX>(documentWidth/2))//点到了右边
								{touch2(1);}
								else{touch1(1);}
								if(event.touches[0].clientX>(documentWidth/2))//点到了右边
								{touch2(0);}
								else{touch1(0);}
							}
					}
					else if(event.touches[0])//第一个手指按下
					{
						if(event.touches[0].clientX>(documentWidth/2))//点到了右边
						{touch2(0);}
						else{touch1(0);}
					}
					_touchin.innerText = "touchin:"+touchin;
					_touchin2.innerText = "touchin:"+touchin2;
					break;
				case "touchend"://手指离开的时候
						//若手指离开,那就把内摇杆放中间
						if((!event.touches[0])&&(!event.touches[1]))//都放开了
						{
							jx = 0;
							jy = 0;
							_touchx.innerText = 'TouchX:'+'0';
							_touchy.innerText = 'TouchY:'+'0';
							_jx.innerText = 'jx:'+jx;
							_jy.innerText = 'jy:'+jy;	
							touchin = 0;
							_touchin.innerText = "touchin:"+touchin;
							_dir.innerText = '';
							
							jx2 = 0;
							jy2 = 0;
							_touchx2.innerText = 'TouchX:'+'0';
							_touchy2.innerText = 'TouchY:'+'0';
							_jx2.innerText = 'jx:'+jx2;
							_jy2.innerText = 'jy:'+jy2;	
							touchin2 = 0;
							_touchin2.innerText = "touchin:"+touchin2;
							_dir2.innerText = '';
						}
						else 
						{
							if(event.touches[0].clientX>(documentWidth/2))
							{
								jx = 0;
								jy = 0;
								_touchx.innerText = 'TouchX:'+'0';
								_touchy.innerText = 'TouchY:'+'0';
								_jx.innerText = 'jx:'+jx; 
								_jy.innerText = 'jy:'+jy;	
								touchin = 0;
								_touchin.innerText = "touchin:"+touchin;
								_dir.innerText = '';
								effectiveFinger2 = 0;
							}
							else
							{
								jx2 = 0;
								jy2 = 0;
								_touchx2.innerText = 'TouchX:'+'0';
								_touchy2.innerText = 'TouchY:'+'0';
								_jx2.innerText = 'jx:'+jx2;
								_jy2.innerText = 'jy:'+jy2;	
								touchin2 = 0;
								_touchin2.innerText = "touchin:"+touchin2;	
								_dir2.innerText = '';
								effectiveFinger = 0;
							}
						}
					break;
				case "touchmove"://手指移动的时候：
					if(touchin) 
					{
						var x = event.touches[effectiveFinger].clientX-vx;
							y = event.touches[effectiveFinger].clientY-vy;
						if((Math.abs(x)>fanwei)||(Math.abs(y)>fanwei))	
						{
							var atan = Math.atan2(y,x);
							x = Math.cos(atan)*fanwei;
							y = Math.sin(atan)*fanwei;
						}
						jx=Math.round(x);//把数四舍五入为最接近的整数
						jy=Math.round(y);//把数四舍五入为最接近的整数
						_jx.innerText = 'jx:'+jx;
						_jy.innerText = 'jy:'+jy;	
					}
					
					if(touchin2&&event.touches[effectiveFinger2]) 
					{
						var x2 = event.touches[effectiveFinger2].clientX-vx2;
							y2 = event.touches[effectiveFinger2].clientY-vy2;
						if((Math.abs(x2)>fanwei)||(Math.abs(y2)>fanwei))	
						{
							var atan2 = Math.atan2(y2,x2);
							x2 = Math.cos(atan2)*fanwei;
							y2 = Math.sin(atan2)*fanwei;
						}
						jx2=Math.round(x2);//把数四舍五入为最接近的整数
						jy2=Math.round(y2);//把数四舍五入为最接近的整数
						_jx2.innerText = 'jx:'+jx2;
						_jy2.innerText = 'jy:'+jy2;	
					}
					
					if(event.touches[effectiveFinger])
					{
						_touchx.innerText = 'TouchX:'+Math.round(event.touches[effectiveFinger].clientX);
						_touchy.innerText = 'TouchY:'+Math.round(event.touches[effectiveFinger].clientY);
					}

					if(event.touches[effectiveFinger2])
					{
						_touchx2.innerText = 'TouchX:'+Math.round(event.touches[effectiveFinger2].clientX);
						_touchy2.innerText = 'TouchY:'+Math.round(event.touches[effectiveFinger2].clientY);
					}
					_touchin.innerText = "touchin:"+touchin;
					_touchin2.innerText = "touchin:"+touchin2;
					
					if(jy<-10)
						_dir.innerText = '⬆️';
					else
					if(jy>10)
						_dir.innerText = '⬇️';
					else
						_dir.innerText = '🙌';
						
					if(jx2<-10)
						_dir2.innerText = '⬅️';
					else
					if(jx2>10)
						_dir2.innerText = '➡️';
					else
						_dir2.innerText = '🙌';	
					break;
				}  
			}       
	}
	window.onload=function(){
		document.addEventListener('touchmove', function (e) { e.preventDefault(); 
		}, false);
		}
	
	
	
</script>