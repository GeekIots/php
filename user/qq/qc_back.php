<!-- <script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" charset="utf-8" data-callback="ture"></script> -->
<!DOCTYPE html>
<html>
<head>
	<title>回调页面</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- 预加载的layui模块 -->
	<script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/common/layerload.js"></script>
	<script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" data-appid="101435544" charset="utf-8"></script>
	  <!-- data-callback="true" -->
</head>
<body>

</body>
</html>
<script type="text/javascript">  
if(QC.Login.check()){//如果已登录  
    QC.Login.getMe(function(openId, accessToken){  
        alert(["当前用户的", "openId为："+openId, "accessToken为："+accessToken].join("\n"));  
        console.log("openId为："+openId );
        console.log("accessToken为："+accessToken );
    });  
    //OpenID是每个QQ唯一的，可用于绑定会员，请在本页配置数据库，写入用户表！ 
    //同时先加入用户表查询判断，如果用户表里面存在OpenID,则无需重新授权也无需入库，登录后直接跳转后台，
    //从页面收集OpenAPI必要的参数。get_user_info不需要输入参数，因此paras中没有参数
}  
var paras = {};
//用JS SDK调用OpenAPI
QC.api("get_user_info", paras).success(function(s){
		//成功回调，通过s.data获取OpenAPI的返回数据
		console.log('用户信息',s);
	}).error(function(f){
		//失败回调
		console.log('获取用户信息失败！',f);
	}).complete(function(c){
		//完成请求回调，返回之前页面

		// 执行登陆流程
		var backurl = getUrlParam('backurl');
		if(backurl==''){  
		    location.href = '/index.php';  
		} 
		else
		    location.href = backurl;  
	});
</script>