<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ admin_asset('vendor/laravel-login/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ admin_asset('vendor/laravel-login/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ admin_asset('vendor/laravel-login/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ admin_asset('vendor/laravel-login/css/style.css') }}">
    @if (!is_null($favicon = Admin::favicon()))
        <link rel="shortcut icon" href="{{ $favicon }}">
    @endif
    <title>Login #7</title>
</head>

<body>



    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    @if (config('admin.login_background_image'))
                        <img src="{{ config('admin.login_background_image') }}" alt="Image" class="img-fluid">
                    @endif

                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">

                            <div class="mb-4">
                                <img src="/assets/img/telkom_indonesia_logo.png" alt="Image" class="right img-fluid"
                                    width="120">
                                <h3>Sign In Monica</h3>

                            </div>
                            <form action="{{ admin_url('auth/login') }}" method="post">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group has-feedback {!! !$errors->has('username') ?: 'has-error' !!}">

                                    @if ($errors->has('username'))
                                        @foreach ($errors->get('username') as $message)
                                            <label class="control-label" for="inputError"><i
                                                    class="fa fa-times-circle-o"></i>{{ $message }}</label><br>
                                        @endforeach
                                    @endif

                                    <input type="text" class="form-control"
                                        placeholder="{{ trans('admin.username') }}" name="username"
                                        value="{{ old('username') }}">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback {!! !$errors->has('password') ?: 'has-error' !!}">

                                    @if ($errors->has('password'))
                                        @foreach ($errors->get('password') as $message)
                                            <label class="control-label" for="inputError"><i
                                                    class="fa fa-times-circle-o"></i>{{ $message }}</label><br>
                                        @endforeach
                                    @endif

                                    <input type="password" class="form-control"
                                        placeholder="{{ trans('admin.password') }}" name="password">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                              
                                    <div class="col-xs-8">
                                        @if (config('admin.auth.remember'))
                                            <div class="checkbox icheck">
                                                <label >
                                                    <input type="checkbox" name="remember" value="1"
                                                        {{ !old('username') || old('remember') ? 'checked' : '' }}>
                                                    {{ trans('admin.remember_me') }}
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- /.col -->
                      

                                

                                <input type="submit" value="Log In" class="btn btn-block btn-primary">


                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <script src="{{ admin_asset('vendor/laravel-login/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ admin_asset('vendor/laravel-login/js/popper.min.js') }}"></script>
    <script src="{{ admin_asset('vendor/laravel-login/js/bootstrap.min.js') }}"></script>
    <script src="{{ admin_asset('vendor/laravel-login/js/main.js') }}"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
</body>

</html>
