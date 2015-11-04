@extends('layouts.master')

@section('title', 'Messages')

@section('content')
  <table class="table table-striped table-bordered table-hover">
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

        <td>
          <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </button>
            <ul class="dropdown-menu">
              <li>
                <a href="{{ URL::to('messages/' . $value->id) }}">Show</a>
              </li>
              <li>
                <a href="{{ URL::to('messages/' . $value->id . '/edit') }}">Edit</a>
              </li>
              <li role="separator" class="divider"></li>
              <li>
                {!! Form::open(array('url' => 'messages/' . $value->id)) !!}
                  {!! Form::hidden('_method', 'DELETE') !!}
                  {!! Form::submit('Delete', array('class' => 'btn btn-danger center-block')) !!}
                {!! Form::close() !!}
              </li>
            </ul>
          </div>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@stop

