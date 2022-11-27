<?php

namespace App\Http\Controllers;

use App\Models\DepartmentUsers;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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
        if ($dept==null) {
            return null;
        }

        $shifts = DepartmentUsers::where('is_shift', true)->where('code', $request->dept)
        ->get()->pluck('user_id');
        $shiftUsers = DepartmentUsers::where('is_shift', true)
        ->whereIn('user_id', $shifts)
        ->join('users', 'department_users.user_id', '=', 'users.id')
        ->orderBy('users.name')
        ->get(['department_users.code as dept','users.id as id','users.name as name']);

        // $users = User::whereIn('id', $shiftUsers)->get();
        $json_data = ['data'=>$shiftUsers];
        Log::debug('Received request');
        Log::debug($request);
        return response(json_encode($json_data), 200);

        // return response(json_encode(['message'=>'failed']), 400);
    }
}
