<?php
namespace App\Services;
use App\Models\Route;
use DB;

class RouteService
{
    public function getAllRoutes($mode){

        $result = Route::select('route.*','vRoute.noVehicles')
        ->leftJoin(
            DB::raw(
                '(
                    SELECT COUNT(vehicleId) as noVehicles, routeId
                    FROM vehicle_route
                    GROUP BY routeId
                ) AS vRoute'),'vRoute.routeId','route.routeId')
        ->when(!empty($mode) && $mode != 'all', function($q) use($mode){
            $q->where('route.mode',$mode);
        })
        ->get();

        return $result;

    }
}

?>
