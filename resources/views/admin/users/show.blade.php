@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.role')</th>
                            <td field-key='role'>{{ $user->role->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.phone')</th>
                            <td field-key='phone'>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.position')</th>
                            <td field-key='position'>{{ $user->position }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#permissions_managment" aria-controls="permissions_managment" role="tab" data-toggle="tab">إدارة الاذونات</a></li>
<li role="presentation" class=""><a href="#leave" aria-controls="leave" role="tab" data-toggle="tab">إدارة الاجازات</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="permissions_managment">
<table class="table table-bordered table-striped {{ count($permissions_managments) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.permissions-managment.fields.out')</th>
                        <th>@lang('quickadmin.permissions-managment.fields.back')</th>
                        <th>@lang('quickadmin.permissions-managment.fields.reason')</th>
                        <th>@lang('quickadmin.permissions-managment.fields.employee')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($permissions_managments) > 0)
            @foreach ($permissions_managments as $permissions_managment)
                <tr data-entry-id="{{ $permissions_managment->id }}">
                    <td field-key='out'>{{ $permissions_managment->out }}</td>
                                <td field-key='back'>{{ $permissions_managment->back }}</td>
                                <td field-key='reason'>{!! $permissions_managment->reason !!}</td>
                                <td field-key='employee'>{{ $permissions_managment->employee->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('permissions_managment_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.permissions_managments.restore', $permissions_managment->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('permissions_managment_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.permissions_managments.perma_del', $permissions_managment->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('permissions_managment_view')
                                    <a href="{{ route('admin.permissions_managments.show',[$permissions_managment->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('permissions_managment_edit')
                                    <a href="{{ route('admin.permissions_managments.edit',[$permissions_managment->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('permissions_managment_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.permissions_managments.destroy', $permissions_managment->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="leave">
<table class="table table-bordered table-striped {{ count($leaves) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('leaves')</th>
                        <th>@lang('quickadmin.leave.fields.reason')</th>
                        <th>@lang('quickadmin.leave.fields.status')</th>
                        <th>@lang('quickadmin.leave.fields.employee')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($leaves) > 0)
            @foreach ($leaves as $leaf)
                <tr data-entry-id="{{ $leaf->id }}">
                    <td field-key='day'>{{ $leaf->day }}</td>
                                <td field-key='reason'>{!! $leaf->reason !!}</td>
                                <td field-key='status'>{{ $leaf->status }}</td>
                                <td field-key='employee'>{{ $leaf->employee->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('leave_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.leaves.restore', $leaf->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('leave_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.leaves.perma_del', $leaf->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('leave_view')
                                    <a href="{{ route('admin.leaves.show',[$leaf->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('leave_edit')
                                    <a href="{{ route('admin.leaves.edit',[$leaf->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('leave_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.leaves.destroy', $leaf->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


