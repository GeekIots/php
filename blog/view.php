<!DOCTYPE html>
<html>
<head>
  <title>开发者社区 | 极客物联网 </title>
  <link rel="stylesheet" type="text/css" href="https://res.wx.qq.com/c/=/wxopenforumres/htmledition/style/widget/colorpicker/colorpicker3793d0.css,/wxopenforumres/htmledition/style/biz_web/widget/dropdown3793d0.css,/wxopenforumres/htmledition/style/widget/upload3793d0.css,/wxopenforumres/htmledition/style/widget/ueditor_new/codemirror/codemirror3793d0.css,/wxopenforumres/htmledition/style/widget/tooltip3793d0.css,/wxopenforumres/htmledition/style/widget/ueditor_new/themes/default/css/ueditor3793d0.css,/wxopenforumres/htmledition/style/widget/ueditor_new/themes/default/ueditor3793d0.css,/wxopenforumres/htmledition/style/widget/pagination3793d0.css" />
  <link rel="stylesheet" type="text/css" href="https://res.wx.qq.com/wxopenforumres/htmledition/style/base/lib3793d0.css"/>
  <link rel="stylesheet" href="https://res.wx.qq.com/wxopenforumres/htmledition/style/page/discussion/detail3793d0.css" media="all">
</head>
<body class="zh_CN">
    <?php include('header.php'); ?>
    <?php include("conn.php");
        if(!empty($_GET['id']))
        { 
          $sql="select * from blog where id='".$_GET['id']."'";
          $query=mysql_query($sql);
          $rs=mysql_fetch_array($query);

          //增加点击量
          $sql="update blog  set hits = hits+1 where id='".$_GET['id']."'";
          mysql_query($sql);

          //获取回复
          $sqlanswer="select count(*) from bloganswer where toid='".$rs['id']."'";
          $queryanswer=mysql_query($sqlanswer);
          $answernum=mysql_fetch_array($queryanswer)[0];

          $sqlanswer="select * from bloganswer where toid='".$rs['id']."'";
          $queryanswer=mysql_query($sqlanswer);
        }
    ?>
  <div id="body" class="body page_simple " style="min-height: 257px;background: white;">
    <div class="container_box">
        <div class="post_detail">
            <div class="post_overview">
                <!-- 帖子标题 -->
                <h4 class="post_title">
                    <?php echo $rs['title']?>
                </h4>
                <div class="post_info">
                    <!-- 发帖人 -->
                    <strong class="post_owner post_info_meta"><?php echo $rs['userid']?></strong>
                    <!-- 发帖时间 -->
                    <em id="create_time" class="post_time post_info_meta"><?php echo $rs['dates']?></em>
                    <!-- 标签，分类 -->
                    <span class="post_tags post_info_meta">
                        <a class="post_tag" href="/blog/index.php">STM32</a>
                    </span>
                    <!-- 回复数 -->
                    <span class="js_comment_num_frame post_discuss_num post_info_meta"><i class="icon_post_opr discuss"></i><span id="comment_num"><?php echo $answernum; ?></span></span>
                </div>
            </div>
            <!-- 正文 -->
            <div id="content" class="post_content">
                <p><?php echo htmlspecialchars_decode($rs['contents']);?></p>
            </div>
            <!-- 更新时间 -->
            <div class="post_extra_info">
                <div class="js_updatetime post_tips" style="">最后一次编辑于&nbsp;&nbsp;<span id="update_time"><?php echo $rs['dates']?></span></div>
                <div class="post_opr">
                    <a style="" id="comment_btn" class="post_opr_meta" href="javascript:;"><i class="icon_post_opr discuss"></i>评论</a>
                </div>
            </div>
            <!-- 回复 -->
            <ul id="comment_list" class="post_comment_list">
                <?php 
                // 计算楼层
                $floornumber = 0;
                while ($rsanswer=mysql_fetch_array($queryanswer)) {
                    $floornumber++;
                    echo '<li class="js_comment_floor_1 js_post_comment_item post_comment_item">
                    <span class="post_comment_owner">
                        <!-- 用户头像 -->
                        <img class="post_comment_owner_avatar" src="https://wx.qlogo.cn/mmhead/Q3auHgzwzM4RcfSy6x6rIzX3GRgRhJA03hwHfzgsQibUwBXwJ47ybXA/0" alt="孙毅明">
                        <!-- 昵称 -->
                        <strong class="post_comment_owner_nickname">',$rs["userid"],'</strong>
                    </span>
                    <!-- 回复正文 -->
                    <div class="post_comment_content">
                        <p>',htmlspecialchars_decode($rsanswer['contents']),'</p>
                    </div>
                    <div class="post_comment_info">
                        <!-- 回复时间 -->
                        <span class="post_comment_time">',$rsanswer["dates"],'</span>
                        <span class="post_comment_opr">
                            <a class="js_delete_comment post_opr_meta" data-comment-id="b8e044ba0e81dd7498d7c085c8579897"><i class="icon_post_opr delete"></i>删除</a>
                            <a class="js_comment post_opr_meta" style="display:none;"><i class="icon_post_opr discuss"></i>评论</a>
                        </span>
                        <!-- 回复楼层 -->
                        <span class="post_comment_pos">',$floornumber,'楼</span>
                    </div>
                </li>';
            }
            ?>
            </ul>
            <!-- 回复编辑区 -->
            <div id="editorframe" class="post_comment_editor_area post_comment_item with_post_editor" style="">
                <span class="post_comment_owner">
                    <img class="post_comment_owner_avatar" src="https://wx.qlogo.cn/mmhead/Q3auHgzwzM4RcfSy6x6rIzX3GRgRhJA03hwHfzgsQibUwBXwJ47ybXA/0" alt="孙毅明">
                    <strong class="post_comment_owner_nickname">孙毅明</strong>
                </span>
                <div class="post_comment_content post_editor_box">
                    <!-- 正文 -->
                    <div class="editor_area edui-default">
                       <textarea id="demo" class="layui-textarea" style="display: none;"></textarea>
                        <!-- 回复按钮 -->
                        <div class="edui-editor-bottomContainer tool_bar tr edui-default">
                            <button class="layui-btn site-demo-layedit" data-type="content">回复</button>
                        </div>
                        <script>
                            //由于模块都一次性加载，因此不用执行 layui.use() 来加载对应模块，直接使用即可：
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
                            $('.site-demo-layedit').on('click', function(){
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
                                        data:{'data':str,'userid':'sun','toid':<?php echo($_GET['id']) ?>},
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
                            layer.msg('极客物联网！',{ shade:0.5,time:1000});
                          });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
<?php include('footer.php') ?>
</body>

</html>

