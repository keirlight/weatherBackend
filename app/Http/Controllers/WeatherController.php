<?php

namespace App\Http\Controllers;

use App\Http\Libraries\WeatherLib as WeatherLib;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    const URI_CURDATA = 'curData';
    const URI_FORECAST = 'forecast';

    protected $weatherLib;

    public function __construct(WeatherLib $w)
    {
        $this->weatherLib = $w;
    }

    public function index(Request $request)
    {
        $params = $request->input();
        $params['endpoint'] = self::URI_CURDATA;
        return $this->weatherLib->initRequest($params);
    }

    public function forecast(Request $request)
    {
        $params = $request->input();
        $params['endpoint'] = self::URI_FORECAST;
        return $this->weatherLib->initRequest($params);
    }

}
