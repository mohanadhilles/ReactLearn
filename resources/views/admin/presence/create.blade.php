@extends('layouts.app')

@section('content')
    <h3 class="page-title"> إدارة الحضور والانصراف</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.presence.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('start', 'ساعة الحضور','*', ['class' => 'control-label']) !!}
                    <input type="datetime" name="start" value="{{$start}}" class="form-control" placeholder="" required>

                    </button>
                    <p class="help-block"></p>
                    @if($errors->has('start'))
                        <p class="help-block">
                            {{ $errors->first('start') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('end', 'ساعة الانصراف', ['class' => 'control-label']) !!}
                    <input type="datetime" name="end" value="" class="form-control" placeholder="">
                    <p class="help-block"></p>
                    @if($errors->has('end'))
                        <p class="help-block">
                            {{ $errors->first('end') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('employee_id', trans('quickadmin.leave.fields.employee').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('employee_id', $employees, old('employee_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('employee_id'))
                        <p class="help-block">
                            {{ $errors->first('employee_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
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
                {{--locale: "{{ App::getLocale() }}",--}}
                sideBySide: true,
            });

        });
    </script>

@stop