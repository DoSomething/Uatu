<!DOCTYPE html>
<html>
<head>
  <title>Uatu</title>
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

  <h1>@yield('title')</h1>

  <!-- will be used to show any messages -->
  @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif

  @yield('content')

</div>
</body>
</html>
