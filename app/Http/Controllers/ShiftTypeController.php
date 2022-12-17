<?php

namespace App\Http\Controllers;

use App\Models\ShiftType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShiftTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    public function getShiftTypes(Request $request)
    {
        //
        $shiftTypes = new ShiftType();
        $length = $request->length??10;
        $start = $request->start??0;
        $orderColumn = "name";
        $recordsTotal = clone $shiftTypes;
        $recordsTotal = $recordsTotal->count();
        if ($request->has('search')) {
            $searchWord = $request->search;
            $shiftTypes = $shiftTypes->where('name', 'Like', '%' . $searchWord . '%');
        }
        $recordsFiltered = clone $shiftTypes;
        $recordsFiltered = $recordsFiltered->count();
        $shiftTypes = $shiftTypes->orderBy($orderColumn, 'ASC')->offset($start)->limit($length);
        $shiftTypes = $shiftTypes->get();
        $data = [
            'start'=>$start,
            'length'=>$length,
            'recordsTotal'=>$recordsTotal,
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$shiftTypes,
        ];
        return view('shiftTypes.index', compact('data'));
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
     * @param  \App\Models\ShiftType  $shiftType
     * @return \Illuminate\Http\Response
     */
    public function show(ShiftType $shiftType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShiftType  $shiftType
     * @return \Illuminate\Http\Response
     */
    public function edit(ShiftType $shiftType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShiftType  $shiftType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShiftType $shiftType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShiftType  $shiftType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShiftType $shiftType)
    {
        //
    }
}
