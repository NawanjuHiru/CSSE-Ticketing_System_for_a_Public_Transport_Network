<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteApiController extends Controller
{
   public function getAllRoutes()
   {
       $data = Route::select('route.routeId','route.routeNo','route.startPoint','route.endpoint','route.mode','route.price','v.vehicleId','v.vehicleType','v.vehicleNumber')
       ->join('vehicle_route as vr','vr.routeId','route.routeId')
       ->join('vehicle as v','v.vehicleId','vr.vehicleId')
       ->get();

       return response()->json($data);
   }
}
