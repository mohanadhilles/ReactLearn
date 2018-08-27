@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.permissions-managment.title')</h3>
    @can('permissions_managment_create')
    <p>
        <a href="{{ route('admin.permissions_managments.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('permissions_managment_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.permissions_managments.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.permissions_managments.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


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
    </div>
@stop

@section('javascript') 
    <script>
        @can('permissions_managment_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.permissions_managments.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection