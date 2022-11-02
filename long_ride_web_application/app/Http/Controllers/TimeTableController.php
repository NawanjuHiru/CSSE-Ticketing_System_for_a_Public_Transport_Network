<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;
use App\Models\TimeTable;
use App\Models\VehicleRoute;
use App\Models\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class TimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $routeId = $request->id;


    if ($request->ajax()) {

        $timetables = TimeTable::getTimeTables($request->all(), $routeId);
        return datatables()->of($timetables)
        ->addColumn('timetableId', function ($row) {
            return $row->timetableId ;
        })
        ->addColumn('depaturetime', function ($row) {
            return $row->depaturetime;
        })
        ->addColumn('arrivaltime', function ($row) {
            return $row->arrivaltime;
        })
        ->addColumn('vehicleId', function ($row) {
            $vehicle = Vehicle::where('vehicleId', $row->vehicleId)->first();
            return  $vehicle->vehicleNumber;
        })
        ->addColumn('day', function ($row) {
            return $row->day;
        })
        ->addColumn('action', function ($row) {
            $delete = '<a data-placement="top" data-toggle="tooltip-primary" title="Delete" data-timetableid = "'.$row->timetableId.'" ><i class="fas fa-trash-alt text-danger  fa-lg delete"></i></a>';
            $edit = ' <a href="' . route('time_table_edit_view',['id' => $row->timetableId]) . '" data-toggle="tooltip-primary" title="Edit"><i class="fas fa-edit text-warning fa-lg" data-placement="top"></i></a>';

            return $edit.' '.$delete;
        })
        ->rawColumns(['action'])

        ->make(true);
    }

        $data['routeId'] = $routeId;
        $route = Route::where('routeId', $routeId)->first();

        $data['routeData'] =   $route;

        return view('timetables.index_timetable',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
       $vehiclesRoutes=VehicleRoute::where('routeId', $id)->get();

       $data['vehicles'] =array();

       foreach( $vehiclesRoutes as $e){
            $exe= DB::table('vehicle')->where('vehicleId',$e->vehicleId)->get();
            $data['vehicles'][]=$exe;
        }

        $data['routeId'] = $id;

        return view('timetables.create_timetable',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $rules = [
            'arrivaltime' => 'required|date_format:H:i',
            'depaturetime' => 'required|date_format:H:i',
            'day' => 'required',
            'vehicleId' => 'required',
        ];

        $validatedData = Validator::make(
            $request->all(),
            $rules,
            [
                'arrivaltime.required' => 'This field is required',
                'arrivaltime.date_format:H:i' => 'Please use 24 hour time format , Ex 23:00',
                'depaturetime.required' => 'This field is required',
                'day.required' => 'This field is required',
                'vehicleId.required' => 'This field is required',
            ]
        );

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
                ->with('error_message', 'please check as we’re missing some information.');
        }else{
        $timeTable = new TimeTable();

        $timeTable->routeId=$request->routeId;
        $timeTable->day=$request->day;
        $timeTable->vehicleId=$request->vehicleId;
        $timeTable->arrivaltime=$request->arrivaltime;
        $timeTable->depaturetime=$request->depaturetime;

        $res = $timeTable->save();

        if($res){
            return redirect(route('timetable_index',['id' =>$request->routeId]))->with('success_message', 'Time Table record created succefully');
        }else{
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
            ->with('error_message', 'please check as we’re missing some information.');
        }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //


        $timetables = TimeTable::where('routeId', $id)->orderBy('arrivaltime','asc')->get();
        foreach( $timetables as $e){
            $exe= DB::table('vehicle')->where('vehicleId',$e->vehicleId)->first();
            $e->vehicleId =  $exe->vehicleNumber;
        }
        $data['timetables'] =   $timetables;
        $route = Route::where('routeId',$id)->first();
        $data['routeId'] =$id;
        $data['routeData'] =   $route;

        return view('timetables.view_timetable',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $data['result'] = TimeTable::where('timetableId',$id)->first();
        $routeId =  $data['result']->routeId;
        $vehiclesRoutes=VehicleRoute::where('routeId', $routeId)->get();
        $data['vehicles'] =array();

       foreach( $vehiclesRoutes as $e){
            $exe= DB::table('vehicle')->where('vehicleId',$e->vehicleId)->get();
            $data['vehicles'][]=$exe;
        }

        return view('timetables.edit_timetable',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'arrivaltime' => 'required|date_format:H:i',
            'depaturetime' => 'required|date_format:H:i',
            'day' => 'required',
            'vehicleId' => 'required',
        ];

        $validatedData = Validator::make(
            $request->all(),
            $rules,
            [
                'arrivaltime.required' => 'This field is required',
                'depaturetime.required' => 'This field is required',
                'day.required' => 'This field is required',
                'vehicleId.required' => 'This field is required',
            ]
        );


        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
                ->with('error_message', 'please check as we’re missing some information.');
        }else{

            $timeTable = TimeTable::where('timetableId',$id)->first();

            $timeTable->routeId=$request->routeId;
            $timeTable->day=$request->day;
            $timeTable->vehicleId=$request->vehicleId;
            $timeTable->arrivaltime=$request->arrivaltime;
            $timeTable->depaturetime=$request->depaturetime;


            $res_plan = $timeTable->save();

        if($res_plan){
            return redirect(route('timetable_index',['id' =>$request->routeId]))->with('success_message', 'Time Table Record updated succefully ');
        }else{
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
            ->with('error_message', 'please check as we’re missing some information.');
        }
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $state = 0;
        $timeTable=TimeTable::find($id);
        $res = $timeTable->delete();
         if($res){
            $state = 1;
        }else{
            $state = 0;
        }

        return response()->json(['success' => $state, 'success_message' => 'Record deleted succefully'], 200);
    }

    public function printReport($id)
    {
        //
        $timetables = TimeTable::where('routeId', $id)->orderBy('arrivaltime','asc')->get();
        foreach( $timetables as $e){
            $exe= DB::table('vehicle')->where('vehicleId',$e->vehicleId)->first();
            $e->vehicleId =  $exe->vehicleNumber;
        }

        $data['timetables'] =   $timetables;
        $route = Route::where('routeId',$id)->first();
        $data['routeId'] =$id;
        $data['routeData'] =   $route;

         $name = 'Time Table - '. $route->routeNo.' '. $route->startPoint.'-'. $route->endpoint.' Route .pdf';
         $pdf = App::make('dompdf.wrapper');
         $pdf->loadView('timetables.report_timetable',['data'=> $data]);
         return $pdf->stream($name);

    }

    public function loadModal(Request $request){

        $data['routes'] =   Route::all();

        return view('reports.timetables.index',compact('data'));
    }

    public function generateTimetableReport(Request $request){
        $routeId = $request->route;

         $timetables = TimeTable::where('routeId', $routeId)->orderBy('arrivaltime','asc')->get();
        foreach( $timetables as $e){
            $exe= DB::table('vehicle')->where('vehicleId',$e->vehicleId)->first();
            $e->vehicleId =  $exe->vehicleNumber;
        }

        $data['timetables'] =   $timetables;
        $route = Route::where('routeId',$routeId)->first();
        $data['routeId'] =$routeId;
        $data['routeData'] =   $route;



        $name = 'Time Table - '. $route->routeNo.' '. $route->startPoint.'-'. $route->endpoint.' Route .pdf';
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('reports.timetables.report',['data' => $data]);
        return $pdf->stream($name);

    }
}
