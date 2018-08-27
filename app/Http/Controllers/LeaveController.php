<?php

namespace App\Http\Controllers;
use App\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLeavesRequest;
use App\Http\Requests\Admin\UpdateLeavesRequest;

class LeaveController extends Controller
{

    public function index()
    {
        $id = Auth::id();
        $leaves = Leave::where('employee_id' ,'=',$id)->get();
        return view('employee.leaves.index',compact('leaves'));


    }

    public function create()
    {
        return view('employee.leaves.create');

    }


    public function store(StoreLeavesRequest $request)
    {
        $leave = Leave::create($request->all());

        return redirect()->route('employee.leaves.index');

    }


    public function show($id)
    {
        $leave = Leave::findOrFail($id);

        return view('employee.leaves.show', compact('leave'));
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
