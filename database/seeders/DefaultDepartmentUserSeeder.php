<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\DepartmentUsers;
use App\Models\User;

class DefaultDepartmentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [['hq','user01@localhost']
        ,['hq','user02@localhost']
        ];
        foreach ($users as $item) {
            $user = User::where('email', $item[1])->first();
            if ($user!=null) {
                print_r($user);
                DepartmentUsers::create(
                    ['code'=>$item[0],
                    'user_id'=>$user->id,
                    'is_shift'=>true,
                    'created_at'=>Carbon::now(),
                    'updated_at'=>null]
                );
            }
        }
    }
}
