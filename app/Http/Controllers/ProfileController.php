<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Providers\RouteServiceProvider;
use App\Services\OTPSend;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function mobileVerify(Request $request)
    {


        $user = auth()->user();

        if ($user->mobile_verified_at != NULL) {
            return redirect()->route('dashboard');
        }
        return view('profile.verify', [
            'user' => $request->user(),
        ]);

    }


    public function doMobileVerify(Request $request)
    {


        $user = auth()->user();

        if ($user->mobile_verified_at != NULL) {
            return redirect()->route('dashboard');
        }


        $request->validate(['otp' => 'required|numeric|digits:4']);


        $otp_session = session()->get('otp_session');


        $otpSend = new OTPSend();
        // $user = $request->user();
        $dialCode = str_replace('+', '', $user->dial_code);


        $otpVerify = $otpSend->verifyOTP($dialCode, $user->mobile, $otp_session['verifyId'], $request->otp);


        if ($otpVerify == true) {
            $user->mobile_verified_at = now();
            $user->save();
            session()->forget('otp_session');
            return redirect(RouteServiceProvider::HOME);

        } else {
            return back()->withInput()->withErrors(['otp' => 'Invalid OTP / OTP time out']);
        }



    }
}
