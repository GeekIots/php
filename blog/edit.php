<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>开发者社区 | 极客物联网 </title>
</head>
<body> 
<form action="">
  <div class="main layui-clear">
    <div class="fly-panel" pad20>
      <h2 class="page-title">编辑此贴</h2>
      <!-- <div class="fly-none">并无权限</div> -->
  	  <script id="edit_moduel" type="text/html">
  	    <div class="layui-form layui-form-pane">
  		    <div class="layui-form-item">
  		      <label for="L_title" class="layui-form-label">标题</label>
  		      <div class="layui-input-block">
  		        <input type="text" id="L_title" name="title" required lay-verify="required" autocomplete="off" class="layui-input" value="{{d.title}}">
  		      </div>
  		    </div>
  		    <div class="layui-form-item layui-form-text">
  		      <div class="layui-input-block">
  		        <textarea id="demo" name="contents" required lay-verify="required" placeholder="请输入内容" class="layui-textarea fly-editor" style="height: 260px;">{{d.contents}}</textarea>
  		      </div>
  		      <label for="L_content" class="layui-form-label" style="top: -2px;">描述</label>
  		    </div>
  		    <div class="layui-form-item">
  		      <div class="layui-inline">
  		        <label class="layui-form-label">所在类别</label>
  		        <div class="layui-input-block">
  		          <select lay-verify="required" id="select_id" name="class">
  		            <option>{{d.classify}}</option>
  		            <option value="Stm32" >Stm32</option> 
  		            <option value="Arduino" >Arduino</option> 
  		            <option value="Raspberry Pi" >Raspberry Pi</option> 
  		            <option value="Other" >Other</option> 
  		          </select>
  		        </div>
  		      </div>
		        <div class="layui-inline">
		          <label for="L_vercode" class="layui-form-label">人类验证</label>
		          <div class="layui-input-inline">
		            <input type="text" id="L_vercode" name="vercode" required lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
		          </div>
		          <div class="layui-form-mid">
		            <span style="color: #c00;">2+1=?</span>
		          </div>
		        </div>
  		    </div>
  		   <!--   -->
  		    <div class="layui-form-item">
            <button class="layui-btn" lay-filter="publish-btn" lay-submit>立即发布</button>
  		    </div>
  	    </div>
      </script>
  	<!-- 建立视图。用于呈现模板渲染结果。 -->
  	<div id="edit_view"></div>
    </div>
  </div>
</form>
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
</body>
<script>
	//获取请求帖子id
	var _id = getUrlParam('id');
  var index;//编辑器id
	// 获取本帖内容
	$.ajax({
	    url: "/api/blog/getblog.php",
	    type:'POST',
      async: true,
	    data:{'id':_id},
	    success: function (res) {
	      console.log('success:',res);
	      user_answer = res;
	      //渲染数据
	      var getTpl = edit_moduel.innerHTML;
	      var view = document.getElementById('edit_view');
	      laytpl(getTpl).render(res, function(html){
	        view.innerHTML = html;
	      });
        layedit.set({
          uploadImage: {
            url: '/api/upload/upload.img.php' //接口url
            ,type: 'POST' //默认post
            ,async:true //异步上传
            ,data:{'type':'blog','userid':user_d.userid,'blogid':_id,'size':500}
            }
        });
        
        index = layedit.build('demo', {tool: [
          'face' //表情
          ,'image' //插入图片
          ,'link' //超链接 
          ,'code'      
          // 'strong' //加粗
          // ,'italic' //斜体
          // ,'underline' //下划线
          // ,'del' //删除线
          // ,'|' //分割线
          ,'left' //左对齐
          ,'center' //居中对齐
          ,'right' //右对齐
          // ,'unlink' //清除链接
          // ,'help' //帮助
           // , 'html'
            ]
        });    
        //刷新select选择框渲染
        form.render('select');    
	    },
	    error:function (res) {
	        console.log('fail:',res);
	    }
	});

  //监听发布
  form.on('submit(publish-btn)', function(data){
    // layer.msg(JSON.stringify(data.field));
    // console.log(data.field);
    // console.log(layedit.getContent(index));
    var content = layedit.getContent(index);
    //判断帖子内容
    if(!content)
    {
      layer_msg('帖子内容不能为空！');
    }
    //判断验证码
    else if(data.field.vercode!='3')
    {
      layer_msg('验证信息不正确！');
    }
    else
    {
      $.ajax({
        type:'POST',
        url: "/api/blog/edit.php",
        data:{'title':data.field.title,'contents':content,'classify':data.field.class,'id':_id},
         success: function (argument) {
          if (argument.resault=='success') {
            layer.msg('更新成功！',{icon:1,time:800},function(){
              window.location.href='/blog/view.php?id='+_id;
            });
          }
          else{
            console.log("错误：",argument);
            layer_msg('更新失败：'+argument.msg,4);
          }
        },
        error:function (argument) {
          console.log(argument);
          layer_msg('更新失败！',4);
        }
      });
    }    
    return false;
  });
</script>
</html>