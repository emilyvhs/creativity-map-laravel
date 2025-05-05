<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function getCoordinates()
    {
        $rows = DB::table('groups')
            ->whereAny([
                'lat',
                'lng'], '=', null)
            ->get();

        foreach ($rows as $row) {
            $result = app('geocoder')->geocode($row->address.', '.$row->city.', '.$row->postcode)->get();
            if ($result) {
                $coordinates = $result[0]->getCoordinates();
                $lat = $coordinates->getLatitude();
                $lng = $coordinates->getLongitude();
                DB::table('groups')
                    ->where('id', $row->id)
                    ->update(['lat' => $lat, 'lng' => $lng]);
            }
        }

        return redirect('/approve');
    }
}
