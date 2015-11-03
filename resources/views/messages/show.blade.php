<!DOCTYPE html>
<html>
<head>
  <title>Uatu - {{ $message->message }}</title>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
  <div class="navbar-header">
    <a class="navbar-brand" href="{{ URL::to('messages') }}">Uatu</a>
  </div>
  <ul class="nav navbar-nav">
    <li><a href="{{ URL::to('messages') }}">View All Messages</a></li>
    <li><a href="{{ URL::to('messages/create') }}">Create a Message</a>
  </ul>
</nav>

<h1>Message view</h1>
  <div class="jumbotron text-left">
    <h2>{{ $message->message }}</h2>
    <p>
      <strong>Type:</strong> {{ $message->type }}<br>
      <strong>Short Term Responses:</strong> {{ $message->short_term }}<br>
      <strong>Long Term Responses:</strong> {{ $message->long_term }}<br>
      <strong>Exact:</strong> {{ $message->exact }}<br>
      <strong>Has Sentiment:</strong> {{ $message->has_sentiment }}
    </p>
  </div>
</div>
</body>
</html>
