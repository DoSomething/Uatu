<?php namespace App;

  use Illuminate\Auth\Authenticatable;
  use Illuminate\Auth\Passwords\CanResetPassword;
  use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
  use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
  use Illuminate\Database\Eloquent\Model;

  class User extends Model implements AuthenticatableContract, CanResetPasswordContract
  {
    use Authenticatable, CanResetPassword;

    protected $fillable = [
      'name',
      'username',
      'email',
      'password',
    ];
  }
