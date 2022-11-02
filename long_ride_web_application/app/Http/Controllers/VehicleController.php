<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class VehicleController extends Controller
{
    public function loadModal(Request $request){
        return view('reports.vehicles.index');
    }

    public function generateVehicleReport(Request $request){
        $mode = $request->mode;

        $data['result'] = Vehicle::when(!empty($mode) && $mode != 'all', function($q) use($mode){
            $q->where('vehicleType',$mode);
        })
        ->get();

        $data['mode'] = $mode;
        $name = 'Vehicle Report to '. date('Y-m-d') .'.pdf';
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('reports.vehicles.report',['data' => $data]);
        return $pdf->stream($name);
    }
}
