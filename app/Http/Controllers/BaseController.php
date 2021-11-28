<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    protected $settings;
    protected $user;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $settings_data = Setting::all();
            $settings = [];

            foreach($settings_data as $setting){
                $settings[$setting->key] = $setting->value;

            }

            if($this->user->language)
            {
                App::setLocale($this->user->language);
            }

            $this->settings = $settings;
            View::share('settings',$settings);
            View::share('user',$this->user);


            return $next($request);
        });
    }
}
