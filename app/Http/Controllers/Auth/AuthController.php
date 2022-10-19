<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function sendOTP(Request $request)
    {

        $request->validate([
            'phone_no' => 'required|exists:users,phone_no'
        ]);

        $phone_no = env('COUNTRY_CODE').$request->phone_no;

        if(\Auth::check() && \Auth::user()->type == 0) {
            $phone_no = env('COUNTRY_CODE').\Auth::user()->phone_no;
        }

        if(sendOTP($phone_no))
        {
            \Session::put('phone_no', $request->phone_no);
            return redirect()->route('login');
        }

        return back()->with('error', __('Something Went Wrong'));

    }

    public function verifyOTP(Request $request)
    {
        $phone_no = env('COUNTRY_CODE').\Session::get('phone_no');
        if(\Auth::check() && \Auth::user()->type == 0) {
            $phone_no = env('COUNTRY_CODE').\Auth::user()->phone_no;
        }

        if(verifyOTP($request->otp, $phone_no))
        {
            $user = User::where('phone_no', \Session::get('phone_no'))->first();
            \Auth::login($user);
            if(\Auth::user()->type == 1) {
                return redirect()->route('dashboard');
            }
            return redirect()->route('dashboard');
        }

        return back()->with('error', __('Invalid OTP'));
    }
}
