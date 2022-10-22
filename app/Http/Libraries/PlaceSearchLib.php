<?php

namespace App\Http\Libraries;

use App\Http\Libraries\Utils;

final class PlaceSearchLib extends Utils
{
    const API = 'https://api.foursquare.com/v3/places';
    const API_KEY = 'fsq3k0Jg4ItzFEJQ/FzJYhRvSuOJk2E+lvaLvyAsvYlPVLs=';
    const DEFAULT_ENDPOINT = 'search';
    const ENDPOINTS = [
        'search' => self::API .'/search?',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function initRequest($params)
    {
        $headers = $this->initHeaders();
        $this->set_request_param($params, $filter);
        $url = self::ENDPOINTS[self::DEFAULT_ENDPOINT] . http_build_query($filter);

        $res = $this->callApi($url, self::METHOD_GET, $headers);

        // replicate api response to be flexible
        return [
            'status' => $res['status'],
            'results' => $res['data']['results'] ?? [],
        ];
    }

    private function initHeaders()
    {
        $headers = [
            'authorization' => self::API_KEY,
            'accept' => 'application/json'
        ];

        return $headers;
    }

    private function set_request_param($params, &$filter)
    {
        $keys = ['city', 'query', 'near'];

        foreach ($keys as $key) {
            if (isset($params[$key])) {
                $filter[$key] = $params[$key];
            }
        }
    }
}
