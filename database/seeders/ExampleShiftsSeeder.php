<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Shift;
use App\Models\ShiftType;
use App\Models\ShiftUser;
use App\Models\User;

class ExampleShiftsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $today = Carbon::now();
        $today->hour = 8;
        $today->minute = 00;
        $end = clone $today;
        $end->hour = 17;
        $end->minute = 00;
        $shiftType = ShiftType::where('name', '9HRS')->first();
        $shifts = [[$shiftType->name, 'Demo '.$shiftType, $shiftType->id, null, null, 'user01']
        , [$shiftType->name, 'Demo '.$shiftType, $shiftType->id, null, null, 'user01']
        , [$shiftType->name, 'Demo '.$shiftType, $shiftType->id, null, null, 'user02']
        ];
        foreach ($shifts as $item) {
            $user = User::where('name', $item[5])->first();
            $record = Shift::create(
                ['name'=>$item[0],
                'description'=>$item[1],
                'shift_type_id' => $item[2],
                'region_id' => 0,
                'start'=>$today,
                'end' => $end]
            );
            $today->modify('+1 days');
            $end->modify('+1 days');
            ShiftUser::create(
                ['shift_id' => $record->id,
                'user_id' => $user->id,
                'department_code' => "hq",
                ]
            );
        }
    }
}
