<?php

namespace App\Http\Controllers\Api\V1;

use App\PermissionsManagment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionsManagmentsRequest;
use App\Http\Requests\Admin\UpdatePermissionsManagmentsRequest;

class PermissionsManagmentsController extends Controller
{
    public function index()
    {
        return PermissionsManagment::all();
    }

    public function show($id)
    {
        return PermissionsManagment::findOrFail($id);
    }

    public function update(UpdatePermissionsManagmentsRequest $request, $id)
    {
        $permissions_managment = PermissionsManagment::findOrFail($id);
        $permissions_managment->update($request->all());
        

        return $permissions_managment;
    }

    public function store(StorePermissionsManagmentsRequest $request)
    {
        $permissions_managment = PermissionsManagment::create($request->all());
        

        return $permissions_managment;
    }

    public function destroy($id)
    {
        $permissions_managment = PermissionsManagment::findOrFail($id);
        $permissions_managment->delete();
        return '';
    }
}
