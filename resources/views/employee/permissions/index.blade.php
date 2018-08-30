@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.permissions-managment.title')</h3>
        <p>
            <a href="{{ route('employee.permissions.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>

        </p>


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($permissions_managments) > 0 ? 'datatable' : '' }} @can('permissions_managment_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                <tr>
                    @can('permissions_managment_delete')
                        @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                    @endcan

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
                            @can('permissions_managment_delete')
                                @if ( request('show_deleted') != 1 )<td></td>@endif
                            @endcan

                            <td field-key='out'>{{ $permissions_managment->out }}</td>
                            <td field-key='back'>{{ $permissions_managment->back }}</td>
                            <td field-key='reason'>{!! $permissions_managment->reason !!}</td>
                            <td field-key='employee'>{{ $permissions_managment->employee->name or '' }}</td>
                            @if( request('show_deleted') == 1 )
                            @else
                                <td>
                               <a href="{{ route('employee.permissions.show',[$permissions_managment->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                               <a href="{{ route('employee.permissions.edit',[$permissions_managment->id]) }}" class="btn btn-xs btn-info"> تسجيل ساعة العودة</a>
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
@stop

@section('javascript')

@endsection