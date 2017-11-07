<script type="text/javascript">
           function showImg(url) {
               var frameid = 'frameimg' + Math.random();
               window.img = '<img id="img" src=\'' + url + '?' + Math.random() + '\' /><script>window.onload = function() { parent.document.getElementById(\'' + frameid + '\').height = document.getElementById(\'img\').height+\'px\'; }<' + '/script>';
               document.write('<iframe id="' + frameid + '" src="javascript:parent.img;" frameBorder="0" scrolling="no" width="100%"></iframe>');
           }
       </script>
       <h1>直接盗链：</h1>
       <br>
      <img src="http://c.hiphotos.baidu.com/image/pic/item/b64543a98226cffc1c267e62b3014a90f703ead6.jpg" /><br>
      <h1>js破解盗链：</h1>
      <br>
      <div id="hotlinking">
          <script type="text/javascript">showImg('http://c.hiphotos.baidu.com/image/pic/item/b64543a98226cffc1c267e62b3014a90f703ead6.jpg');</script>
      </div>