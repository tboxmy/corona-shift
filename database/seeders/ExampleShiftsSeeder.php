<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Department;
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
        // Default to start at 8:00AM
        $today = Carbon::now();
        $today->hour = 8;
        $today->minute = 00;
        $today->second = 00;
        $end = clone $today;
        $shiftType = ShiftType::where('name', '9HRS')->first();
        $end->addMinutes($shiftType->duration);
        $shifts = [[$shiftType->name, 'Demo '.$shiftType->name, $shiftType->id, null, $shiftType, 'user01']
        , [$shiftType->name, 'Demo '.$shiftType->name, $shiftType->id, null, $shiftType, 'user01']
        , [$shiftType->name, 'Demo '.$shiftType->name, $shiftType->id, null, $shiftType, 'user02']
        ];
        $planner = User::where('name', 'planner')->first();
        $dept = Department::where('code', 'hq')->first();
        foreach ($shifts as $item) {
            $user = User::where('name', $item[5])->first();
            $record = Shift::create(
                ['name'=>$item[0],
                'description'=>$item[1],
                'shift_type_id' => $item[2],
                'region_id' => 0,
                'options' => json_encode($item[4]),
                'start'=>$today,
                'end' => $end,
                'published_at'=>$today,
                'published_by'=>$planner->id]
            );
            $today->modify('+1 days');
            $end->modify('+1 days');
            ShiftUser::create(
                ['shift_id' => $record->id,
                'user_id' => $user->id,
                'department_id' => $dept->id,
                'department_code' => $dept->code,
                'start'=>$today,
                'end' => $end,
                ]
            );
        }
    }
}
