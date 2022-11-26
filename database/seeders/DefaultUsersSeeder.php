<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DefaultUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Timeoff Types
        $users = [['admin','admin@localhost','administator']
        ,['user01','user01@localhost','user1']
        ,['user02','user02@localhost','user2']
        ];
        foreach ($users as $item) {
            User::create(
                ['name'=>$item[0],
                'email'=>$item[1],
                'password' => Hash::make($item[2]),
                'created_at'=>Carbon::now(),
                'updated_at'=>null]
            );
        }
    }
}
