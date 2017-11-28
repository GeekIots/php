<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>遥控器设置 | 极客物联网</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="keywords" content="物联网">
  <!-- vue -->
  <script src="https://cdn.bootcss.com/vue/2.5.3/vue.js"></script>
  <!-- layui -->
  <link rel="stylesheet" href="/frame/layui-master/src/css/layui.css">
  <link rel="stylesheet" href="/frame/layui-master/src/css/gloabal/global.css">
  <script src="/frame/layui-master/src/layui.js"></script>
  <!-- QQ登录 -->
  <script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js"></script>
  <!-- 自定义函数 -->
  <script src="/common/fun.js"></script>
  <!-- 引入 Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php require($_SERVER['DOCUMENT_ROOT'].'/common/header.php'); ?>
  <main class="contain">
  <script id="moduel" type="text/html">
	<div class="layui-tab layui-tab-card">
	  <ul class="layui-tab-title" >
	    <li class="layui-this" style="font-size: 18px;">配置1</li>
	    <li style="font-size: 18px;">配置2</li>
	    <li style="font-size: 18px;">配置3</li>
	  </ul>
	  <div class="layui-tab-content" >
	    <div class="layui-tab-item layui-show">
	      <!-- 配置1 -->
	      <div class="tab-pane fade in active" id="config1">
			<p style="font-size: 25px;"> </p>
			<table>
			  <tr>
			    <th style="width: 10%">编号</th>
			    <th style="width: 10%">名称</th>
			    <th style="width: 15%">按下指令</th>
			    <th style="width: 15%">抬起指令</th>
			    <th style="width: 10%">预览</th>
			    <th style="width: 20%">链接</th>
			    <th style="width: 10%">显示/隐藏</th>
			  </tr>
			  {{# for(var i=0;i<12;i++){ }}
			  	<tr>
				    <td>{{i}}</td>
				    <td><input type='text' id='1-1-{{i}}' value="{{item1[i].name}}" style='width:95%;height:90%;'></td>
				    <td><input type='text' id='1-2-{{i}}' value="{{item1[i].down}}" style='width:95%;height:90%;'></td>
				    <td><input type='text' id='1-3-{{i}}' value="{{item1[i].up}}" style='width:95%;height:90%;'></td>
				    <td><img id='1-4-{{i}}' src="{{item1[i].icon}}" style='width: 95%;height:auto; '></td>
				    <td><input type='text' value="{{item1[i].icon}}" id='1-5-{{i}}' style='width:95%;height:90%;'></td>
				    <td><input type='checkbox' id='1-6-{{i}}' style='width: 20%;height: 100%'/></td>
				</tr>
			  {{# } }}
			</table>
			<div style="text-align: center;">
				<button id="upload1" class="btn btn-default _button" >上传到服务器</button>
			</div>
		  </div>
	    </div>
	    <div class="layui-tab-item">
	      <!-- 配置2 -->
	      <div class="tab-pane fade in active" id="config2">
			<p style="font-size: 25px;"> </p>
			<table>
			  <tr>
			    <th style="width: 10%">编号</th>
			    <th style="width: 10%">名称</th>
			    <th style="width: 15%">按下指令</th>
			    <th style="width: 15%">抬起指令</th>
			    <th style="width: 10%">预览</th>
			    <th style="width: 20%">链接</th>
			    <th style="width: 10%">显示/隐藏</th>
			  </tr>
			  {{# for(var i=0;i<12;i++){ }}
			  	<tr>
				    <td>{{i}}</td>
				    <td><input type='text' id='2-1-{{i}}' value="{{item2[i].name}}" style='width:95%;height:90%;'></td>
				    <td><input type='text' id='2-2-{{i}}' value="{{item2[i].down}}" style='width:95%;height:90%;'></td>
				    <td><input type='text' id='2-3-{{i}}' value="{{item2[i].up}}" style='width:95%;height:90%;'></td>
				    <td><img id='2-4-{{i}}' src="{{item2[i].icon}}" style='width: 95%;height:auto; '></td>
				    <td><input type='text' value="{{item2[i].icon}}" id='2-5-{{i}}' style='width:95%;height:90%;'></td>
				    <td><input type='checkbox' id='2-6-{{i}}' style='width: 20%;height: 100%'/></td>
				</tr>
			  {{# } }}
			</table>
			<div style="text-align: center;">
				<button id="upload2" class="btn btn-default _button" >上传到服务器</button>
			</div>
		  </div>
	    </div>
	    <div class="layui-tab-item">
	      <!-- 配置3 -->
	       <div class="tab-pane fade in active" id="config1">
			<p style="font-size: 25px;"> </p>
			<table>
			  <tr>
			    <th style="width: 10%">编号</th>
			    <th style="width: 10%">名称</th>
			    <th style="width: 15%">按下指令</th>
			    <th style="width: 15%">抬起指令</th>
			    <th style="width: 10%">预览</th>
			    <th style="width: 20%">链接</th>
			    <th style="width: 10%">显示/隐藏</th>
			  </tr>
			  {{# for(var i=0;i<12;i++){ }}
			  	<tr>
				    <td>{{i}}</td>
				    <td><input type='text' id='3-1-{{i}}' value="{{item3[i].name}}" style='width:95%;height:90%;'></td>
				    <td><input type='text' id='3-2-{{i}}' value="{{item3[i].down}}" style='width:95%;height:90%;'></td>
				    <td><input type='text' id='3-3-{{i}}' value="{{item3[i].up}}" style='width:95%;height:90%;'></td>
				    <td><img id='3-4-{{i}}' src="{{item3[i].icon}}" style='width: 95%;height:auto; '></td>
				    <td><input type='text' value="{{item3[i].icon}}" id='3-5-{{i}}' style='width:95%;height:90%;'></td>
				    <td><input type='checkbox' id='3-6-{{i}}' style='width: 20%;height: 100%'/></td>
				</tr>
			  {{# } }}
			</table>
			<div style="text-align: center;">
				<button id="upload3" class="btn btn-default _button" >上传到服务器</button>
			</div>
		  </div>
	    </div>
	  </div>
	</div>
  </script>
    <!-- 建立视图。用于呈现模板渲染结果。 -->
    <div id="view"></div>
  </main>
</body>
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
</html>
<script type="text/javascript">
  var item1,item2,item3;
  layui.use(['layer','laydate','laypage','laytpl','layedit','form','upload','tree','table','element','util','flow','carousel','code','jquery'], function(){
      var layer,laydate,laypage,laytpl,layim,layedit,form,upload,tree,table,element,util,flow,carousel,code,$,mobile;
      layer = layui.layer;
      laydate = layui.laydate;
      laypage = layui.laypage;
      laytpl = layui.laytpl;
      layedit = layui.layedit;
      form = layui.form;
      upload = layui.upload;
      tree = layui.tree;
      table = layui.table;
      element = layui.element;
      util = layui.util;
      flow = layui.flow;
      carousel = layui.carousel;
      code = layui.code;
      $  = layui.jquery;
	 	// console.log(JSON.stringify(item));
		if (user.login=='false') {
	  	 //公告层
	      layer.open({
	        type: 1
	        ,title: false //不显示标题栏
	        ,closeBtn: false
	        ,area: '300px;'
	        ,shade: 0.8
	        ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
	        ,btn: ['前去登陆', '看看再说']
	        ,btnAlign: 'c'
	        ,moveType: 1 //拖拽模式，0或者1
	        ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 400;">亲,进入蓝牙配置需要登陆哦！</div>'
	        ,success: function(layero){
	          var btn = layero.find('.layui-layer-btn');
	          btn.find('.layui-layer-btn0').attr({
	            href: '/user/login.php'
	            ,target: '_blank'
	          });
	          btn.find('.layui-layer-btn1').attr({
	            href: '/index.php'
	          });
	        }
	      });
	  }
	  else
	  {
		//获取遥控器界面参数
		$.ajax({
			url: "/api/wxin/bluetooth.php?type=get&num=1&userid="+user.userid,
			success: function (argument) {
				console.log(argument);
				// 将json字符串转换为json对象
				item1=JSON.parse(argument.item[0]);
				tpl();
			},
			error:function (argument) {
				console.log(argument);
			}
		});
		$.ajax({
			url: "/api/wxin/bluetooth.php?type=get&num=2&userid="+user.userid,
			success: function (argument) {
				console.log(argument);
				// 将json字符串转换为json对象
				item2=JSON.parse(argument.item[0]);
				tpl();
			},
			error:function (argument) {
				console.log(argument);
			}
		});
		$.ajax({
			url: "/api/wxin/bluetooth.php?type=get&num=3&userid="+user.userid,
			success: function (argument) {
				console.log(argument);
				// 将json字符串转换为json对象
				item3=JSON.parse(argument.item[0]);
				tpl();
			},
			error:function (argument) {
				console.log(argument);
			}
		});

		// 渲染界面
		function tpl() {
			// 三组数据全部获取开始渲染
			if (item1&&item2&&item3) {
				var getTpl = moduel.innerHTML;
				var view = document.getElementById('view');
				laytpl(getTpl).render(item1, function(html){
				view.innerHTML = html;
				});				

				// 更新选择框
				for (var i = 12 - 1; i >= 0; i--) {
					$("#1-6-"+i.toString()).attr("checked",item1[i].show);
					$("#2-6-"+i.toString()).attr("checked",item2[i].show);
					$("#3-6-"+i.toString()).attr("checked",item3[i].show);
				}

				//所有的input引起的变化
				$(":input").bind("change",function(){
					//打印引起事件的标签信息
			  		console.log('change:', this);
			  		var arr = $(this).attr('id').toString().split('-');
					console.log('configID:', arr[0]);
					console.log('列:', arr[1]);
					console.log('行号:', arr[2]);
			  		
			  		switch(arr[1])
			  		{
			  			case '1'://name
							eval('item' + arr[0])[arr[2]].name = $(this).val();
			  				break;
						case '2'://down
							eval('item' + arr[0])[arr[2]].down = $(this).val();
			  				break;
			  			case '3'://up
							eval('item' + arr[0])[arr[2]].up = $(this).val();
			  				break;
			  			case '5'://icon
							eval('item' + arr[0])[arr[2]].icon = $(this).val();
							//更新显示图片
							var id = '#'+arr[0]+'-4-'+arr[2];
							console.log(id);
							$(id).attr("src",$(this).val());
			  				break;
			  			case '6'://show
							eval('item' + arr[0])[arr[2]].show = $(this).prop('checked');
							break;
			  		}
					// console.log('1:',item1);
					// console.log('2:',item2);
					// console.log('3:',item3);
				});	

				//上传到服务器
				$('[id^="upload"]').click(function(){
					console.log('开始上传');
					var id = $(this).attr('id').toString().replace('upload','');
					var item;	 
					if (id==1) {
						item = item1;
					}
					else
					if (id==2) {
						item = item2;
					}
					else
					if (id==3) {
						item = item3;	
					}
					var str = JSON.stringify(item);
					// console.log(str);
					$.ajax({
						url: "/api/wxin/bluetooth.php?type=set&num="+id+"&userid="+user.userid,
						data:{"str":str},//数据长度太长，放到data里面传送
						success: function (argument) {
							console.log(argument);
							if (argument.resault=='success') {
					              layer.msg('更新成功！', {
					              time: 1000 //1s后自动关闭
					            });
					        }
					        else{
					            // 显示错误信息
					            layer.msg('Sorroy,更新失败!'+res.msg, {
					                  time: 20000, //20s后自动关闭
					                  btn: ['知道了']
					                  ,yes: function(){
					                    layer.closeAll();
					                  }
					              });
					          }
						},
						error:function (argument) {
							console.log(argument);
						}
					});
				});
			}
		}	
	  }
	});
</script>
