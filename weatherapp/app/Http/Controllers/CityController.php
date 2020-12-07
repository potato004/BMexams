<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Http\Resources\City as CityResource;


class CityController extends Controller
{

    public function index()
    {
        $cities = City::all();

        return CityResource::collection($cities);
    }
}
