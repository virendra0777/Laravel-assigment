<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function successMessage($msg){
        return response()->json(['status' => 200, 'message' => $msg],200);
    }

    public function errorMessage($msg){
        return response()->json(['status' => 500, 'message' => $msg],500);
    }

    public function validationErrorMessage($msg){
        return response()->json(['status' => 403, 'message' => $msg],403);
    }

    public function successDataMessage($msg, $data){
        return response()->json(['status' => 200, 'message' => $msg, 'data' => $data],200);
    }
}
