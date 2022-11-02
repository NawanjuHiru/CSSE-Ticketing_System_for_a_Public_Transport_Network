<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function index(Request $request)
    {
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];

        $validatedData = Validator::make(
            $request->all(),
            $rules,
            [
                'email.required' => 'This email field is required',
                'email.email' => 'Please enter a valid email',
                'password.required' => 'This password field is required',
            ]
        );

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData->errors());
        }else{
            if($request->email == 'longride@gmail.com' && $request->password == '123456'){
                return redirect(route('passenger_index',['type' => '']));
            }else{
                return redirect()->back()->withInput()->with('error_message', 'Email or password invalid.');
            }
        }
    }

}
