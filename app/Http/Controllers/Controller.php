<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

  protected $fields;

  public function __construct(Request $request){
    if ($request->input('fields')) {
      $this->fields = $request->input('fields');
    }

    if ($request->input('something')) {
      $this->something = $request->input('something');
    }
  }
}
