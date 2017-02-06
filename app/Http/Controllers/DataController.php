<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController
{
    public function response($data='', $msg='', $errcode=0)
    {
        return response()->json([
          'errcode' => $errcode,
          'data' => $data,
          'msg' => $msg
        ]);
    }
}
