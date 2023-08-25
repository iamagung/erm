<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="https://www.rsuwahidinmojokerto.com/assets/images/logo.png"/>
    <link rel="shortcut icon" href="https://www.rsuwahidinmojokerto.com/assets/images/logo.png" />
    <title>Login | {{ config('app.name', 'Laravel') }}</title>
    <style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

    * {
        box-sizing: border-box;
    }

    body {
        background: #f6f5f7;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-family: 'Montserrat', sans-serif;
        height: 100vh;
        margin: -20px 0 50px;
    }

    h1 {
        font-weight: bold;
        margin: 0;
    }

    h2 {
        text-align: center;
    }

    p {
        font-size: 14px;
        font-weight: 100;
        line-height: 20px;
        letter-spacing: 0.5px;
        margin: 20px 0 30px;
    }

    span {
        font-size: 12px;
    }

    a {
        color: #333;
        font-size: 14px;
        text-decoration: none;
        margin: 15px 0;
    }

    #btn-login {
        border-radius: 20px;
        border: 1px solid #235F13;
        background-color: #235F13;
        color: #FFFFFF;
        font-size: 12px;
        font-weight: bold;
        padding: 12px 45px;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: transform 80ms ease-in;
    }

    #btn-login:active {
        transform: scale(0.95);
    }

    #btn-login:focus {
        outline: none;
    }

    #btn-login.ghost {
        background-color: transparent;
        border-color: #FFFFFF;
    }

    form {
        background-color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 50px;
        height: 100%;
        text-align: center;
    }

    input {
        background-color: #eee;
        border: none;
        padding: 12px 15px;
        margin: 8px 0;
        width: 100%;
    }

    .container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25),
                0 10px 10px rgba(0,0,0,0.22);
        position: relative;
        overflow: hidden;
        width: 768px;
        max-width: 100%;
        min-height: 480px;
    }

    .form-container {
        position: absolute;
        top: 0;
        height: 100%;
        transition: all 0.6s ease-in-out;
    }

    .sign-in-container {
        left: 0;
        width: 50%;
        z-index: 2;
    }

    .container.right-panel-active .sign-in-container {
        transform: translateX(100%);
    }

    .sign-up-container {
        left: 0;
        width: 50%;
        opacity: 0;
        z-index: 1;
    }

    .container.right-panel-active .sign-up-container {
        transform: translateX(100%);
        opacity: 1;
        z-index: 5;
        animation: show 0.6s;
    }

    @keyframes show {
        0%, 49.99% {
            opacity: 0;
            z-index: 1;
        }

        50%, 100% {
            opacity: 1;
            z-index: 5;
        }
    }

    .overlay-container {
        position: absolute;
        top: 0;
        left: 50%;
        width: 50%;
        height: 100%;
        overflow: hidden;
        transition: transform 0.6s ease-in-out;
        z-index: 100;
    }

    .container.right-panel-active .overlay-container{
        transform: translateX(-100%);
    }

    .overlay {
        background: #235F13;
        background: -webkit-linear-gradient(to right, #235F13, #235F13);
        background: linear-gradient(to right, #e3ffdc, #47ad2c);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 0 0;
        color: #FFFFFF;
        position: relative;
        left: -100%;
        height: 100%;
        width: 200%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .container.right-panel-active .overlay {
        transform: translateX(50%);
    }

    .overlay-panel {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 40px;
        text-align: center;
        top: 0;
        height: 100%;
        width: 50%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .overlay-left {
        transform: translateX(-20%);
    }

    .container.right-panel-active .overlay-left {
        transform: translateX(0);
    }

    .overlay-right {
        right: 0;
        transform: translateX(0);
    }

    .container.right-panel-active .overlay-right {
        transform: translateX(20%);
    }

    .social-container {
        margin: 20px 0;
    }

    .social-container a {
        border: 1px solid #DDDDDD;
        border-radius: 50%;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        margin: 0 5px;
        height: 40px;
        width: 40px;
    }

    </style>
  <link rel="stylesheet" href="{{ asset('assetsLogin/css/fontawesome-all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assetsLogin/css/jquery-ui.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assetsLogin/css/perfect-scrollbar.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assetsLogin/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assetsLogin/css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('assetsLogin/css/util.css') }}">
  <link rel="stylesheet" href="{{ asset('assetsLogin/css/custom.css') }}">


</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form class="form-login" method="POST" action="{{ route('dologin') }}">
                {{ csrf_field() }}
                <h1 style="margin-bottom: 10px">Login</h1>
                <label for="email" class="col-md-4 control-label">Username</label>
                <input id="email" type="text" autocomplete="off" class="form-control" name="email" placeholder="insert username ..." value="{{ old('email') }}" required autofocus>
                <label for="password" class="col-md-4 control-label">Password</label>
                <input id="password" type="password" autocomplete="off" autocomplete="off" class="form-control" name="password" placeholder="insert password ..." required>
                <button type="submit" type="button" style="margin-top: 10px" value="Sign In" class="btn btn-primary">Login</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">

                <div class="overlay-panel overlay-right">
                    <img src="https://www.rsuwahidinmojokerto.com/assets/images/logo.png" class="img-responsive" style="width: 85px"></br>
                    <span style="font-weight: 900px;font-size: 35px;">E-Rekam Medis</span>
                    <span>RSUD dr. WAHIDIN SUDIROHUSODO MOJOKERTO</span>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2021 Development by <a href="http://natusi.co.id" target='_blank'><i>CV. Natusi</i></a></p>

    </footer>

    <script src="{{ asset('assetsLogin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assetsLogin/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assetsLogin/js/jquery.maskMoney.js') }}"></script>
    <script src="{{ asset('assetsLogin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assetsLogin/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assetsLogin/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assetsLogin/js/raphael.min.js') }}"></script>
    <script src="{{ asset('assetsLogin/js/horizontal-timeline.min.js') }}"></script>
    <script src="{{ asset('assetsLogin/js/main.js') }}"></script>
    <script src="{{ asset('assetsLogin/js/animate.js') }}"></script>

    <script type="text/javascript">
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

         @if(!empty(Session::get('message')))
            swal({
              title : "{{ Session::get('title') }}",
              text : "{{ Session::get('message') }}",
              type : "{{ Session::get('type') }}",
              timer: 2000,
              showConfirmButton: false
            });
          @endif
    </script>
</body>
</html>
