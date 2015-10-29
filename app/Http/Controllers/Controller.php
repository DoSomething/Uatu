<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Services\MobileCommons;

class Controller extends BaseController
{

  protected $args;
  protected $phone;

  public function __construct(Request $request, MobileCommons $mobile_commons)
  {
    $this->mobile_commons = $mobile_commons;

    if ($request->input('args')) {
      $this->args = $request->input('args');
    }

    if ($request->input('phone')) {
      $this->phone = $request->input('phone');
    }
  }
}
