<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentUsers;
use App\Models\Shift;
use App\Models\ShiftUser;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use DB;

use Response;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift)
    {
        //
    }

    public function getShifts(Request $request)
    {
    }
    public function getDepartmentUsers(Request $request)
    {
        // Ajax calls
        $dept=$request->dept??null;
        if (isset($dept)) {
            $dept = Department::where('code', $dept)->latest()->pluck('id');
        } else {
            return null;
        }
        Log::debug($dept);
        Log::debug($request);
        if ($dept == null) {
            Log::debug('#dept=null');
            $departments = null;
        } else {
            Log::debug('#departments');
            $department = Department::where('code', $request->dept)
                ->where('is_shift', true)->first();
            $departmentsCode = Department::where('code', $request->dept)->where('is_active', true)
                ->where('is_shift', true)->get();
        }
        Log::debug('#departments');
        // Log::debug($departmentsCode);
        if ($department != null) {
            $shifts = DepartmentUsers::where('department_id', $department->id)
            ->get()->pluck('user_id');
            $shiftUsers = User::whereIn('id', $shifts)->select(['*', DB::raw("'{$departmentsCode}' as dept")])
            ->get();

            Log::debug($department);
            // $users = User::whereIn('id', $shiftUsers)->get();
            $json_data = ['data'=>$shiftUsers, 'dept'=>$department,
                'departments'=>$departmentsCode];
            Log::debug('Received request');
            Log::debug($request);
            return response(json_encode($json_data), 200);
        }

        return response(json_encode(['status'=>1, 'message'=>'failed']), 400);
    }
}
