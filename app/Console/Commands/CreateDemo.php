<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Models\Todo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = [
            'company_name'=> 'Aspire'
        ];

        foreach($data as $key=>$value){

            $setting = Setting::where('key',$key)->first();

            if(!$setting)
            {
                $setting =  new Setting();
                $setting->key = $key;
            }

            $setting->value = $value;
            $setting->save();

        }

        $today = date('Y-m-d');

        $todos = [
            [
                'title' => 'Write a Blog Post',
                'date' => $today,
            ],
            [
                'title' => 'Test 2',
                'date' => $today,
            ]
        ];

        DB::table('todos')->truncate();

        foreach ($todos as $create_todo)
        {
            $todo = new Todo();

        }

        return 0;
    }
}
