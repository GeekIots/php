<?php
include "../public/header.php";
//phpinfo();
?>
<!DOCTYPE>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>关于我们</title>
	<meta name="keywords" content="关于极客物联网">
	<meta name="description" content="关于极客物联网">
<script>
$(function(){
	$(".container>div").hide();
	$(".container>div:eq(0)").show();	
	
	$(".navContent a").click(function(){
		var n = $(".navContent a").index(this);
		$(".navContent a").index(this);
		$(".container>div").hide();
		$(".container>div:eq("+n+")").show();	
	})
	
	
})
</script>
<style>
* {
	margin: 0;
}
img, a {
	display: block;
	text-decoration: none;
}
p, span {
	font-size: 14px;
	font-family: '微软雅黑';
	color: #4d4d4d;
}
body {
	/*background-image: url(images/bg.jpg);*/
	background-repeat: no-repeat;
}
.mainContainer {
	width: 1500px;
	margin: 150px auto auto 500px;
	overflow: hidden;
	background-color: #FFF;
}
.navContent {
	float: left;
}
.infoBox {
	float: left;
	width: 920px;
	margin-left: 30px;
	margin-top: 40px;
}
.logo {
	width: 200px;
	height: 120px;
}
.logobox {
	margin-left: 40px;
	padding-top: 38px;
}
.book {
	padding-left: 83px;
	padding-right: 44px;
	display: block;
	background-color: #78bcaf;
	background-image: url(images/logo_2.png);
	background-repeat: no-repeat;
	background-position: 25px center;
}
.box {
	padding-left: 83px;
	padding-right: 44px;
	display: block;
	background-color: #adca7a;
	background-image: url(images/logo_4.png);
	background-repeat: no-repeat;
	background-position: 25px center;
}
.box01 {
	padding-left: 83px;
	padding-right: 44px;
	display: block;
	background-color: #67affb;
	background-image: url(images/logo_3.png);
	background-repeat: no-repeat;
	background-position: 25px center;
}
.contact {
	padding-left: 83px;
	padding-right: 44px;
	display: block;
	background-color: #f87678;
	background-image: url(images/logo_1.png);
	background-repeat: no-repeat;
	background-position: 25px center;
}
.navContent a {
	color: #FFF;
	font-size: 16px;
	font-family: '微软雅黑';
	text-align: center;
	line-height: 120px;
}
.status {
	font-size: 30px;
	color: #f87678;
	line-height: 70px;
}
.message p {
	float: left;
}
.message {
	margin-top: 30px;
}
.blackTest {
	text-indent: 2em;
	font-size: 28px;
	line-height: 1.5em;
	text-align: justify;
	color: #5B5B5B;
}
.friend {
	line-height: 25px;
}
.edit {
	background-color: #d6ebe7;
	width: 200px;
	height: 160px;
	line-height: 30px;
	margin-left: 20px;
	padding-top: 20px;
	padding-left: 25px;
}
.devise {
	background-color: #e6efd7;
	width: 200px;
	height: 160px;
	line-height: 30px;
	padding-top: 20px;
	padding-left: 25px;
}
.publicity {
	background-color: #d1e7fe;
	width: 200px;
	height: 160px;
	line-height: 20px;
	padding-top: 20px;
	padding-left: 25px;
}
.media {
	background-color: #fdd6d6;
	width: 200px;
	height: 160px;
	line-height: 20px;
	padding-top: 20px;
	padding-left: 25px;
}
.plan {
	background-color: #fdd6d6;
	width: 200px;
	height: 160px;
	line-height: 25px;
	padding-top: 20px;
	padding-left: 25px;
	margin-left: 20px;
}
.world {
	background-color: #d1e7fe;
	width: 200px;
	height: 160px;
	line-height: 30px;
	padding-top: 20px;
	padding-left: 25px;
}
.world span {
	font-size: 20px;
	color: #78bcaf;
	color: #4d4d4d;
}
.job {
	background-color: #e6efd7;
	width: 200px;
	height: 160px;
	line-height: 30px;
	padding-top: 20px;
	padding-left: 25px;
}
.joinus {
	background-color: #d6ebe7;
	width: 225px;
	height: 180px;
	line-height: 180px;
	float: left;
	font-size: 30px;
	text-align: center;
	font-family: '微软雅黑';
	color: #4d4d4d;
}
.secondInfo {
	width: 1000px;
	background-color: #78bcaf;
	float: left;
	height: 600px;
}
.bannerBox div {
	float: left;
	margin-right: 60px;
}
.bannerBox img {
	display: block;
	margin: 0 auto;
}
.young {
	margin-top: 70px;
	line-height: 30px;
	color: #FFF;
}
.bigTest, .bannerBox {
	margin-left: 50px;
}
.young span, .fond span {
	font-size: 24px;
	color: #FFF;
}
.fond {
	color: #FFF;
	margin-top: 20px;
}
.bannerBox {
	margin-top: 95px;
}
.bannerBox p {
	color: #FFF;
	text-align: center;
	margin-top: 20px;
	line-height: 25px;
}
.bannerBox span {
	color: #e6e6e6;
}
.thirdInfo {
	width: 1000px;
	overflow: hidden;
}
.fontTest {
	float: left;
	background-color: #adca7a;
}
.map {
	float: right;
	width: 587px;
	height: 600px;
	background-color: #78bcaf;
}
.fontTest {
	width: 413px;
	height: 600px;
}
.fontTest p {
	font-size: 20px;
	color: #FFF;
}
.fontTest .workRoom {
	margin-top: 200px;
	line-height: 50px;
	margin-left: 50px;
}
.fontTest .address {
	margin-left: 50px;
	line-height: 30px;
}
.map img {
	display: block;
	/*margin: 47px auto;*/
}
.lastInfo, .fourInfo {
	width: 1000px;
	overflow: hidden;
}
.photoBox img {
	float: left;
	display: block;
}
.photoBox {
	width: 1000px;
	overflow: hidden;
	position: absolute;
	top: -120px;
	left: 50px;
}
.bottomBox {
	background-color: #f87678;
	height: 300px;
	position: relative;
}
.walfareBox {
	height: 300px;
	margin-left: 50px;
}
.walfare {
	padding-top: 30px;
	font-size: 20px;
	line-height: 45px;
}
.sangs {
	margin-top: 10px;
}
.attend {
	padding-top: 130px;
	margin-left: 50px;
	overflow: hidden;
}
.attend span, .attend img {
	float: left;
	color: #FFF;
}
.attend p {
	color: #FFF;
	font-size: 25px;
	line-height: 40px;
}
.attend img {
	margin-left: 80px;
	margin-top: -30px;
}
.life {
	height: 360px;
}
.life p {
	font-size: 20px;
	padding-top: 50px;
	margin-left: 80px;
}
.blue img, .rightBox {
	float: left;
}
.blue {
	background-color: #67affb;
	height: 240px;
	position: relative;
}
.blue img {
	position: absolute;
	top: -250px;
	left: 50px;
}
.rightBox {
	position: absolute;
	top: -260px;
	right: 80px;
}
.rightBox span {
	line-height: 28px;
}
.rightBox p {
	margin-top: 25px;
}
.img-show{
	width: 200px;
	height: 200px;
	border-radius: 100px;
	margin-right: 20px;
}
</style>
</head>

<body>
<div class="mainContainer">

	<div class="navContent">
		<a class="logo" href="#"><img class="logobox" src="images/logo.png"></a>
		<a class="book" href="#">互动平台</a>
		<a class="box" href="#">联系我们</a>
		<a class="box01" href="#">极客文化</a>
		<a class="contact" href="#">极客工作</a>
	</div>
	
	<div class="container">
	  <div class="infoBox" style="display: block;">
		<p>
			<span class="status">「极客物联网」</span>
			<br>
			<p class="blackTest">极客物联网是一个开源的物联网开发平台，无论你是web开发、51单片机、stm32或者是arduino,都可以轻松控制家里灯泡，电饭锅，热水器，空调等，通过入门手册，您可以在几分钟内体验远程控制的快感，不要在犹豫了，赶紧加入我们吧！</p>
			<p class="blackTest">QQ群：550173936</p>
			<p class="blackTest">微信小程序：搜索“极客物联网”</p>
			<p class="blackTest">微信公众号：搜索“创客物联网”</p>
			
		</p>
	  </div>
	  <div class="secondInfo" style="display: none;">
		<div class="bigTest">
		  <p class="young"><span>极客</span>是一个认真表达年轻人生活状态和态度的交互平台。我们用最简单的方式传达同时空下的生活体验和个人价值观。 <br>
			我们相信只有还原出一个人饱满的世界，我们才能找到左右为伴的彼此。</p>
		  <p class="fond"><span>极客</span>发现身边极客们的精彩作品和想法。</p>
		</div>
		<div class="bannerBox">
		  <div class="firstBanner"> <img src="images/logo_5.png">
			<p>QQ交流群<br>
			  <span>qq查询<br>
			  550173936</span></p>
		  </div>
		  <div class="secondBanner"> <img src="images/logo_6.png">
			<p>公众号<br>
			  <span>添加公众号<br>
			  查看历史消息</span></p>
		  </div>
		  <div class="thirdBanner"> <img src="images/logo_7.png">
			<p>沟通建议<br>
			  <span>Email发送至<br>
			  sunyiming537@126.com</span></p>
		  </div>
		  <div class="fourBanner"> <img src="images/logo_8.png">
			<p>微信小程序<br>
			  <span>发现-小程序<br>
			  搜索'极客物联网'<br></span></p>
		  </div>
		</div>
	  </div>
	  <div class="thirdInfo" style="display: none;">
		<div class="fontTest">
		  <p class="workRoom">极客物联网工作室</p>
		  <p class="address">地址：西安<br>
			作品发送至：<br>
			sunyiming537@126.com<br>
			如果你方便也请一并告诉我们你的<br>
			blog、微博、insta、知乎等账户。</p>
		</div>
		<div class="map"><img style="width: 587px;" src="images/map1.png"></div>
	  </div>
	  <div class="fourInfo" style="display: none;">
		<div class="life">
		  <p>陌生人&nbsp;&nbsp;|&nbsp;&nbsp;比编剧更厉害的是生活</p>
		</div>
		<div class="blue"> <img src="images/banner_6.jpg">
		  <div class="rightBox"> <span>地铁站外，公交站前，忙碌一天的人们，<br>
			又将沿着各自的轨道回到这个城市某个角落。<br>
			日复一日的画面，看似每个人都活着同样的轨迹，<br>
			可每个人在那些角落发生的故事，<br>
			却有着比影视剧还精彩的桥段。<br>
			别以为极客厉害，生活比什么都厉害。</span>
			<p>陌生人|旁观者的镜头，旁观者的想。</p>
		  </div>
		</div>
	  </div>
	  <div class="lastInfo" style="display: none;">
		<div class="walfareBox">
		  <p class="walfare">极客工作 | 工作状态</p>
		  <!-- <p class="like"><br> -->
			<!-- 第一段文字</p> -->
		  <!-- <p class="sangs">第二段文字</p> -->
		</div>
		<div class="bottomBox">
		  <div class="photoBox"> <img class="img-show" src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1503484964146&di=093d12ab635d292ee8826f13404ae518&imgtype=0&src=http%3A%2F%2Fnewsimg1.roboo.com%2F20161224%2F4a9ab4ff81d5fad600fc901a44cba29e.jpg"> <img class="img-show" src="http://img5.imgtn.bdimg.com/it/u=2675305963,3286832162&fm=26&gp=0.jpg"> <img class="img-show" src="http://img3.imgtn.bdimg.com/it/u=3738616795,2704132200&fm=26&gp=0.jpg"> <img class="img-show" src="http://img3.imgtn.bdimg.com/it/u=2414956461,4036274038&fm=26&gp=0.jpg"> </div>
		  <div class="attend">
			<p>加入方式：</p>
			<span>1.关注微信：搜索公众号ID：创客物联网 <br>
			2.加入QQ群，群号：550173936<br>
			3.微信小程序，搜索：极客物联网</span> 
			<!-- <img src="images/banner_5.png">  -->
			</div>
		</div>
	  </div>
	</div>
	
</div>
<script type="text/javascript">
function stops(){
   return false;
}
document.oncontextmenu=stops;
</script>


 </body></html>