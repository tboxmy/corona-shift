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
            $departments = Department::where('is_shift', true)->get()->pluck('id');
            $departmentsCode = Department::where('is_shift', true)->get()->pluck('code');
        } else {
            Log::debug('#departments');
            $departments = Department::where('code', $request->dept)->where('is_active', true)
                ->where('is_shift', true)->get()->pluck('id');
            $departmentsCode = Department::where('code', $request->dept)->where('is_active', true)
            ->where('is_shift', true)->first()->pluck('code');
        }
        Log::debug('#departments');
        // Log::debug($departmentsCode);
        if (count($departments)>0) {
            $shifts = DepartmentUsers::whereIn('department_id', $departments)
            ->get()->pluck('user_id');
            Log::debug($shifts);
            $shiftUsers = User::whereIn('id', $shifts)->select(['*', DB::raw("'{$departmentsCode}' as dept")])
            ->get();

            Log::debug($shiftUsers);
            // $users = User::whereIn('id', $shiftUsers)->get();
            $json_data = ['data'=>$shiftUsers];
            Log::debug('Received request');
            Log::debug($request);
            return response(json_encode($json_data), 200);
        }

        return response(json_encode(['message'=>'failed']), 400);
    }
}
