<!DOCTYPE html>
<html>
<head>
  <title>Uatu</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
  <style>
    body {
      padding-top: 70px;
    }
    .form-signin {
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
    }
    .form-signin .form-signin-heading {
      margin-bottom: 10px;
    }
    .form-signin .form-control {
      position: relative;
      height: auto;
      padding: 10px;
      font-size: 16px;
    }
  </style>
</head>
<body>
<div class="container">

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('messages') }}">Uatu</a>
      </div>
    </div>
  </nav>
  <!-- will be used to show any messages -->
  @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif

  @yield('content')

  {!! Form::open(array('url' => 'login', 'class' => 'form-signin')) !!}
    <h1>Login</h1>

    <div class="form-group">
      {!! Form::label('email', 'Email Address', array('class' => 'sr-only')) !!}
      {!! Form::text('email', NULL, array('placeholder' => 'Email', 'class' => 'form-control')) !!}
    </div>

    <div class="form-group">
      {!! Form::label('password', 'Password', array('class' => 'sr-only')) !!}
      {!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) !!}
    </div>

    <p>{!! Form::submit('Log In', array('class' => 'btn btn-primary')) !!}</p>
  {!! Form::close() !!}
</div>
</body>
</html>
