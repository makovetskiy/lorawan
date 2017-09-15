<?php

namespace App\Http\Controllers;

use App\Address;
use App\Region;
use App\City;
use App\Street;
use App\RegionType;
use App\CityType;
use App\StreetType;
use App\HomeType;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getAllRegion(){
        $regions = Region::leftjoin('REGION_TYPE', 'REGION_TYPE.RGNT_ID', '=', 'REGION.RGN_TYPE')->get();
        return response()->json($regions,200);
    }
    
    public function getAllAddreses(){
        $adr = Address::leftJoin('HOME', 'HOME.HOME_ID', '=', 'ADRESS.ADR_HOME_ID')
        ->leftJoin('HOME_TYPE', 'HOME_TYPE.HOMET_ID', '=', 'HOME.HOME_TYPE')
        ->leftJoin('STREET', 'STREET.STRT_ID', '=', 'HOME.HOME_STRT_ID')
        ->leftJoin('STREET_TYPE', 'STREET_TYPE.STREETT_ID', '=', 'STREET.STRT_TYPE')
        ->leftJoin('CITY', 'CITY.CITY_ID', '=', 'STREET.STRT_CITY_ID')
        ->leftJoin('CITY_TYPE', 'CITY_TYPE.CITYT_ID', '=', 'CITY.CITY_TYPE')
        ->leftJoin('REGION', 'REGION.RGN_ID', '=', 'CITY.CITY_RGN_ID')
        ->leftJoin('REGION_TYPE', 'REGION_TYPE.RGNT_ID', '=', 'REGION.RGN_TYPE')
        ->leftJoin('FLAT', 'FLAT.FLT_ID', '=', 'ADRESS.ADR_FLT_ID')
        ->get();
        return response()->json($adr,200);
    }

    public function getAllCity(){
        $city = City::all();
        return response()->json($city,200);
    }

    public function getAllRegionTypes(){
        $rtype = RegionType::all();
        return response()->json($rtype,200);
    }

    public function getAllCityTypes(){
        $ctype = CityType::all();
        return response()->json($ctype,200);
    }

    public function getAllStreetTypes(){
        $stype = StreetType::all();
        return response()->json($stype,200);
    }

    public function getAllStreets(){
        $streets = Street::all();
        return response()->json($streets,200);
    }

    public function getAllHomeTypes(){
        $htype = HomeType::all();
        return response()->json($htype,200);
    }
}
