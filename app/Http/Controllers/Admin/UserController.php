<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserProfile;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
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

    public function getUsers(Request $request)
    {
        //
        $users = new User();
        $length = $request->length??10;
        $start = $request->start??0;
        $orderColumn = "name";
        $recordsTotal = clone $users;
        $recordsTotal = $recordsTotal->count();
        if ($request->has('search')) {
            $searchWord = $request->search;
            $users = $users->where('name', 'Like', '%' . $searchWord . '%');
        }
        $recordsFiltered = clone $users;
        $recordsFiltered = $recordsFiltered->count();
        $users = $users->with('userProfile', 'department')->orderBy($orderColumn, 'ASC')->offset($start)->limit($length);
        $users = $users->get();
        $data = [
            'start'=>$start,
            'length'=>$length,
            'recordsTotal'=>$recordsTotal,
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$users,
        ];
        // return response($data, 200);
        return view('admin.user.index', compact('data'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
