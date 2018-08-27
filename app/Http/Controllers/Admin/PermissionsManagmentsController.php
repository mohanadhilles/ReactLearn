<?php

namespace App\Http\Controllers\Admin;

use App\PermissionsManagment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionsManagmentsRequest;
use App\Http\Requests\Admin\UpdatePermissionsManagmentsRequest;

class PermissionsManagmentsController extends Controller
{
    /**
     * Display a listing of PermissionsManagment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('permissions_managment_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('permissions_managment_delete')) {
                return abort(401);
            }
            $permissions_managments = PermissionsManagment::onlyTrashed()->get();
        } else {
            $permissions_managments = PermissionsManagment::all();
        }

        return view('admin.permissions_managments.index', compact('permissions_managments'));
    }

    /**
     * Show the form for creating new PermissionsManagment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('permissions_managment_create')) {
            return abort(401);
        }
        
        $employees = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.permissions_managments.create', compact('employees'));
    }

    /**
     * Store a newly created PermissionsManagment in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsManagmentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionsManagmentsRequest $request)
    {
        if (! Gate::allows('permissions_managment_create')) {
            return abort(401);
        }
        $permissions_managment = PermissionsManagment::create($request->all());



        return redirect()->route('admin.permissions_managments.index');
    }


    /**
     * Show the form for editing PermissionsManagment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('permissions_managment_edit')) {
            return abort(401);
        }
        
        $employees = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $permissions_managment = PermissionsManagment::findOrFail($id);

        return view('admin.permissions_managments.edit', compact('permissions_managment', 'employees'));
    }

    /**
     * Update PermissionsManagment in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsManagmentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionsManagmentsRequest $request, $id)
    {
        if (! Gate::allows('permissions_managment_edit')) {
            return abort(401);
        }
        $permissions_managment = PermissionsManagment::findOrFail($id);
        $permissions_managment->update($request->all());



        return redirect()->route('admin.permissions_managments.index');
    }


    /**
     * Display PermissionsManagment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('permissions_managment_view')) {
            return abort(401);
        }
        $permissions_managment = PermissionsManagment::findOrFail($id);

        return view('admin.permissions_managments.show', compact('permissions_managment'));
    }


    /**
     * Remove PermissionsManagment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('permissions_managment_delete')) {
            return abort(401);
        }
        $permissions_managment = PermissionsManagment::findOrFail($id);
        $permissions_managment->delete();

        return redirect()->route('admin.permissions_managments.index');
    }

    /**
     * Delete all selected PermissionsManagment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('permissions_managment_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = PermissionsManagment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore PermissionsManagment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('permissions_managment_delete')) {
            return abort(401);
        }
        $permissions_managment = PermissionsManagment::onlyTrashed()->findOrFail($id);
        $permissions_managment->restore();

        return redirect()->route('admin.permissions_managments.index');
    }

    /**
     * Permanently delete PermissionsManagment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('permissions_managment_delete')) {
            return abort(401);
        }
        $permissions_managment = PermissionsManagment::onlyTrashed()->findOrFail($id);
        $permissions_managment->forceDelete();

        return redirect()->route('admin.permissions_managments.index');
    }
}
