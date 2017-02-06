<?php

namespace App\Http\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    protected $request;

    public function response($data='', $msg='', $errcode=0)
    {
        return response([
          'errcode' => $errcode,
          'data' => $data,
          'msg' => $msg
        ]);
    }
}
