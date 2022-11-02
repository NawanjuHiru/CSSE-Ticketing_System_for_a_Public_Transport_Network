<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Services\CardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    /**
     * Display a listing of the cards and search filter.
     */
    public function index(Request $request)
    {
        $action = $request->action;
        $card_Service = new CardService();

        if ($request->ajax()) {
            $card_data = $card_Service->getAllCards();
            return datatables()->of($card_data)
            ->addColumn('cardId', function ($row) {
                return $row->cardId;
            })
            ->addColumn('cardName', function ($row) {
                return $row->cardName;
            })
            ->addColumn('charge', function ($row) {
                return 'Rs. '.$row->charge. ' .00';
            })
            ->addColumn('validity', function ($row) {
                return $row->validity;
            })
            ->addColumn('availability', function ($row) {
                if($row->availability == 'Yes'){
                    return '<div class="main-toggle main-toggle-success on tog" data-status = "'.$row->availability.'" data-routeid = "'.$row->cardId.'"><span></span></div>';
                }else{
                    return '<div class="main-toggle main-toggle-success tog" data-status = "'.$row->availability.'" data-routeid = "'.$row->cardId.'"><span></span></div>';
                }
            })
            ->addColumn('action', function ($row) {
                $delete = '<a data-placement="top" data-toggle="tooltip-primary" title="Delete" data-routeid = "'.$row->cardId.'" ><i class="fas fa-trash-alt text-danger fa-lg delete"></i></a> ';
                $edit = ' <a href="' . route('card_view',['action' => 'edit','id' => $row->cardId]) . '" data-toggle="tooltip-primary" title="Edit"><i class="fas fa-edit text-warning fa-lg" data-placement="top"></i></a>';
                return $edit.' '.$delete;
            })
            ->rawColumns(['action','availability'])

            ->make(true);
        }

        return view('cards.index');
    }

    /**
     * Show the card view interfaces.
     * Action ('add','delete','edit')
     */
    public function view(Request $request){
        $action = $request->action;
        $id = $request->id;
        switch($action){
            case 'add' :
                return view('cards.create',compact('action'));
                break;
            case 'edit' :
                $data['cards'] = Card::where('cardId',$id)->first();
                return view('cards.create',compact('action','data'));
                break;

        }
    }

    /**
     * Validate the card form.
     * Action ('add','delete','edit')
     */
    public function create(Request $request)
    {
        $action = $request->action;
        $id = $request->id;
        $data = $request->all();

        if($action == 'add' || $action == 'edit'){
            $rules = [
                'cardName' => 'required',
                'charge' => 'required',
                'validity' => 'required',
            ];
        }else{
            $rules = [];
        }

        $validatedData = Validator::make(
            $request->all(),
            $rules,
            [
                'cardName.required' => 'This card name field is required',
                'charge.required' => 'This charge per KM  field is required',
                'validity.required' => 'This validity period point field is required',
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
                        return redirect(route('card_index',['action' => '']))->with('success_message', 'Card created succefully.');
                    }else{
                        return redirect()->back()->with('error_message', 'Request unsuccefull.');
                    }
                    break;
                case 'edit':
                    $res = $this->update($data,$id);
                    if($res){
                        return redirect()->back()->with('success_message', 'Card edited succefully.');
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
     * Store a newly created card in storage.
     */
    public function store($data)
    {
        $res = new Card();
        $res->cardName = $data['cardName'];
        $res->charge = $data['charge'];
        $res->validity = $data['validity'];
        $res->availability = 'Yes';

        if(isset($data['localp'])){
            $res->localp = 1;
        }else{
            $res->localp = 0;
        }

        if(isset($data['foreignp'])){
            $res->foreignp = 1;
        }else{
            $res->foreignp = 0;
        }

        return $res->save();
    }

    /**
     * Update the specified card in storage.
     *
     */
    public function update($data, $id)
    {
        $res = Card::where('cardId',$id)->first();
        $res->cardName = $data['cardName'];
        $res->charge = $data['charge'];
        $res->validity = $data['validity'];
        $res->availability = 'Yes';

        if(isset($data['localp'])){
            $res->localp = 1;
        }else{
            $res->localp = 0;
        }

        if(isset($data['foreignp'])){
            $res->foreignp = 1;
        }else{
            $res->foreignp = 0;
        }

        return $res->save();

    }

    /**
     * Remove the specified card from storage.
     */
    public function destroy($id)
    {
        $res = Card::where('cardId',$id)->first();
        return $res->delete();
    }

    /**
     * Update the specified route status in storage.
     */
    public function changeAvailabilityStatus(Request $request){
        $id = $request->id;
        $status = $request->status;

        $res = Card::where('cardId',$id)->first();

        if($status == 'Yes'){
            $res->availability = 'No';
        }elseif($status == 'No'){
            $res->availability = 'Yes';
        }
        $res->save();

        return response()->json(['success' => 1, 'success_message' => 'Route edited succefully'], 200);
    }
}
