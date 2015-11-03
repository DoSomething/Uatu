<!DOCTYPE html>
<html>
<head>
  <title>Look! I'm CRUDding</title>
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

<h1>Messages</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
  <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <td>ID</td>
      <td>Type</td>
      <td>Message</td>
      <td>Exact</td>
      <td>Short Term Response</td>
      <td>Long Term Response</td>
      <td>Sentiment</td>
    </tr>
  </thead>
  <tbody>
  @foreach($messages as $key => $value)
    <tr>
      <td>{{ $value->id }}</td>
      <td>{{ $value->type }}</td>
      <td>{{ $value->message }}</td>
      <td>{{ $value->exact }}</td>
      <td>{{ $value->short_term }}</td>
      <td>{{ $value->long_term }}</td>
      <td>{{ $value->has_sentiment }}</td>

      <!-- we will also add show, edit, and delete buttons -->
      <td>
        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
        {!! Form::open(array('url' => 'messages/' . $value->id, 'class' => 'pull-right')) !!}
          {!! Form::hidden('_method', 'DELETE') !!}
          {!! Form::submit('Delete', array('class' => 'btn btn-warning')) !!}
        {!! Form::close() !!}

        <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
        <a class="btn btn-small btn-success" href="{{ URL::to('messages/' . $value->id) }}">Show</a>

        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
        <a class="btn btn-small btn-info" href="{{ URL::to('messages/' . $value->id . '/edit') }}">Edit</a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

</div>
</body>
</html>
