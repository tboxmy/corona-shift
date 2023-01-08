<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }

    public function getDepartments(Request $request)
    {
        //
        $depts = new Department();
        $length = $request->length??10;
        $start = $request->start??0;
        $orderColumn = "name";
        $recordsTotal = clone $depts;
        $recordsTotal = $recordsTotal->count();
        if ($request->has('search')) {
            $searchWord = $request->search;
            $depts = $depts->where('name', 'Like', '%' . $searchWord . '%');
        }
        $recordsFiltered = clone $depts;
        $recordsFiltered = $recordsFiltered->count();
        $depts = $depts->with('managedBy')->orderBy($orderColumn, 'ASC')->offset($start)->limit($length);
        $depts = $depts->get();
        $data = [
            'start'=>$start,
            'length'=>$length,
            'recordsTotal'=>$recordsTotal,
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$depts,
        ];
        // return response($data, 200);
        return view('admin.department.index', compact('data'));
    }
}
