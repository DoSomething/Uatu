<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

  protected $args;
  protected $phone;

  public function __construct(Request $request){
    if ($request->input('args')) {
      $this->args = $request->input('args');
    }

    if ($request->input('phone')) {
      $this->phone = $request->input('phone');
    }
  }
}
