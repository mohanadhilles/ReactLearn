<?php

namespace App\Http\Controllers\Api\V1;

use App\Leave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLeavesRequest;
use App\Http\Requests\Admin\UpdateLeavesRequest;

class LeavesController extends Controller
{
    public function index()
    {
        return Leave::all();
    }

    public function show($id)
    {
        return Leave::findOrFail($id);
    }

    public function update(UpdateLeavesRequest $request, $id)
    {
        $leave = Leave::findOrFail($id);
        $leave->update($request->all());
        

        return $leave;
    }

    public function store(StoreLeavesRequest $request)
    {
        $leave = Leave::create($request->all());
        

        return $leave;
    }

    public function destroy($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->delete();
        return '';
    }
}
