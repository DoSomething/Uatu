<!DOCTYPE html>
<html>
<head>
  <title>Uatu</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
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
