<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Services\MobileCommons;

class Controller extends BaseController
{

  protected $args;
  protected $phone;
  protected $mdata_id;
  protected $is_mms_msg;
  protected $campaign_id;

  public function __construct(Request $request, MobileCommons $mobile_commons)
  {
    $this->mobile_commons = $mobile_commons;

    if ($request->input('args')) {
      $this->args = $request->input('args');
    }

    if ($request->input('phone')) {
      $this->phone = $request->input('phone');
    }

    if ($request->input('mdata_id')) {
      $this->mdata_id = $request->input('mdata_id');
    }

    if ($request->input('mms_image_url')) {
      $this->is_mms_msg = TRUE;
    }

    if ($request->input('campaign_id')) {
      $this->campaign_id = $request->input('campaign_id');
    }
  }
}
