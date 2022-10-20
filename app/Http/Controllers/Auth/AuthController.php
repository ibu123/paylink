<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Merchant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

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

    public function reSendOTP(Request $request)
    {

        $requestPhoneNo = env('COUNTRY_CODE').\Session::get('phone_no');

        if(\Auth::check() && \Auth::user()->type == 0) {
            $phone_no = env('COUNTRY_CODE').\Auth::user()->phone_no;
        }

        if(sendOTP($phone_no))
        {
            \Session::put('phone_no', $requestPhoneNo);
            return redirect()->route('login');
        }

        return back()->with('error', __('Something Went Wrong'));

    }

    public function verifyOTP(Request $request)
    {

        $request->validate([
            "otp" => "required|digits:4",
            "store" => Rule::requiredIf(\Session::get('has_store') == 1)
        ]);

        $phone_no = env('COUNTRY_CODE').\Session::get('phone_no');
        if(\Auth::check() && \Auth::user()->type == 0) {
            $phone_no = env('COUNTRY_CODE').\Auth::user()->phone_no;
        }
        \Auth::logout();
        if(verifyOTP($request->otp, $phone_no))
        {
            $user = User::where('phone_no', \Session::get('phone_no'))->first();
            \Auth::login($user);
            if(\Auth::user()->type == 1) {
                return redirect()->route('merchant.dashboard');
            }
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', __('Invalid OTP'));
    }

    public function login() {
        $user = User::where('phone_no', \Session::get('phone_no'))->firstOrFail();
        $stores = Merchant::where('user_id', $user->id)->get();
        if($stores->isNotEmpty() && $stores->count() > 1) {
            \Session::put('has_store' , 1);
        } else {
            \Session::put('has_store' , 0);
            $stores = collect([]);
        }
        return view('admin.otp', compact('stores'));
    }

    public function logout() {
        \Session::forget('phone_no');
        \Session::forget('has_store');
        \Auth::logout();
        return redirect()->route('home');
    }
}
