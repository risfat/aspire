<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();
        if(!$user)
        {
            $user = new User();
            $user->first_name = 'Jason';
            $user->last_name = 'Momoa';
            $user->email = 'demo@Aspire.com';
            $user->password = Hash::make('123456');
            $user->save();

        }

        $data = [
            'company_name'=> 'Aspire'
        ];

        foreach($data as $key=>$value){

            $setting =  new Setting();

            $setting->key = $key;
            $setting->value = $value;
            $setting->save();
        }
    }
}
