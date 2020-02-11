<!doctype html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>LikeBK.com - Переодевалка</title>
    <style>
    /* a style sheet needs to be present for cursor hiding and custom cursors to work. */
        * {
            margin: 0;
            padding: 0;
        }

        canvas {
            width: 100%;
            height: 100%;
            position: absolute;
        }
    </style>
  </head>
  <body>
    <div style="background-color:rgba(0,0,0,.8);height:100%;position:fixed;width:100%;top:0;left:0;">
        <div style="color: #fff; font-size: 18px;width: 200px; left: 50%; margin-left: -100px; top:20%; position: absolute; z-index: 0;">
            <center>
                Идет загрузка...<br>
                <img width="120" src="roomdressing/AjaxLoader2.gif">
            </center>
        </div>
    </div>
    <canvas class="emscripten" id="canvas" oncontextmenu="event.preventDefault()" height="800px" width="1600px"></canvas>
    <script type='text/javascript'>
  var Module = {
    TOTAL_MEMORY: 268435456,
    errorhandler: null,			// arguments: err, url, line. This function must return 'true' if the error is handled, otherwise 'false'
    compatibilitycheck: null,
    dataUrl: "roomdressing/002070616.data",
    codeUrl: "roomdressing/002070616.js",
    memUrl: "roomdressing/002070616.mem",
  };
</script>
<script src="roomdressing/UnityLoader.js"></script>

  </body>
</html>
