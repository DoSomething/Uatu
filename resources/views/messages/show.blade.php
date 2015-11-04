@extends('layouts.master')

@section('content')
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
@stop

