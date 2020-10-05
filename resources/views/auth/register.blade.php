
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Website | Register</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('assets/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('assets/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('assets/css/AdminLTE.min.css') }}">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Register</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <form method="POST" action="{{ route('register') }}">
      @csrf       
      <div class="form-group has-feedback">
        <label>Name</label>
        <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

          @error('name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label>Email</label>
        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <label>Mobile Number</label>
        <input id="mobile_number" type="text" placeholder="Mobile Number" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number') }}" required autocomplete="mobile_number">

          @error('mobile_number')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <label>Password</label>
        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <label>Conform-Password</label>
        <input id="password-confirm" type="password" placeholder="Conform-Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <label>Gender</label>
        <div class="form-group">
          <div class="radio">
            <label>
              <input type="radio" name="gender" id="male" value="male" checked="">
              Male
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="gender" id="female" value="female">
              Fe-Male
            </label>
          </div>
        </div>
      </div>

      <div class="form-group has-feedback">
        <label>Address</label>
        <textarea class="form-control" placeholder="Address" name="address" id="address" required>{{ old('address') }}</textarea>
      </div>

      <div class="form-group has-feedback">
        <label>City</label>
        <input id="city" type="text" placeholder="City" class="form-control" name="city" required value="{{ old('city') }}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <div class="col-lg-6">
          <a href="{{ route('login') }}"><button type="button" class="btn btn-primary btn-block btn-flat pull-right">Login</button></a>
        </div>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ url('assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
</body>
</html>
