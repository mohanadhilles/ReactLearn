<?php

namespace App\Http\Controllers\Admin;

use App\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLeavesRequest;
use App\Http\Requests\Admin\UpdateLeavesRequest;

class LeavesController extends Controller
{
    /**
     * Display a listing of Leave.
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
            $leaves = Leave::onlyTrashed()->get();
        } else {
            $leaves = Leave::all();
        }

        return view('admin.leaves.index', compact('leaves'));
    }

    /**
     * Show the form for creating new Leave.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('leave_create')) {
            return abort(401);
        }
        
        $employees = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.leaves.create', compact('employees'));
    }

    /**
     * Store a newly created Leave in storage.
     *
     * @param  \App\Http\Requests\StoreLeavesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLeavesRequest $request)
    {
        if (! Gate::allows('leave_create')) {
            return abort(401);
        }
        $leave = Leave::create($request->all());



        return redirect()->route('admin.leaves.index');
    }


    /**
     * Show the form for editing Leave.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('leave_edit')) {
            return abort(401);
        }
        
        $employees = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $leave = Leave::findOrFail($id);

        return view('admin.leaves.edit', compact('leave', 'employees'));
    }

    /**
     * Update Leave in storage.
     *
     * @param  \App\Http\Requests\UpdateLeavesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLeavesRequest $request, $id)
    {
        if (! Gate::allows('leave_edit')) {
            return abort(401);
        }
        $leave = Leave::findOrFail($id);
        $leave->update($request->all());



        return redirect()->route('admin.leaves.index');
    }


    /**
     * Display Leave.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('leave_view')) {
            return abort(401);
        }
        $leave = Leave::findOrFail($id);

        return view('admin.leaves.show', compact('leave'));
    }


    /**
     * Remove Leave from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('leave_delete')) {
            return abort(401);
        }
        $leave = Leave::findOrFail($id);
        $leave->delete();

        return redirect()->route('admin.leaves.index');
    }

    /**
     * Delete all selected Leave at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('leave_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Leave::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Leave from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('leave_delete')) {
            return abort(401);
        }
        $leave = Leave::onlyTrashed()->findOrFail($id);
        $leave->restore();

        return redirect()->route('admin.leaves.index');
    }

    /**
     * Permanently delete Leave from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('leave_delete')) {
            return abort(401);
        }
        $leave = Leave::onlyTrashed()->findOrFail($id);
        $leave->forceDelete();

        return redirect()->route('admin.leaves.index');
    }
}
