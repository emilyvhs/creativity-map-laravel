<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    //check if data exists in database
    //get the data from a query
    //check if the data gets results from geocoder
    //store the lat and long in the database

    public function getCoordinates():void
    {
        $rows = DB::table('groups')
            ->whereAny([
                'lat',
                'lng'], '=', null)
            ->get();

        foreach ($rows as $row) {
            $result = app('geocoder')->geocode($row->address)->get();
            if($result) {
                $coordinates = $result[0]->getCoordinates();
                $lat = $coordinates->getLatitude();
                $lng = $coordinates->getLongitude();
                DB::table('groups')
                    ->where('id', $row->id)
                    ->update(['lat' => $lat, 'lng' => $lng]);
            }
        }
    }
}
