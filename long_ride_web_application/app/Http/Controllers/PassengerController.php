<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Passenger;
use App\Services\CardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Services\PassengerService;
use Illuminate\Support\Facades\App;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $action = $request->type;
        $passenger_service = new PassengerService();

        $passenger_data = $passenger_service->getPassengers($action);

        if($request->ajax()) {
            return datatables()->of($passenger_data)
            ->addColumn('full_name', function($row) {
                $fullname = $row->first_name." ".$row->last_name;
                return $fullname;
            })
            ->addColumn('email', function($row) {
                return $row->email;
            })
            ->addColumn('type', function($row) {
                return $row->type;
            })
            ->addColumn('card_Type', function($row) {
                $cid = $row->card_id;
                $card_data = Card::where('cardId', $cid)->first();
                return $card_data->cardName;
            })
            ->addColumn('status', function($row) {
                if($row->status == '1'){
                    return '<div class="main-toggle main-toggle-success on tog" data-status = "'.$row->status.'" data-passenger_id = "'.$row->passenger_id.'"><span></span></div>';
                } else {
                    return '<div class="main-toggle main-toggle-success tog" data-status = "'.$row->status.'" data-passenger_id = "'.$row->passenger_id.'"><span></span></div>';
                }
            })
            ->addColumn('action', function ($row) {
                $delete = '<a data-placement="top" data-toggle="tooltip-primary" title="Delete" data-appid = "'.$row->passenger_id.'" ><i class="fas fa-trash-alt text-danger  fa-lg delete"></i></a>';
                $edit = ' <a href="' . route('passenger_view', ['action' => 'Edit','id' => $row->passenger_id]) . '" data-toggle="tooltip-primary" title="Edit"><i class="fas fa-edit text-warning fa-lg" data-placement="top"></i></a>';
                return $edit.' '.$delete;
            })
            ->rawColumns(['action','status'])

            ->make(true);
        }

        return view('passenger.index', compact('action'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $action = $request->action;
        $id = $request->id;
        $card_service = new CardService();

        switch($action){
            case 'Add':
                $data['action'] = 'Add';
                $card_data = $card_service->getAllCardData($request->all());
                $data['cards'] = $card_data;
                return view('passenger.create', compact('data'));
                break;
            case 'Edit':
                $data['id'] = $id;
                $data['action'] = 'Edit';
                $data['result'] = Passenger::where('passenger_id', $id)->first();
                $card_data = $card_service->getAllCardData($request->all());
                $data['cards'] = $card_data;
                return view('passenger.create', compact('data'));
                break;
            default;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $action = $request->action;
        $id = $request->id;

        if($action == 'Add') {
            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|digits_between:10,12|numeric',
                'password' => 'required|min:6',
                'type' => 'required',
                'cid' => 'required',
            ];
        } else {
            $rules = [];
        }

        $validateData = Validator::make(
            $request->all(),
            $rules,
            [
                'first_name.required' => 'This field is required',
                'last_name.required' => 'This field is required',
                'email.required' => 'This field is required',
                'phone.numeric' => 'This field is required number',
                'password.min' => 'This field required ar least 6 characters',
                'type.required' => 'This field is required',
                'cid.required' => 'This field is required',
            ]
        );

        if($validateData->fails()) {
            return redirect()->back()->withInput()->withErrors($validateData->errors())
                ->with('error_message', 'Please check the information again');
        } else {
            switch($action) {
                case 'Add':
                    $res = $this->store($request);

                    if($res) {
                        return redirect(route('passenger_index'))->with('success_message', 'Record created successfully');
                    } else {
                        return redirect()->back()->withInput()->withErrors($validateData->errors())
                            ->with('error_message','Please check the information again');
                    }
                    break;
                case 'Delete':
                    $res = $this->destroy($id);
                    if($res){
                        return response()->json(['success' => 1, 'success_message' => 'Record deleted succefully'], 200);
                    }else{
                        return response()->json(['success' => 0, 'success_message' => 'Request unsuccefull'], 200);
                    }
                    break;
                case 'Edit':
                    $res = $this->update($request, $id);
                    if($res) {
                        return redirect()->back()->with('success_message', 'Record updated successfully ');
                    } else {
                        return redirect()->back()->with('success_message', 'Something went wrong, package details not updated');
                    }
                    break;
                default;
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {


        if(!is_string($data['image'])) {
            $file_path = Storage::disk('accountsdocs')->putFileAs('PASSENGER', $data->file('image'), $data->image->getClientOriginalName());
        } else {
            $file_path = $data['image'];
        }

        $passenger = new Passenger();

        $passenger->first_name = $data['first_name'];
        $passenger->last_name = $data['last_name'];
        $passenger->email = $data['email'];
        $passenger->phone = $data['phone'];
        $passenger->password = $data['password'];
        $passenger->type = $data['type'];
        $passenger->card_id = $data['cid'];
        $passenger->status = '1';
        $passenger->balance = '1000';
        $passenger->avatar_path = $file_path;

        return $passenger->save();
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $id)
    {
        $passenger = Passenger::where('passenger_id', $id)->first();

        if(!is_string($data['image'])){
            if($data->hasfile('image')){
                if(!Storage::disk('accountsdocs')->exists('PASSENGER/'.$data->file('image')->getClientOriginalName())){
                    $file_path = Storage::disk('accountsdocs')->putFileAs('PASSENGER', $data->file('image'), $data->image->getClientOriginalName());
                }else{
                    $file_path = 'PASSENGER/'.$data->file('image')->getClientOriginalName();
                }
                $passenger->avatar_path = $file_path;
            }
        } else {
            $passenger->avatar_path = $data['image'];
        }

        $passenger->first_name = $data['first_name'];
        $passenger->last_name = $data['last_name'];
        $passenger->email = $data['email'];
        $passenger->phone = $data['phone'];
        $passenger->password = $data['password'];
        $passenger->type = $data['type'];
        $passenger->card_id = $data['cid'];
        $passenger->status = $data['status'];

        return $passenger->save();
    }

    public function changePassengerStatus(Request $request){
        $id = $request->id;
        $status = $request->status;


        if($status == '1'){
            $status = '0';
        }elseif($status == '0'){
            $status = '1';
        }

        $res = Passenger::where('passenger_id',$id)->update(['status' => $status]);

        return response()->json(['success' => 1, 'success_message' => 'Passenger edited succefully'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Passenger::where('passenger_id', $id)->delete();
        return $result;
    }

    public function loadModal(Request $request)
    {
        return view('reports.passenger.index');
    }

    public function generatePassengerReport(Request $request)
    {
        $data['from'] = $request->from;
        $data['to'] = $request->to;
        $passenger_service = new PassengerService();
        $data['result'] = $passenger_service->getPassengersByDate($request->all());

        $name = 'Passenger Report to '. date('Y-m-d') .'.pdf';
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('reports.passenger.report',['data' => $data]);
        return $pdf->stream($name);
    }
}
