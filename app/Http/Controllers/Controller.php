<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function SendResponse($result, $message)
    {
        $response = [
            "success" => true,
            "data" => $result,
            "message" => $message
        ];
        $url = $this->GetRoute();
        if (isset($url[0]) && $url[0] == "api") {
            return response()->json($response, 200);
        }
        return $response;
    }

    public function SendError($error, $errorMessage = [], $code = 404)
    {
        $response = [
            "success" => false,
            "error" => $error,
            "message" => $errorMessage
        ];
        $url = $this->GetRoute();
        if (isset($url[0]) && $url[0] == "api") {
            return response()->json($response, 200);
        }
        return $response;
    }

    private function GetRoute()
    {
        $url = Route::getFacadeRoot()->current()->uri() == null ? "" : Route::getFacadeRoot()->current()->uri();
        $url = str_replace('\/', ' ', $url);
        $url = str_word_count($url, 1);
        return $url;
    }
}
