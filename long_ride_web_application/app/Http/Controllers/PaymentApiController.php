<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class PaymentApiController extends Controller
{
    /**
     * Update the balace ammount of the specified passenger in storage.
     */
    public function reload(Request $request){
        $user = Passenger::where('passenger_id',1)->first();
        $balance = $user->balance;
        $user->balance = ($balance + $request->post('balance'));
        if($user->save()){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }
}
