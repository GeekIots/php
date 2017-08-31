<?php
include "./public/header.php";
//phpinfo();
?>

<html>  
    <body>  
      
    <textarea rows="10" cols="20" id="my" onscroll="myFunction()">  
    </textarea>  
    <textarea rows="10" cols="20" id="my2" onscroll="myFunction2()">  
    </textarea> 
      
    <button onClick="test()"  >test</button>  
    <button onClick="test2()" >test</button>  
    <script>  
      
    var i = 1;  
    function test()  
    {  
        var obj = document.getElementById("my");  
        obj.value += i +'-'+obj.scrollHeight+ "\n";  
        i++;  
        obj.scrollTop = obj.scrollHeight; // good  
        console.log(obj.scrollHeight);
        var obj2 = document.getElementById("my2");
        obj2.value = obj.value;
        obj2.scrollTop = obj.scrollHeight;
    }  
    function test2()  
    {  
        var obj = document.getElementById("my");  
        obj.scrollTop = obj.scrollHeight/2; // good  
    }  

    function myFunction()  
    {  
        var obj = document.getElementById("my");  
        var obj2 = document.getElementById("my2");
         console.log('obj1:',obj.scrollTop);
        console.log('obj2:',obj2.scrollTop);
        obj2.scrollTop = obj.scrollTop;
    }  
    function myFunction2()  
    {  
        var obj = document.getElementById("my");  
        var obj2 = document.getElementById("my2");
        console.log('obj1:',obj.scrollTop);
        console.log('obj2:',obj2.scrollTop);
        obj.scrollTop = obj2.scrollTop;
    }  
    </script>  
      
    </body>  
    </html>  