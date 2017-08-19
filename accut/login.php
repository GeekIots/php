<!-- <?php 
// include "../public/header.php";
 ?> -->
<!DOCTYPE html>
<html lang="zh" class="no-js">
    <head>
        <title>用户登陆</title>
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/component.css" />
    </head>
    <body>
        <div style="margin: 0 auto;text-align: center;overflow: hidden;" >
            <header class="codrops-header">
                <h1>极客物联网 <span>让远程控制变得如此简单！</span></h1>
            </header>

            <section style="background: #2f3238; color: #fff; ">
                <div >
                    <span class="input input--akira">
                            <input class="input__field input__field--akira" type="text" id="username" name="username" />
                            <label class="input__label input__label--akira" for="input-22">
                                <span class="input__label-content input__label-content--akira">用户名</span>
                            </label>
                    </span>                
                </div>
                <div>
                    <span class="input input--akira">
                    <input class="input__field input__field--akira" type="password" id="password" name="password"/>
                    <label class="input__label input__label--akira" for="input-22">
                        <span class="input__label-content input__label-content--akira">密码</span>
                    </label>
                    </span>                
                </div>            
                 <div  >
                     <!-- <input type="button" /> -->
                     <button id="btn" class="btn btn-primary" style=" height: 50px;width: 200px;margin-bottom: 20px;background-color:gray;border-style: solid;border-width: 1px;">
                         登陆
                     </button>
                </div>
            </section>                
        </div>
    </body>
</html>
<script src="js/classie.js"></script>
<script src="../js/jquery.min.js"></script>
<script>
    // 界面
    (function() {
        if (!String.prototype.trim) {
            (function() {
                // Make sure we trim BOM and NBSP
                var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                String.prototype.trim = function() {
                    return this.replace(rtrim, '');
                };
            })();
        }

        [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
            // in case the input is already filled..
            if( inputEl.value.trim() !== '' ) {
                classie.add( inputEl.parentNode, 'input--filled' );
            }

            // events:
            inputEl.addEventListener( 'focus', onInputFocus );
            inputEl.addEventListener( 'blur', onInputBlur );
        } );

        function onInputFocus( ev ) {
            classie.add( ev.target.parentNode, 'input--filled' );
        }

        function onInputBlur( ev ) {
            if( ev.target.value.trim() === '' ) {
                classie.remove( ev.target.parentNode, 'input--filled' );
            }
        }
    })();
</script>

<script>
    $(document).ready(function(){
        // 监控文本框变化事件，动态提示用户信息是否正确
        $("#username").change('input',function(e){  
               var result1 = $("#username").val();
               console.log(result1);
            });
        $("#password").change('input',function(e){  
           var result1 = $("#password").val();
           console.log(result1);
        }); 
        $("#btn").click(function(){
        var inputFlag = true;
        var username = $("#username").val();
        var password = $("#password").val();
        if (!username) {
            console.log('用户名不能为空！');
            alert('用户名不能为空！');
            inputFlag = false;
        }
        else if (!password) {
            console.log('密码不能为空！');
            alert('密码不能为空！');
            inputFlag = false;
        }
        if (inputFlag) {
            $.getJSON("<?php echo $_SERVER['localhost'] ?>/api/login.php?username="+username+"&password="+password, function(json){
             // console.log(json);/** 打印对像**/
             if (json.status=="success") {
                console.log('登录成功');
                // alert('登录成功！');
                // history.go(-1);
                // location.reload();
                // 跳转到首页
                window.location.href="<?php echo $_SERVER['localhost'] ?>/index.php"; 
             }
             else{
                console.log('登录失败:',json.error);
                alert(json.error);
             }
                
            }); 
        }
        });
    }); 
</script>