<?php

namespace App\Http\Controllers;

use App\Models\TimeoffType;
use Illuminate\Http\Request;

class TimeoffTypeController extends Controller
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

    public function getTimeoffTypes(Request $request)
    {
        //
        $timeoffTypes = new TimeoffType();
        $length = $request->length??10;
        $start = $request->start??0;
        $orderColumn = "name";
        $recordsTotal = clone $timeoffTypes;
        $recordsTotal = $recordsTotal->count();
        if ($request->has('search')) {
            $searchWord = $request->search;
            $timeoffTypes = $timeoffTypes->where('name', 'Like', '%' . $searchWord . '%');
        }
        $recordsFiltered = clone $timeoffTypes;
        $recordsFiltered = $recordsFiltered->count();
        $timeoffTypes = $timeoffTypes->orderBy($orderColumn, 'ASC')->offset($start)->limit($length);
        $timeoffTypes = $timeoffTypes->get();
        $data = [
            'start'=>$start,
            'length'=>$length,
            'recordsTotal'=>$recordsTotal,
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$timeoffTypes,
        ];
        return view('timeoffTypes.index', compact('data'));
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
     * @param  \App\Models\TimeoffType  $timeoffType
     * @return \Illuminate\Http\Response
     */
    public function show(TimeoffType $timeoffType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimeoffType  $timeoffType
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeoffType $timeoffType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TimeoffType  $timeoffType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeoffType $timeoffType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeoffType  $timeoffType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeoffType $timeoffType)
    {
        //
    }
}
