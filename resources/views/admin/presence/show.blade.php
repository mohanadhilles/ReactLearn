@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.leave.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.leave.fields.day')</th>
                            <td field-key='day'>{{ $leaf->day }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.leave.fields.reason')</th>
                            <td field-key='reason'>{!! $leaf->reason !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.leave.fields.status')</th>
                            <td field-key='status'>{{ $leaf->status }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.leave.fields.employee')</th>
                            <td field-key='employee'>{{ $leaf->employee->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.leaves.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop
