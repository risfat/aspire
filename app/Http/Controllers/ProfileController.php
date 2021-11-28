<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends BaseController
{
    //

    public function profile( Request $request)
    {


        $available_languages = User::$available_languages;
        return \view('profile.profile',[
            'selected_navigation' => 'profile',
            'available_languages' => $available_languages,
        ]);




    }


    public function profilePost(Request $request)
    {
        $request->validate([

            'first_name'=>'nullable|string|max:100',
            'last_name'=>'nullable|string|max:100',
            'photo' => 'nullable|file|mimes:jpg,png',



        ]);

        if(config('app.env') === 'demo')
        {

            return redirect('/profile')->withErrors([
                'password' => 'Disabled in the Demo mode.'
            ]);

        }

        $user  = $this->user;


        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->language = $request->language;
        $path = false;
        if($request->photo)
        {
            $path = $request->file('photo')->store('public');
            $path = str_replace('public/','',$path);


        }
        $user->photo = $path;

        $user->phone_number = $request->phone_number;
        $user->save();


        return redirect('/profile');
    }


    public function staff()
    {

        $staffs = User::all();

        return \view('profile.staff',[
            'selected_navigation' => 'team',
            'staffs' => $staffs
        ]);



    }


    public function newUser(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
        ]);
        $countries = countries();

        $selected_user = false;

        if($request->id)
        {
            $selected_user = User::find($request->id);
        }

        return \view('profile.new-user',[
            'selected_navigation' => 'staff',
            'selected_user'=> $selected_user,
            'countries'=> $countries,

        ]);



    }

    public function userPost(Request $request)
    {
        $request->validate([

            'first_name'=>'nullable|string|max:100',
            'last_name'=>'nullable|string|max:100',
            'email'=>'required|email',
            'phone'=>'nullable|string|max:50',
            'password'=>'required|string|max:50',
            'id'=>'nullable|integer',


        ]);


        $user = false;

        if($request->id)
        {
            $user = User::find($request->id);
        }




        if(!$user)
        {
            $user = new User();
        }


        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->mobile_number = $request->mobile_number;
        $user->twitter = $request->twitter;
        $user->facebook = $request->facebook;
        $user->linkedin = $request->linkedin;
        $user->address_1 = $request->address_1;
        $user->address_2 = $request->address_2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->language = $request->language;
        $user->zip = $request->zip;
        $user->save();




        return redirect('/staff');
    }



    public function userEdit($id)
    {
        $selected_user = User::find($id);
        $countries = countries();

        if ($selected_user){



            return \view('profile.new-user',[
                'selected_user'=> $selected_user,
                'countries'=> $countries,


            ]);


        }

    }


    public function userChangePasswordPost(Request $request)
    {

        if(config('app.env') === 'demo')
        {

            return redirect('/profile')->withErrors([
                'password' => 'Disabled in the Demo mode.'
            ]);

        }

        $request->validate([
            'password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        $user = $this->user;

        if(!Hash::check($request->password,$user->password))
        {
            return redirect('/profile')->withErrors([
                'password' => 'Incorrect old password.'
            ]);
        }

        if(config('app.environment') !== 'demo')
        {
            $user->password = Hash::make($request->new_password);
            $user->save();
        }




        return redirect('/profile');
    }
}
