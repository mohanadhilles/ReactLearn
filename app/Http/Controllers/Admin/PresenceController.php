<?php

namespace App\Http\Controllers\Admin;

use App\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePresenceRequest;
use App\Http\Requests\Admin\StorePermissionsManagmentsRequest;
use App\User;
use Carbon\Carbon;
use App\Role;
class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('leave_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('leave_delete')) {
                return abort(401);
            }
            $presences = Presence::onlyTrashed()->get();
        } else {
            $presences = Presence::all();
        }

        return view('admin.presence.index', compact('presences'));
    }

    public function create()
    {
        $start = Carbon::now()->toDateTimeString();
        $end = Carbon::now()->toDateTimeString();

        if (! Gate::allows('leave_create')) {
            return abort(401);
        }

        $employees = User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.presence.create', compact('employees', 'start','end' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (! Gate::allows('leave_create')) {
            return abort(401);
        }

        $leave = Presence::create($request->all());


        return redirect()->route('admin.presence.index');
    }


    public function show($id )
    {
        if (! Gate::allows('permissions_managment_view')) {
            return abort(401);
        }
        $leaf = Presence::findOrFail($id);

        return view('admin.presence.show', compact('leaf'));

    }

    public function edit($id)
    {
        $start = Carbon::now()->toDateTimeString();
        $end = Carbon::now()->toDateTimeString();

        if (! Gate::allows('leave_create')) {
            return abort(401);
        }

        $employees = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $presence = Presence::findOrFail($id);
        $id = Presence::find($id);

        return view('admin.presence.edit', compact('presence','employees', 'start','end','id'));


    }


    public function update(Request $request,  $id)
    {
        if (! Gate::allows('permissions_managment_edit')) {
            return abort(401);
        }
        $presence = Presence::findOrFail($id);
        $presence->update($request->all());
        return redirect()->route('admin.presence.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function destroy($id )
    {
        if (! Gate::allows('permissions_managment_delete')) {
            return abort(401);
        }
        $presence = Presence::findOrFail($id);
        $presence->delete();

        return redirect()->route('admin.presence.index');
    }
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('permissions_managment_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Presence::whereIn('id', $request->input('ids'))->get();

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
        $presence = Presence::onlyTrashed()->findOrFail($id);
        $presence->restore();

        return redirect()->route('admin.presence.index');
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
        $presence = Presence::onlyTrashed()->findOrFail($id);
        $presence->forceDelete();

        return redirect()->route('admin.$presence.index');
    }
}
