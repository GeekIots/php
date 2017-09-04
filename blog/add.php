<!DOCTYPE html>
<html>
<head>
  <title>开发者社区 | 极客物联网 </title>
</head>
<body> 
<?php include('header.php') ?>
<div class="main layui-clear">
  <div class="fly-panel" pad20>
    <h2 class="page-title">发表问题</h2>
    
    <!-- <div class="fly-none">并无权限</div> -->

    <div class="layui-form layui-form-pane">
      <form action=" method="post">
        <div class="layui-form-item">
          <label for="L_title" class="layui-form-label">标题</label>
          <div class="layui-input-block">
            <input type="text" id="L_title" name="title" required lay-verify="required" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item layui-form-text">
          <div class="layui-input-block">
            <textarea id="demo" name="content" required lay-verify="required" placeholder="请输入内容" class="layui-textarea fly-editor" style="height: 260px;"></textarea>
          </div>
          <label for="L_content" class="layui-form-label" style="top: -2px;">描述</label>
        </div>
        <div class="layui-form-item">
          <div class="layui-inline">
            <label class="layui-form-label">所在类别</label>
            <div class="layui-input-block">
              <select lay-verify="required" name="class">
                <option></option>
                <option value="1" >layui框架综合</option> 
                <option value="2" >layui.mobile模块</option> 
                <option value="3" >layer弹出层</option> 
              </select>
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">悬赏飞吻</label>
            <div class="layui-input-block">
              <select name="experience">
                <option value="5" selected>5</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select>
            </div>
          </div>
        </div>
        <div class="layui-form-item">
          <label for="L_vercode" class="layui-form-label">人类验证</label>
          <div class="layui-input-inline">
            <input type="text" id="L_vercode" name="vercode" required lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
          </div>
          <div class="layui-form-mid">
            <span style="color: #c00;">1+1=?</span>
          </div>
        </div>
        <div class="layui-form-item">
          <button class="layui-btn" lay-filter="*" lay-submit>立即发布</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include('footer.php') ?>
</body>
<script src="../frame/layui-v2.1.0/layui/layui.js"></script>
<script>
    layui.use(['layedit','jquery'],function(){
    var layedit = layui.layedit,$ = layui.jquery;
    layedit.set({
      uploadImage: {
        url: '../api/layui/upload.php?act=images', //接口url
        type: 'post' //默认post
        }
    });
    var index = layedit.build('demo', {tool: [
        'strong' //加粗
        ,'italic' //斜体
        ,'underline' //下划线
        // ,'del' //删除线

        ,'|' //分割线

        ,'left' //左对齐
        ,'center' //居中对齐
        ,'right' //右对齐
        ,'link' //超链接
        // ,'unlink' //清除链接
        ,'face' //表情
        ,'image' //插入图片
        // ,'help' //帮助
        ]
        ,height: 180
        });

    //编辑器外部操作
    $('.layui-btn').on('click', function(){
        //获取编辑器内容
        var str = layedit.getContent(index);
        if(str.length==0)
        {
            layer.msg('回复内容不能为空！');
        }
        else
        {
            $.ajax({
                type:'POST',
                url: "../blog/answer.php",
                data:{'data':str,'userid':'sun','toid':'2'},
                //数据长度太长，放到data里通过post传送
                success: function (argument) {
                    console.log(argument);
                    layer.msg('回复成功！');
                    window.location.reload();//刷新当前页面.
                },
                error:function (argument) {
                    layer.msg('回复失败！');
                }
            });
        }
        // alert(); 
    });
    // layer.msg('极客物联网！',{ shade:0.5,time:1000});
    });
</script>
</html>