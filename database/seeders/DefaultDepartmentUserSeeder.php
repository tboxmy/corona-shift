<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

use App\Models\Department;
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
        $users = [['user01@localhost']
        ,['user02@localhost']
        ,['user03@localhost']
        ];
        $department = Department::create(
            ['code'=>'hq'
             ,'name'=>'Headquarters'
             ,'is_shift'=>true
             ,'description'=>'Default department']
        );
        foreach ($users as $item) {
            $user = User::where('email', $item[0])->first();
            if ($user!=null) {
                DepartmentUsers::create(
                    ['department_id'=>$department->id,
                    'user_id'=>$user->id,
                    'created_at'=>Carbon::now(),
                    'updated_at'=>null]
                );
            }
        }
    }
}
