<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\SmsProvider;
use Doctrine\Inflector\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class SettingController extends BaseController
{
    //
    public function settings()
    {


        return \view('settings.settings',[
            'selected_navigation' => 'settings',


        ]);
    }

    public function settingsPost(Request $request)
    {
        if(config('app.env') === 'demo')
        {

            return;

        }
        $request->validate([
            'company_name'=>'required|max:150',
            'logo' => 'nullable|file|mimes:jpg,png',

        ]);

        Setting::updateSettings('company_name',$request->company_name);
        if($request->logo)
        {
            $path = $request->file('logo')->store('public');
            $path = str_replace('public/','',$path);
            Setting::updateSettings('logo',$path);
        }



        return redirect('/settings');



    }

    public function recaptchaPost(Request $request)
    {


        Setting::updateSettings('recaptcha',$request->recaptcha);
        Setting::updateSettings('recaptcha_sitekey',$request->recaptcha_sitekey);
        Setting::updateSettings('recaptcha_secretkey',$request->recaptcha_secretkey);




        return redirect('/settings');



    }









}
