<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="text/css" href="{{asset('admin_theme/icon/sinhas-icon.webp')}}">

    <title>SINHAS MULTICOLLECTION! | </title>

    <!-- Bootstrap -->
    <link href="{{asset('admin_theme/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('admin_theme/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('admin_theme/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('admin_theme/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('admin_theme/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            @if ($errors->any())
              <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach   
              </div>
            @endif
            <form action="{{route('admin.makeLogin')}}" method="post">
              <h1>Login Form</h1>
              @csrf
              <div>
                <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email')}}"  />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" value="{{old('password')}}" />
              </div>
              <div>
                <input type="submit" name="">
              </div>

            </form>
          </section>
        </div>

      </div>
  </body>
</html>
