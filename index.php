<?php
include "./public/header.php";
//phpinfo();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>  
<body>
<main style="background-color: white">

    <div class="jumbotron">
        <div class="container text-center">
            <h1>智能物联网</h1>
            <p>微信小程序已正式上线，手机远程控制，蓝牙遥控，各种发烧功能尽在其中，小程序搜索'极客物联网'...</p>
        </div>
    </div>

<script type="text/javascript">
     function btnclick() {
                             $.ajax({
                            type: "POST",
                            url: "getpicture.php",
                            data:"",
                            success: function(msg){
                            // console.log(msg);
                             $("#img_a").attr("src", msg); 
                        }
                    });
                              
                } 

      // window.setInterval(showalert,200 ); 
    function showalert() 
    { 
       btnclick();
    } 
</script>



    <!-- <div style="text-align: center; font-size: 38px"> -->
    <!-- <div>图片拉取测试</div> -->
        <!-- <div><button onclick="btnclick()">拉取</button></div> -->
        
        <!-- <textarea id="txt"></textarea> -->
        <!-- <div><img src="" id="img_a" style="border:#000 1px solid; width: 640px;height: 360px;"></div> -->
    <!-- </div> -->




    <div class="container-fluid bg-3 text-center" >
        <h3>Some of my Work</h3><br>
        <div class="row">
            <div class="col-sm-3">
                <p>物联网开发板</p>
                <img src="img/1.jpg?text=Smtvoice" class="img-responsive" style="width:100%;border: rgb(2550,0,0);" alt="Image">
            </div>
            <div class="col-sm-3 box-shadow">
                <p>集成电路</p>
                <img src="img/2.jpg?text=Smtvoice" class="img-responsive" style="width:100%" alt="Image">
            </div>
            <div class="col-sm-3">
                <p>Arduino</p>
                <img src="img/3.jpg?text=Smtvoice" class="img-responsive" style="width:100%" alt="Image">
            </div>
            <div class="col-sm-3 box-shadow">
                <p>麦克纳姆智能监控</p>
                <img src="img/4.jpg?text=Smtvoice" class="img-responsive" style="width:100%" alt="Image">
            </div>
        </div>
    </div><br>

    <div class="container-fluid bg-3 text-center">
        <div class="row">
            <div class="col-sm-3 box-shadow">
                <p>多足监控机器人</p>
                <img src="img/5.jpg?text=Smtvoice" class="img-responsive" style="width:100%" alt="Image">
            </div>
            <div class="col-sm-3">
                <p>轮形监控</p>
                <img src="img/6.jpg?text=Smtvoice" class="img-responsive" style="width:100%" alt="Image">
            </div>
            <div class="col-sm-3 box-shadow">
                <p>智能手套</p>
                <img src="img/7.jpg?text=Smtvoice" class="img-responsive" style="width:100%" alt="Image">
            </div>
            <div class="col-sm-3">
                <p>探月车</p>
                <img src="img/8.jpg?text=Smtvoice" class="img-responsive" style="width:100%" alt="Image">
            </div>
        </div>
    </div>
   </main>
</body>
</html>
<?php include './public/footer.php';?>
