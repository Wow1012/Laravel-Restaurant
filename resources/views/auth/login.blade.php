<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{setting_by_key('title')}} | Login</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="login-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <p></p>
            <form class="m-t" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="form-group">
                     <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
					  @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control" value="12345678" name="password">
					@if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

              
              
               
            </form>
            <p class="m-t"> <small>{{setting_by_key('title')}}  &copy; {{date("Y")}}</small> </p>
        </div>
    </div>

</body>

</html>
