<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use PragmaRX\Google2FA\Google2FA;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // $credentials = $request->only('email', 'password');
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_role' => $user->role,
                'modal_shown' => 1,

            ]);

            if ($user->role == 2) {

                return redirect()->route('user.list');

            } else if ($user->two_factor_enabled == 1) {

                return redirect()->route('otpvarify.form');

            } else {
                // Redirect to the intended page or home
                return redirect()->intended('dashboard');
            }
        }
            return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function disableModal(Request $request)
    {
        session(['modal_shown' => 0]);
        return response()->json(['status' => 'success']);
    }

    public function showOtpForm()
    {
        return view('auth.twofactorform');
    }

    public function userverifyOtp(Request $request)
    {
            $otpCode = $request->input('otpservarify');
            $google2fa = new Google2FA();
            $secret = Auth::user()->google2fa_secret;
            
            // Verify OTP code
            $valid = $google2fa->verifyKey($secret, $otpCode);

        if ($valid) {
            // OTP is valid, proceed with the login
            return redirect()->intended('dashboard');
        } else {
            return redirect()->back()->withErrors(['otp' => 'The provided OTP is invalid.']);
        }
    }

    private function isValidOtp($otp)
    {
        // Implement your OTP validation logic here
        return true; // Placeholder: Replace with actual OTP validation logic
    }


    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }

    public function saveClient(Request $request)
    {
        Session(['client_id' => $request->client_id]);

        return response()->json(['success' => true]);
    }


}
