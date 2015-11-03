<!DOCTYPE html>
<html>
<head>
  <title>Uatu - Create a message</title>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
  <div class="navbar-header">
    <a class="navbar-brand" href="{{ URL::to('messages') }}">Messages</a>
  </div>
  <ul class="nav navbar-nav">
    <li><a href="{{ URL::to('messages') }}">View All Messages</a></li>
    <li><a href="{{ URL::to('messages/create') }}">Create a Message</a>
  </ul>
</nav>

<h1>Create a Message</h1>

<!-- if there are creation errors, they will show here -->
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

{!! Form::open(array('url' => 'messages')) !!}

  <div class="form-group">
    {!! Form::label('type', 'Type') !!}
    {!! Form::select('type', array('regex' => 'Regex', 'phrase' => 'Phrase','word' => 'Word'), NULL, array('class' => 'form-control')) !!}
  </div>

  <div class="form-group">
    {!! Form::label('message', 'Message') !!}
    {!! Form::text('message', NULL, array('class' => 'form-control')) !!}
  </div>

  <div class="form-group">
    {!! Form::label('short_term', 'Short Term Response(s)') !!}
    {!! Form::text('short_term', NULL, array('class' => 'form-control')) !!}
  </div>

  <div class="form-group">
    {!! Form::label('long_term', 'Long Term Response(s)') !!}
    {!! Form::text('long_term', NULL, array('class' => 'form-control')) !!}
  </div>

  <div class="form-group">
    {!! Form::label('exact', 'Needs to be exact') !!}
    {!! Form::checkbox('exact', true, array('class' => 'form-control')) !!}
  </div>

  <div class="form-group">
    {!! Form::label('has_sentiment', 'Message has sentiment') !!}
    {!! Form::checkbox('has_sentiment', true, array('class' => 'form-control')) !!}
  </div>

  {!! Form::submit('Create the Message!', array('class' => 'btn btn-primary')) !!}

{!! Form::close() !!}

</div>
</body>
</html>
