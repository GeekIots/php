<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>开发者社区 | 极客物联网 </title>
</head>
<body> 
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
		        <textarea id="demo" name="content" required lay-verify="required" placeholder="请输入内容" class="layui-textarea fly-editor" style="height: 260px;">{{d.contents}}</textarea>
		      </div>
		      <label for="L_content" class="layui-form-label" style="top: -2px;">描述</label>
		    </div>
		    <div class="layui-form-item">
		      <div class="layui-inline">
		        <label class="layui-form-label">所在类别</label>
		        <div class="layui-input-block">
		          <select lay-verify="required" id="select_id" name="class">
		            <option>Arduino</option>
		            <option value="1" >Stm32</option> 
		            <option value="2" >Arduino</option> 
		            <option value="3" >Raspberry Pi</option> 
		            <option value="4" >Other</option> 
		          </select>
		        </div>
		      </div>
		        <div class="layui-inline">
		          <label for="L_vercode" class="layui-form-label">人类验证</label>
		          <div class="layui-input-inline">
		            <input type="text" id="L_vercode" name="vercode" required lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
		          </div>
		          <div class="layui-form-mid">
		            <span style="color: #c00;">1+1=?</span>
		          </div>
		        </div>
		    </div>
		   <!--   -->
		    <div class="layui-form-item">
		      <button class="layui-btn">立即发布</button>
		    </div>
	    </div>
    </script>
	<!-- 建立视图。用于呈现模板渲染结果。 -->
	<div id="edit_view"></div>
  </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
</body>
<script>
	//获取请求帖子id
	var _id = getUrlParam('id');
	// 获取本帖内容
	$.ajax({
	    url: "/api/blog/getblog.php",
	    type:'POST',
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
	    },
	    error:function (res) {
	        console.log('fail:',res);
	    }
	});

	layedit.set({
      uploadImage: {
        url: '/api/layui/upload.php' //接口url
        ,type: 'POST' //默认post
        ,data:{'type':'image','url':'blog'}
        }
    });
    
    var index = layedit.build('demo', {tool: [
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

    //编辑器外部操作
    $('.layui-btn').on('click', function(){
    	//获取标题内容
    	var	title = $("#L_title").val();
        
        //获取编辑器内容
        var str = layedit.getContent(index);

        // 获取类型选择内容
        var select_str = $("#select_id").find("option:selected").text();  //获取Select选择的Text

        //获取验证结果
    	var	vercode = $("#L_vercode").val();

    	if (title.length==0) 
        {
        	layer.msg('标题不能为空！',{time:1000});
        }
        else
        if(str.length==0)
        {
            layer.msg('贴子内容不能为空！',{time:1000});
        }
        else
        if(select_str.length==0)
        {
            layer.msg('请选择分类！',{time:1000});
        }
        else
        if(vercode.length==0)
        {
            layer.msg('请回答验证问题！',{time:1000});
        }
        else
        if(vercode!='2')
        {
            layer.msg('验证不正确,小学生？',{time:1200});
        }
        else
        {
            $.ajax({
                type:'POST',
                url: "/api/blog/edit.php",
                data:{'contents':str,'classify':select_str,'id':_id},
                //数据长度太长，放到data里通过post传送
                success: function (argument) {
                    console.log(argument);
                    if (argument.resault=='success') {
                    	layer.msg('更新成功！',{icon:1,time:800},function(){
                          window.location.href='/blog/view.php?id='+_id;
                        });
                    }
                    else{
                    	layer.msg(argument.msg,{time:2000});
                    }
                },
                error:function (argument) {
                	console.log(argument);
                    layer.msg('更新失败！');
                }
            });
        }
    });

    //刷新select选择框渲染
    form.render('select');
</script>
</html>