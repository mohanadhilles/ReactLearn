@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('quickadmin.qa_dashboard')</div>

                <div class="panel-body">
                    <div class="col-md-8 pull-right">

                        @can('employee')
                            <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#in"> تسجيل حضور</a>
                            {{--<a type="button" class="btn btn-danger" data-toggle="modal" data-target="#out">  تسجيل انصراف</a>--}}

                    </div>
                    @endcan
                </div>
                @can('employee')
                <table class="table table-bordered table-striped{{ count($presences) > 0 ? 'datatable' : '' }} @can('employee') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                            <thead>
                            <tr>
                                <th>ساعة الحضور </th>
                                <th>ساعة الانصراف</th>
                                <th>الاسم</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if (count($presences) > 0)
                                @foreach ($presences as $presence)
                                    <tr data-entry-id="{{ $presence->id }}">
                                        @can('leave_delete')
                                            @if ( request('show_deleted') != 1 )<td></td>@endif
                                        @endcan

                                        <td field-key='start'>{{ $presence->start }}</td>
                                        <td field-key='end'>{!! $presence->end !!}</td>
                                        <td field-key='employee'>{{ $presence->employee->name or '' }}</td>
                                        <td>
                                        <a href="{{ route('employee.presence.edit',[$presence->id]) }}" class="btn-sm btn-danger">تسجيل انصراف</a>
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
                    @include('employee.home')
                    @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection