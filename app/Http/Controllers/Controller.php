<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

    use DispatchesCommands,
        ValidatesRequests;

    public function sendResponse($result_code, $result) {
        return response()->json([
                    'result_code' => $result_code,
                    'result_description' => $result]);
    }

}
