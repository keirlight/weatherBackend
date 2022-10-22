<?php

namespace App\Http\Controllers;

use App\Http\Libraries\PlaceSearchLib as PlaceSearchLib;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    protected $placeSearchLib;

    public function __construct(PlaceSearchLib $p)
    {
        $this->placeSearchLib = $p;
    }

    public function index(Request $request)
    {
        $params = $request->input();
        return $this->placeSearchLib->initRequest($params);
    }

}
