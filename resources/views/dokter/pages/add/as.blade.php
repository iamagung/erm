    <?php
    switch ($id) {
        case '1':
            $judul = 'Diagnosa';
            break;
        case '2':
            $judul = 'ICD 10';
            break;
        case '3':
            $judul = 'Obat-obatana';
            break;
        case '4':
            $judul = 'ICD 9';
            break;
        case '5':
            $judul = 'Anamnesis';
            break;
        case '6':
            $judul = 'Rencana dan Terapi';
            break;
        case '7':
            $judul = 'Pemeriksaan Fisik';
            break;

        default:
            $judul = '';
            break;
    }
    ?>

    @php
        $link = asset('adminAsset/ilustrasi.jpg');
        $namaPoli = Auth::User()->namaPoli;
        if(str_contains(strtolower($namaPoli), 'mata')){
            $link = asset('adminAsset/mata.png');
        } else if(str_contains(strtolower($namaPoli), 'tht')){
            $link = asset('adminAsset/tht.jpg');
        } else if(str_contains(strtolower($namaPoli), 'gigi')){
            $link = asset('adminAsset/gigi.jpg');
        }
    @endphp

    <html>
    <script src="{!!  asset('adminAsset/js/jquery-1.9.1.min.js') !!}" type="text/javascript"></script>
    <script type="text/javascript">
    var canvas, ctx, flag = false,
        prevX = 0,
        currX = 0,
        prevY = 0,
        currY = 0,
        dot_flag = false;

    var x = "black",
        y = 2;

    function init() {
        canvas = document.getElementById('can');
        ctx = canvas.getContext("2d");
        w = canvas.width;
        h = canvas.height;
        base_image = new Image();
        base_image.src = "{{$link}}";
        base_image.width = "10px";
        base_image.height = "10px";
        base_image.onload = function(){
            ctx.drawImage(base_image, 0, 0, w, h);
        }

        canvas.addEventListener("mousemove", function (e) {
            findxy('move', e)
        }, false);
        canvas.addEventListener("mousedown", function (e) {
            findxy('down', e)
        }, false);
        canvas.addEventListener("mouseup", function (e) {
            findxy('up', e)
        }, false);
        canvas.addEventListener("mouseout", function (e) {
            findxy('out', e)
        }, false);
    }

    function color(obj) {
        switch (obj.id) {
            case "green":
                x = "green";
                break;
            case "blue":
                x = "blue";
                break;
            case "red":
                x = "red";
                break;
            case "yellow":
                x = "yellow";
                break;
            case "orange":
                x = "orange";
                break;
            case "black":
                x = "black";
                break;
            case "white":
                x = "white";
                break;
        }
        if (x == "white") y = 14;
        else y = 2;

    }

    function draw() {
        ctx.beginPath();
        ctx.moveTo(prevX, prevY);
        ctx.lineTo(currX, currY);
        ctx.strokeStyle = x;
        ctx.lineWidth = y;
        ctx.stroke();
        ctx.closePath();
    }

    function erase() {
        var m = confirm("Want to clear");
        if (m) {
            ctx.clearRect(0, 0, w, h);
            document.getElementById("canvasimg").style.display = "none";
        }
    }

    function dataURItoBlob(dataURI) {
        // convert base64/URLEncoded data component to raw binary data held in a string
        var byteString;
        if (dataURI.split(',')[0].indexOf('base64') >= 0)
            byteString = atob(dataURI.split(',')[1]);
        else
            byteString = unescape(dataURI.split(',')[1]);

        // separate out the mime component
        var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

        // write the bytes of the string to a typed array
        var ia = new Uint8Array(byteString.length);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }

        return new Blob([ia], {type:mimeString});
    }

    function save() {
        document.getElementById("canvasimg").style.border = "2px solid";
        var dataURL = canvas.toDataURL("image/png", 0.5);
        document.getElementById("canvasimg").src = dataURL;
        document.getElementById("canvasimg").style.display = "inline";

        // var dt = dataURL.replace(/^data\:image\/\w+\;base64\,/, '');

        // var dataURL = canvas.toDataURL('image/png', 0.5);
        // var blob = dataURItoBlob(dataURL);
        // var fd = new FormData(document.forms[0]);
        // fd.append("gambar", blob);

        $('#isiGambar').val(dataURL);
        $('#hasil').show();
    }

    function findxy(res, e) {
        if (res == 'down') {
            prevX = currX;
            prevY = currY;
            currX = e.clientX - canvas.offsetLeft;
            currY = e.clientY - canvas.offsetTop;

            flag = true;
            dot_flag = true;
            if (dot_flag) {
                ctx.beginPath();
                ctx.fillStyle = x;
                ctx.fillRect(currX, currY, 2, 2);
                ctx.closePath();
                dot_flag = false;
            }
        }
        if (res == 'up' || res == "out") {
            flag = false;
        }
        if (res == 'move') {
            if (flag) {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvas.offsetLeft;
                currY = e.clientY - canvas.offsetTop;
                draw();
            }
        }
    }
    </script>
    <body onload="init()">
        <h3>{!! $judul !!}</h3>
        <canvas id="can" width="400" height="400" style="position:absolute;top:10%;left:3%;border:2px solid;"></canvas>
        <div style="position:absolute;top:10%;left:43%;">Choose Color</div>
        <div style="position:absolute;top:15%;left:45%;width:10px;height:10px;background:green;" id="green" onclick="color(this)"></div>
        <div style="position:absolute;top:15%;left:46%;width:10px;height:10px;background:blue;" id="blue" onclick="color(this)"></div>
        <div style="position:absolute;top:15%;left:47%;width:10px;height:10px;background:red;" id="red" onclick="color(this)"></div>
        <div style="position:absolute;top:17%;left:45%;width:10px;height:10px;background:yellow;" id="yellow" onclick="color(this)"></div>
        <div style="position:absolute;top:17%;left:46%;width:10px;height:10px;background:orange;" id="orange" onclick="color(this)"></div>
        <div style="position:absolute;top:17%;left:47%;width:10px;height:10px;background:black;" id="black" onclick="color(this)"></div>
        <div style="position:absolute;top:18%;left:43%;">Eraser</div>
        <div style="position:absolute;top:22%;left:45%;width:15px;height:15px;background:white;border:2px solid;" id="white" onclick="color(this)"></div>
        <input type="button" value="save" id="btn" size="30" onclick="save()" style="position: absolute;top:30%;left:40%;">
        <input type="button" value="clear" id="clr" size="23" onclick="erase()" style="position: absolute;top:30%;left:45%;">
        <img id="canvasimg" style="position:absolute;top:10%;left:52%;" style="display:none;">
        <div id="hasil" style="text-align: center;display: none;position: absolute;top: 60%">
            <form method="post" action="{!! url('rekap_medik/simpanP1/'.$id) !!}" enctype="multipart/form-data">
                <input type="hidden" id="isiGambar" name="gambar" value="">
                <input type="hidden" name="id" value="{!! $id !!}">
                <input type="submit" value="Kirim">
            </form>
        </div>
    </body>
    </html>
