<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Models\ShiftUser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Carbon::now()->timezone('Asia/Kuala_Lumpur');
        $user = Auth::user();
        if ($user==null) {
            dd('Not authenticated');
        }
        Log::debug($today);
        $shifts = ShiftUser::where('user_id', $user->id)
        ->where('start', '>=', $today->startOfDay())->get();
        $shiftTodayRow = ShiftUser::where('user_id', $user->id)
        ->whereDate('start', $today)->orderBy('created_at', 'DESC')->get();
        $shiftToday = [];
        Log::debug($shiftTodayRow);
        foreach ($shiftTodayRow as $row) {
            //

            $data = null;
            $data['date']=Carbon::parse($row->start)->format("d-m-Y");
            $data['timeStart']=Carbon::parse($row->start)->format("h:i A");
            if (Carbon::parse($row->start)->diffInDays($row->end) == 0) {
                $data['timeEnd']=Carbon::parse($row->end)->format("h:i A");
            } else {
                $data['timeEnd']=Carbon::parse($row->end)->format("h:i A (d-m)");
            }
            $data['description']=$row->description??null;
            $data['clock_in']=$row->clockin_at??null;
            $data['clock_out']=$row->clockout_at??null;
            $xount = array_push($shiftToday, $data);
        }
        $shiftUpcomingRow = ShiftUser::where('user_id', $user->id)
        ->whereDate('start', '>', $today->startOfDay())->orderBy('created_at', 'DESC')->get();
        $shiftUpcoming = [];
        if ($shiftUpcomingRow != null) {
            $row=$shiftUpcomingRow;
            foreach ($shiftUpcomingRow as $row) {
                $data = null;
                $data['date']=Carbon::parse($row->start)->format("d-m-Y");
                $data['timeStart']=Carbon::parse($row->start)->format("h:i A");
                if (Carbon::parse($row->start)->diffInDays($row->end) == 0) {
                    $data['timeEnd']=Carbon::parse($row->end)->format("h:i A");
                } else {
                    $data['timeEnd']=Carbon::parse($row->end)->format("h:i A (d-m)");
                }
                $data['description']=$row->description??null;
                $xcount = array_push($shiftUpcoming, $data);
            }
        }

        return view('home', compact('shiftToday', 'shiftUpcoming', 'shifts', 'user'));
    }
    public function viewUserDay()
    {
        return view('events.index2');
    }
    public function viewDayHours()
    {
        return view('events.index3');
    }
    public function getUserShiftByDate(Request $request)
    {
        $user = Auth::user();
        Log::debug($request);
        $selectedDate = Carbon::createFromFormat('d/m/Y', $request->start);
        Log::debug($selectedDate);
        $shifts = ShiftUser::where('user_id', $user->id)->whereNotNull('published_at')
        ->whereDate('start', '=', $selectedDate->startOfDay())->get();
        Log::debug($shifts);
        $json_data = ['data'=>$shifts];
        return response(json_encode($json_data), 200);
    }
    public function adminHome()
    {
        return view('admin.adminHome');
    }
}
