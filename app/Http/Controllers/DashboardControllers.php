<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\DashboardModel;


class DashboardControllers extends Controller
{
    public function get(Request $request){
        $dm = new DashboardModel();
        $stat= $dm->getstatistik($request->id);
        $chart = $dm->getChart($request->id);
        return json_encode(compact('stat','chart'));
    }
}
