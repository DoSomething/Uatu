<?php namespace App;

  use Illuminate\Database\Eloquent\Model;

  class Response extends Model
  {
    protected $guarded = ['id'];
    protected $fillable = ['mobile_commons_id'];
  }
