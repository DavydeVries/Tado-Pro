<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function jsonAbort($statusCode = 400, $message = null)
    {
        $errorType = null;

        switch ($statusCode) {
            case 400: $errorType = 'Bad Request';break;
            case 401: $errorType = 'Unauthorized';break;
        }

        $data = [
            'code'    => $statusCode,
            'type' => $errorType,
            'message' => $message,
        ];

        return response()->json($data);
    }
}
