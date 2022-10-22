<?php

namespace App\Http\Libraries;

use App\Http\Libraries\Utils;

final class WeatherLib extends Utils
{
    const API = 'https://api.openweathermap.org/data/2.5';
    const API_KEY = '3dc9160f81bbe7eddb676ff6451ac4bf';
    const DEFAULT_LANG = 'en';
    const DEFAULT_UNITS = 'metrics';
    const ENDPOINTS = [
        'curData' => self::API .'/weather?',
        'forecast' => self::API .'/forecast?',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function initRequest($params)
    {
        $filter = $this->initDefParam();
        $this->set_request_param($params, $filter);
        $url = self::ENDPOINTS[$params['endpoint']] . http_build_query($filter);

        // replicate api response to be flexible
        $res = $this->callApi($url, self::METHOD_GET);
        // return [
        //     'cod' => $res['status'],
        //     'list' => $res['data'] ?? [],
        // ];
        return $res['data'] ?? [];
    }

    private function initDefParam()
    {
        return [
            'appid' => self::API_KEY,
            'lang' => self::DEFAULT_LANG,
            'units' => self::DEFAULT_UNITS,
        ];
    }

    private function set_request_param($params, &$filter)
    {
        if (!empty($params['city'])) {
            $filter['q'] = $params['city'];
        }

        if (!empty($params['q'])) {
            $filter['q'] = $params['q'];
        }

        if (!empty($params['lat']) && !empty($params['lon'])) {
            $filter['lat'] = $params['lat'];
            $filter['lon'] = $params['lon'];
        }
    }
}
