<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\ShiftUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ShiftUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $department = "hq";
        $departments = Department::with('shifts')->where('code', $department);
        $length = $request->length??10;
        $start = $request->start??0;
        $orderColumn = "name";
        $departmentUsers = clone $departments;
        $recordsTotal = clone $departments;
        $recordsTotal = $recordsTotal->count();
        if ($request->has('search')) {
            $searchWord = $request->search;
            $shiftTypes = $departments->where('name', 'Like', '%' . $searchWord . '%');
        }
        $recordsFiltered = clone $departments;
        $recordsFiltered = $recordsFiltered->count();
        $departmentUsers = Department::where('code', $department)->orderBy('name', 'ASC')->first()->users;
        $departmentShifts = $departments->first();
        $shifts = null;

        $shift_list = [
            'start'=>$start,
            'length'=>$length,
            'recordsTotal'=>$recordsTotal,
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$departmentShifts->shifts
        ];
        $users = null;
        foreach ($departmentUsers as $du) {
            $users[$du->id] = $du->name;
        }
        Log::debug($users);
        return view('shifts.index', compact('shift_list', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShiftUser  $shiftUser
     * @return \Illuminate\Http\Response
     */
    public function show(ShiftUser $shiftUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShiftUser  $shiftUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ShiftUser $shiftUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShiftUser  $shiftUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShiftUser $shiftUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShiftUser  $shiftUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShiftUser $shiftUser)
    {
        //
    }
    protected function getShift($userId=null, $isPublished=false, $days=1, $start=null)
    {
        //
        $user = User::find($userId);
        if ($user==null) {
            return null;
        }
        $userShifts = ShiftUser::where('user_id', $user->id)
        ->join('users', 'shift_users.user_id', '=', 'users.id')
        ->join('shifts', 'shift_users.shift_id', '=', 'shifts.id')
        ->join('shift_types', 'shifts.shift_type_id', '=', 'shift_types.id');
        if ($start != null) {
            $startDate=Carbon::parse($start);
            $userShifts = $userShifts->where('shifts.start', '>=', $startDate);
        }
        if ($isPublished==true) {
            $userShifts = $userShifts->whereNotNull('shifts.published_at');
        }
        $userShifts = $userShifts->orderBy('shifts.start')

        ->get(['shift_users.*','users.id as id','users.name as name'
        ,'shifts.name as shift_name','shifts.start as shift_start','shifts.end as shift_end'
        ,'shift_types.name as shift_type']);
        Log::debug("tbox: getShift");
        Log::debug($userShifts);
        return $userShifts;
    }
    public function getShiftByUserDate(Request $request)
    {
        // Ajax call
        $userId=$request->user_id??null;
        $results = null;
        $days = $request->days??7;
        $startDate = $request->startDate??null;
        Log::debug($request);
        if ($startDate != null) {
            Log::debug('#1 '.$startDate);
            $results = $this->getShift($userId, true, $days, $startDate);
        } else {
            Log::debug('#2');
            $results = $this->getShift($userId, true, $days);
        }

        $results = $this->getShift($userId, true);
        $json_data = [
            'data'=>$results
        ];
        return response(json_encode($json_data), 200);
    }
}
