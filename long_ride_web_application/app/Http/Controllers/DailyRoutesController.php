<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Vehicle;
use App\Models\VehicleRoute;
use App\Services\RouteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class DailyRoutesController extends Controller
{
    /**
     * Display a listing of the routes and search filter.
     */
    public function index(Request $request)
    {
        $action = $request->action;
        $route_Service = new RouteService();

        if ($request->ajax()) {
            $route_data = $route_Service->getAllRoutes($action);
            return datatables()->of($route_data)
            ->addColumn('routeId', function ($row) {
                return $row->routeId;
            })
            ->addColumn('routeNo', function ($row) {
                return $row->routeNo;
            })
            ->addColumn('startPoint', function ($row) {
                return $row->startPoint;
            })
            ->addColumn('endPoint', function ($row) {
                return $row->endpoint;
            })
            ->addColumn('mode', function ($row) {
                return $row->mode;
            })
            ->addColumn('noVehicles', function ($row) {
                return ($row->noVehicles == null) ? '0' : $row->noVehicles;
            })
            ->addColumn('price', function ($row) {
                return 'Rs. '.$row->price.' .00';
            })
            ->addColumn('status', function ($row) {
                if($row->status == '1'){
                    return '<div class="main-toggle main-toggle-success on tog" data-status = "'.$row->status.'" data-routeid = "'.$row->routeId.'"><span></span></div>';
                }
                else{
                    return '<div class="main-toggle main-toggle-success tog" data-status = "'.$row->status.'" data-routeid = "'.$row->routeId.'"><span></span></div>';
                }
            })
            ->addColumn('action', function ($row) {
                $delete = '<a data-placement="top" data-toggle="tooltip-primary" title="Delete" data-routeid = "'.$row->routeId.'" ><i class="fas fa-trash-alt text-danger fa-lg delete"></i></a> ';
                $edit = ' <a href="' . route('route_view',['action' => 'edit','id' => $row->routeId]) . '" data-toggle="tooltip-primary" title="Edit"><i class="fas fa-edit text-warning fa-lg" data-placement="top"></i></a>';
                $timetable = ' <a href="'.route('timetable_index',['id' => $row->routeId]).'" data-toggle="tooltip-primary" title="Timetable"><i class="fas fa-clock text-primary fa-lg" data-placement="top"></i></a>';
                return $edit.' '.$timetable.' '.$delete;
            })
            ->rawColumns(['action','status'])

            ->make(true);
        }
        return view('routes.index',compact('action'));
    }

    /**
     * Show the routes view interfaces.
     * Action ('add','delete','edit')
     */
    public function view(Request $request){
        $action = $request->action;
        $id = $request->id;
        switch($action){
            case 'add' :
                $data['vehicle'] = Vehicle::get();
                return view('routes.create',compact('action','data'));
                break;
            case 'edit' :
                $data['vehicle'] = Vehicle::get();
                $data['vehecle_route'] = VehicleRoute::where('routeId',$id)->get();
                $data['route'] = Route::where('routeId',$id)->first();
                return view('routes.create',compact('action','data'));
                break;

        }

    }

    /**
     * Validate the route form.
     * Action ('add','delete','edit')
     */
    public function create(Request $request)
    {
        $action = $request->action;
        $id = $request->id;
        $data = $request->all();

        if($action == 'add' || $action == 'edit'){
            $rules = [
                'routeNo' => 'required',
                'mode' => 'required',
                'startPoint' => 'required',
                'endpoint' => 'required',
                'price' => 'required',
            ];
        }else{
            $rules = [];
        }

        $validatedData = Validator::make(
            $request->all(),
            $rules,
            [
                'routeNo.required' => 'This route no field is required',
                'mode.required' => 'This mode field is required',
                'startPoint.required' => 'This start point field is required',
                'endpoint.required' => 'This end point field is required',
                'price.required' => 'This price field is required',
            ]
        );

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
                ->with('error_message', 'please check as we’re missing some information.');
        } else {
            switch($action){
                case 'add':
                    $res = $this->store($data);
                    if($res){
                        return redirect(route('route_index',['action' => '']))->with('success_message', 'Route created succefully.');
                    }else{
                        return redirect()->back()->with('error_message', 'Request unsuccefull.');
                    }
                    break;
                case 'edit':
                    $res = $this->update($data,$id);
                    if($res){
                        return redirect()->back()->with('success_message', 'Route edited succefully.');
                    }else{
                        return redirect()->back()->with('error_message', 'Request unsuccefull.');
                    }
                    break;
                case 'delete':
                    $res = $this->destroy($id);
                    if($res){
                        return response()->json(['success' => 1, 'success_message' => 'Route deleted succefully'], 200);
                    }else{
                        return response()->json(['success' => 0, 'success_message' => 'Request unsuccefull'], 200);
                    }
                    break;
            }
        }
    }

    /**
     * Store a newly created route in storage.
     */
    public function store($data)
    {
        $route = new Route();
        $route->routeNo = $data['routeNo'];
        $route->startPoint = $data['startPoint'];
        $route->endpoint = $data['endpoint'];
        $route->price = $data['price'];
        $route->mode = $data['mode'];
        $route->status = 1;

        if($route->save()){
            $routeId = $route->routeId;
            if(isset($data['vehicle'])){
                foreach($data['vehicle'] as $res){
                    $vehicle_routes = VehicleRoute::create([
                        'routeId' => $routeId,
                        'vehicleId' => $res,
                    ]);
                }
                return true;
            }
            return true;
        }
        return false;

    }

    /**
     * Update the specified route in storage.
     */
    public function update($data,$id)
    {
        $route = Route::where('routeId',$id)->first();
        $route->routeNo = $data['routeNo'];
        $route->startPoint = $data['startPoint'];
        $route->endpoint = $data['endpoint'];
        $route->price = $data['price'];
        $route->mode = $data['mode'];
        $route->status = 1;

        if($route->save()){
            if(isset($data['vehicle'])){
                VehicleRoute::where('routeId',$id)->delete();
                foreach($data['vehicle'] as $res){
                    $vehicle_routes = VehicleRoute::create([
                        'routeId' => $id,
                        'vehicleId' => $res,
                    ]);
                }
                return true;
            }
            return true;
        }
        return false;
    }

    /**
     * Remove the specified route from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Route::where('routeId',$id)->first();

        if($res->delete()){
            $del = VehicleRoute::where('routeId',$id)->delete();
            return true;
        }
        return false;

    }

    /**
     * Update the specified route status in storage.
     */
    public function changeRouteStatus(Request $request){
        $id = $request->id;
        $status = $request->status;

        $res = Route::where('routeId',$id)->first();

        if($status == '1'){
            $res->status = '0';
        }elseif($status == '0'){
            $res->status = '1';
        }
        $res->save();

        return response()->json(['success' => 1, 'success_message' => 'Route edited succefully'], 200);

    }

    /**
     * load the reports.routes.index view.
     */
    public function loadModal(Request $request){
        return view('reports.routes.index');
    }


    /**
     * Generate route report
     */
    public function generateRouteReport(Request $request){
        $mode = $request->mode;
        $route_Service = new RouteService();
        $data['result'] = $route_Service->getAllRoutes($mode);
        $data['mode'] = $mode;
        $name = 'Route Report to '. date('Y-m-d') .'.pdf';
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('reports.routes.report',['data' => $data]);
        return $pdf->stream($name);

    }
}
