<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketInspector;
use App\Models\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class TicketInspectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ticketInspectors = TicketInspector::getTicketInspectors($request->all());
            return datatables()->of($ticketInspectors)

            ->addColumn('avatar', function ($row) {
               $img = Storage::disk('accountsdocs')->get($row->avatar);
               $type =  pathinfo(Storage::disk('accountsdocs')->path($row->avatar), PATHINFO_EXTENSION);
               $path = 'data:avatar/' . $type . ';base64,' . base64_encode($img);
               return '<img src="'. $path .'">';
            })
            ->addColumn('firstname', function ($row) {
                return $row->firstname;
            })
            ->addColumn('lastname', function ($row) {
                return $row->lastname;
            })
            ->addColumn('email', function ($row) {
                return $row->email;
            })
            ->addColumn('route', function ($row) {
                $route = Route::where('routeId',$row->route)->first();
                return $route->routeNo;
            })
            ->addColumn('phone', function ($row) {
                return $row->phone;
            })
            ->addColumn('city', function ($row) {
                return $row->city;
            })
            ->addColumn('action', function ($row) {
                $delete = '<a data-placement="top" data-toggle="tooltip-primary" title="Delete" data-tinsid = "'.$row->ins_id.'" ><i class="fas fa-trash-alt text-danger  fa-lg delete"></i></a> ';
                $edit = '<a href="' . route('ticketInspector_edit_view',['id' => $row->ins_id]) . '" data-toggle="tooltip-primary" title="Edit"><i class="fas fa-edit text-warning fa-lg" data-placement="top"></i></a>';
                return $edit.' '.$delete;
            })
            ->rawColumns(['avatar','action'])

            ->make(true);
        }
        return view('ticketInspector.index_ticketInspector');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routes=Route::all();
        $data['routes'] =  $routes;

        return view('ticketInspector.create_ticketInspector',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'city' => 'required',
            'route' => 'required',
            'password' => 'required|min:5',
        ];

        $validatedData = Validator::make(
            $request->all(),
            $rules,
            [
                'firstname.required' => 'First name is required ',
                'lastname.required' => 'Last name field is required',
                'email.required' => 'Email field is required',
                'phone.required' => 'Phone number is required',
                'city.required' => 'City is required',
                'route.required' => 'Route field is required',
                'password.required' => 'Password is required',
            ]
        );

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
                ->with('error_message', 'please check as we’re missing some information.');
        }else{
            $ticketInspector = new TicketInspector();
            if($request->file('avatar')){
                $file_path = Storage::disk('accountsdocs')->putFileAs('TicketInspector', $request->file('avatar'), $request->avatar->getClientOriginalName());
            }
            else{
                $file_path = $request->avatar;
            }
            $ticketInspector->firstname=$request->firstname;
            $ticketInspector->lastname=$request->lastname;
            $ticketInspector->email=$request->email;
            $ticketInspector->phone=$request->phone;
            $ticketInspector->city=$request->city;
            $ticketInspector->route=$request->route;
            $ticketInspector->avatar= $file_path;
            $ticketInspector->password=$request->password;

            $tins = $ticketInspector->save();

            if($tins){
                return redirect(route('ticketInspector_index'))->with('success_message', 'Equipment Succcessfully Registered');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticketInspector = new TicketInspector();

        $data['result'] = TicketInspector::where('ins_id',$id)->first();
        $data['id'] = $id;

        $routes=Route::all();
        $data['routes'] =  $routes;

         return view('ticketInspector.edit_ticketInspector',compact('data'));
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
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'city' => 'required',
            'route' => 'required',
            'password' => 'required|min:5',
        ];

        $validatedData = Validator::make(
            $request->all(),
            $rules,
            [
                'firstname.required' => 'First name is required ',
                'lastname.required' => 'Last name field is required',
                'email.required' => 'Email field is required',
                'phone.required' => 'Phone number is required',
                'city.required' => 'City is required',
                'route.required' => 'Route field is required',
                'password.required' => 'Password is required',
            ]
        );

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
                ->with('error_message', 'please check as we’re missing some information.');
        }else{
            $ticketInspector = TicketInspector::where('ins_id',$id)->first();

            $ticketInspector->firstname=$request->firstname;
            $ticketInspector->lastname=$request->lastname;
            $ticketInspector->email=$request->email;
            $ticketInspector->phone=$request->phone;
            $ticketInspector->city=$request->city;
            $ticketInspector->route=$request->route;
            $ticketInspector->password=$request->password;
            if ($request->hasfile('avatar')){
                if(!Storage::disk('accountsdocs')->exists('TicketInspector/'.$request->file('avatar')->getClientOriginalName())){
                    if($request->file('avatar')){
                        $file_path = Storage::disk('accountsdocs')->putFileAs('TicketInspector', $request->file('avatar'), $request->avatar->getClientOriginalName());
                    }
                    else{
                        $file_path = $request->avatar;
                    }
                }else{
                    $file_path = 'TicketInspector/'.$request->file('avatar')->getClientOriginalName();
                }
                $ticketInspector->avatar = $file_path;
            }

            $tins = $ticketInspector->save();
            if($tins){
                return redirect(route('ticketInspector_index'))->with('success_message', 'Ticket Inspector Details Succcessfully Updated');
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
        $state = 0;

            $ticketInspector=TicketInspector::find($id);
            $res =   $ticketInspector->delete();

             if($res){
                $state = 1;
            }else{
                $state = 0;
            }
        return response()->json(['success' => $state, 'success_message' => 'Record deleted succefully'], 200);
    }

    public function loadModal(Request $request){

        $data['routes'] = Route::all();
        return view('reports.ticketInspector.index',compact('data'));
    }

    public function generateInspectorReport(Request $request){

       $routeId = $request->route;
       $data['result'] = TicketInspector::where('route', $routeId)->get();

        $name = 'Ticket Inspector.pdf';
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('reports.ticketInspector.report',['data' => $data]);
        return $pdf->stream($name);

    }
}
