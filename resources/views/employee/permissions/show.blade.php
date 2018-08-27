@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.permissions-managment.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.permissions-managment.fields.out')</th>
                            <td field-key='out'>{{ $permissions_managment->out }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.permissions-managment.fields.back')</th>
                            <td field-key='back'>{{ $permissions_managment->back }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.permissions-managment.fields.reason')</th>
                            <td field-key='reason'>{!! $permissions_managment->reason !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.permissions-managment.fields.employee')</th>
                            <td field-key='employee'>{{ $permissions_managment->employee->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('employee.permissions.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
@stop
