<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PermissionsManagment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionsManagmentsRequest;
use App\Http\Requests\Admin\UpdatePermissionsManagmentsRequest;
class PermissionController extends Controller
{

    public function index()
    {
        $id = Auth::id();
        $permissions_managments = PermissionsManagment::where('employee_id' ,'=',$id)->get();
        return view('employee.permissions.index', compact('permissions_managments'));
    }


    public function create()
    {

        return view('employee.permissions.create');

    }


    public function store(StorePermissionsManagmentsRequest $request)
    {
        $permissions_managment = PermissionsManagment::create($request->all());

        return redirect()->route('employee.permissions.index');

    }


    public function show($id)
    {
        $permissions_managment = PermissionsManagment::findOrFail($id);

        return view('employee.permissions.show', compact('permissions_managment'));
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
