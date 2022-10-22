<?php

namespace App\Http\Libraries;
use Illuminate\Support\Facades\Http;

class Utils
{
    const METHOD_GET = 'GET';
    const HTTP_CODE_UNAUTHORIZED = 401;

    public function __construct()
    {
        // set code
    }

    public function callApi($url, $method = self::METHOD_GET, $headers = [])
    {
        switch ($method) {
            case 'GET':
                if (!empty($headers)) {
                    $response = Http::withHeaders($headers)
                        ->withOptions(['verify' => false]) // disable ssl check
                        ->get($url);
                } else {
                    $response = Http::get($url);
                }

                list($status, $data) = $this->set_response($response);
                break;
            default:
                $status = false;
                $data = [];
                break;
        }

        return [
            'status' => $status,
            'data' => $data
        ];
    }

    private function set_response($response)
    {
        if (!empty($response->status()))
        {
            return [
                $response->status(),
                json_decode($response->getBody(), true)
            ];
        }

        return [self::HTTP_CODE_UNAUTHORIZED, null];
    }

}
