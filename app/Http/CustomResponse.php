<?php

namespace App\Http;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

class CustomResponse
{
    public static $STATUS_OK = 'OK';
    public static $STATUS_KO = 'KO';

    public static function json(string $status, $data = '', int $statusCode = 200, array $headers = []) {
        $content = array(
            'status' => $status,
            'data' => $data
        );
        return new JsonResponse($content, $statusCode, $headers);
    }
}
