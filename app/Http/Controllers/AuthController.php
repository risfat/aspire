<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{
    //
    protected $settings;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $settings_data = Setting::all();
            $settings = [];

            foreach($settings_data as $setting){
                $settings[$setting->key] = $setting->value;

            }
            $this->settings = $settings;
            View::share('settings',$settings);




            return $next($request);
        });
    }

    public function login()
    {
        if(Auth::check())
        {
            return redirect('/dashboard');
        }

        return \view('auth.login');
    }
    public function passwordReset(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'token' => 'required|uuid',
        ]);

        $user = User::find($request->id);

        if(!$user)
        {
            return redirect('/')->withErrors([
                'key' => 'Invalid user or link expired',
            ]);
        }

        if($user->password_reset_key !== $request->token)
        {
            return redirect('/')->withErrors([
                'key' => 'Invalid key',
            ]);
        }

        return \view('auth.reset-password',[
            'id' => $request->id,
            'password_reset_key' => $request->token,
        ]);
    }

    public function signup()
    {
        return \view('auth.signup');
    }
    public function forgotPassword()
    {
        return \view('auth.forgot-password');
    }

    public function resetPasswordPost(Request $request)
    {


        $request->validate([
            'email'=>'required|email'
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user)
        {
            return redirect()->back()->withErrors([
                'email' => 'No account found with this email',
            ]);
        }

        $user->password_reset_key = Str::uuid();
        $user->save();


        Mail::to($user->email)->send(new PasswordReset($user));


        session()->flash('status','We sent you an email with the instruction to reset the password.');

        return redirect('/');
    }


    public function newPasswordPost(Request $request)
    {


        $request->validate([
            'password'=>'required|confirmed',
            'id' => 'required|integer',
            'password_reset_key' => 'required|uuid',
        ]);

        $user = User::find($request->id);

        if(!$user)
        {
            return redirect()->back()->withErrors([
                'email' => 'No account found with this email',
            ]);
        }

        if($user->password_reset_key !== $request->password_reset_key)
        {
            return redirect()->back()->withErrors([
                'key' => 'Invalid key',
            ]);
        }

        $user->password = Hash::make($request->password);

        $user->password_reset_key = null;

        $user->save();


        session()->flash('status','Your password has been reset, login with the new password.');

        return redirect('/');
    }









    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = false;

        if($request->remember)
        {
            $remember = true;
        }

        if (Auth::attempt($credentials,$remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
