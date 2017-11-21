<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Summernote</title>
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
</head>
<body>
  <div id="summernote"><p>Hello Summernote</p></div>
  <button onclick="get()">获取</button>
  <script>
    // $(document).ready(function() {
    //     $('#summernote').summernote();
    // });

    $(document).ready(function() {  
        $('#summernote').summernote({  
            height: "500px",  
            callbacks: {  
                onImageUpload: function(files) { //the onImageUpload API  
                    img = sendFile(files[0]);  
            }  
        }  
        });  
    });  
      
    function sendFile(file) {  
        data = new FormData();  
        data.append("file", file);
        data.append("type", 'blog');
        data.append("userid", '1509639203636');
        data.append("blogid", '1510759201848');
        console.log(data);  
        $.ajax({  
            data: data,  
            type: "POST",  
            url: "/api/upload/upload.img.php",  
            cache: false,  
            contentType: false,  
            processData: false,  
            success: function(url) {
              if (url.code==0) {
                $("#summernote").summernote('insertImage', url.data.src, 'image name'); // the insertImage API  
              }  
              else
              {
                console.log(url.msg);
              }
            }  
        });  
    }  

    function get(argument) {
       var markupStr = $('#summernote').summernote('code');
       console.log(markupStr);
     } 
    
  </script>
</body>
</html>