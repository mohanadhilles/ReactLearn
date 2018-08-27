@inject('request', 'Illuminate\Http\Request')
@extends('employee.layouts')

@section('content')
    <h3 class="page-title">@lang('quickadmin.leave.title')</h3>
    <p>
        <a href="{{ route('employee.leaves.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @can('leave_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('employee.leaves.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('employee.leaves.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($leaves) > 0 ? 'datatable' : '' }} @can('leave_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('leave_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.leave.fields.day')</th>
                        <th>@lang('quickadmin.leave.fields.reason')</th>
                        <th>@lang('quickadmin.leave.fields.status')</th>
                        <th>@lang('leaves')</th>
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
                                @can('leave_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='day'>{{ $leaf->day }}</td>
                                <td field-key='reason'>{!! $leaf->reason !!}</td>
                                <td field-key='status'>{{ $leaf->status }}</td>
                                <td field-key='employee'>{{ $leaf->employee->name or '' }}</td>
                                <td>
                               <a href="{{ route('employee.leaves.show',[$leaf->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                </td>
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