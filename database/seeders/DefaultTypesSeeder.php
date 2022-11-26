<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Occasion;
use App\Models\ShiftType;
use App\Models\TimeoffType;
use Carbon\Carbon;

class DefaultTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Timeoff Types
        $timeoffTypes = [['AL','Annual Leave']
        ,['CL','Compasionate Leave']
        ,['EL','Emergency Leave']
        ,['MAT','Maternity Leave']
        ,['ML','Medical Leave']
        ];
        foreach ($timeoffTypes as $item) {
            TimeoffType::create(
                ['name'=>$item[0],
                'description'=>$item[1],
                'created_at'=>Carbon::now(),
                'updated_at'=>null]
            );
        }

        //Shift Type
        $shiftTypes = [['9HRS','9 hours with break',540,60]
        ,['12HRS','12 hours with break',720,60]
        ];
        foreach ($shiftTypes as $item) {
            ShiftType::create(
                ['name'=>$item[0],
                'description'=>$item[1],
                'duration'=>$item[2],
                'breaks'=>$item[3],
                'created_at'=>Carbon::now(),
                'updated_at'=>null]
            );
        }

        //Occasion Type
        $occasions = [['NYD','New Year day',true,'2022-1-1','created_at'=>Carbon::now()]
        ,['LABOUR','Labour day',true,'2022-5-1','created_at'=>Carbon::now()]
        ,['RANDOM','PM10',false,'2022-11-28','created_at'=>Carbon::now()]
        ];
        foreach ($occasions as $item) {
            Occasion::create(
                ['name'=>$item[0],
                'description'=>$item[1],
                'annual'=>$item[2],
                'date'=>$item[3],
                'created_at'=>Carbon::now(),
                'updated_at'=>null]
            );
        }
    }
}
