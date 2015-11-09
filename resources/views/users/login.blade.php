<!doctype html>
<html>
<head>
  <title>Look at me Login</title>
</head>
<body>

{!! Form::open(array('url' => 'login')) !!}
  <h1>Login</h1>

  <!-- if there are login errors, show them here -->
  <p>
      {!! $errors->first('email') !!}
      {!! $errors->first('password') !!}
  </p>

  <p>
      {!! Form::label('email', 'Email Address') !!}
      {!! Form::text('email', NULL, array('placeholder' => 'babies@uatu.com')) !!}
  </p>

  <p>
      {!! Form::label('password', 'Password') !!}
      {!! Form::password('password') !!}
  </p>

  <p>{!! Form::submit('Log In') !!}</p>
{!! Form::close() !!}

</body>
</html>
