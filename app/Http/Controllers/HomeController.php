<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\StorePresenceRequest;
use Carbon\Carbon;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $presences = Presence::where('employee_id' , $user_id )->get();
        $start = Carbon::now();
        $end = Carbon::now();
        $emp_id = Auth::id();
        return view('home',compact('start','emp_id','end','presences'));
    }


}
