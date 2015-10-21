<?php namespace App;

  use Illuminate\Database\Eloquent\Model;

  class Book extends Model
  {
    protected $fillable = ['word', 'word_match', 'exact', 'response_id'];
  }
