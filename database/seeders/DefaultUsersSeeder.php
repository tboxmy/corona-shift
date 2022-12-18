<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserProfile;

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
        // Users
        $users = [['admin','admin@localhost','administrator']
        ,['user01','user01@localhost','user1']
        ,['user02','user02@localhost','user2']
        ,['user03','user03@localhost','user3']
        ];
        foreach ($users as $item) {
            $user = User::create(
                ['name'=>$item[0],
                'email'=>$item[1],
                'password' => Hash::make($item[2]),
                'created_at'=>Carbon::now(),
                'updated_at'=>null]
            );
            UserProfile::create(
                ['user_id'=>$user->id,
                 'hourly_rate'=>1000,
                 'timezone'=>'Asia/Kuala_Lumpur',
                 'currency'=>'MYR']
            );
        }
    }
}
