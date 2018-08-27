@extends('employee.layouts')

@section('content')
    <h3 class="page-title">@lang('quickadmin.permissions-managment.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['employee.permissions.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('out', trans('quickadmin.permissions-managment.fields.out').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('out', old('out'), ['class' => 'form-control datetime', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('out'))
                        <p class="help-block">
                            {{ $errors->first('out') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('back', trans('quickadmin.permissions-managment.fields.back').'', ['class' => 'control-label']) !!}
                    {!! Form::text('back', old('back'), ['class' => 'form-control datetime', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('back'))
                        <p class="help-block">
                            {{ $errors->first('back') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('reason', trans('quickadmin.permissions-managment.fields.reason').'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('reason', old('reason'), ['class' => 'form-control ', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('reason'))
                        <p class="help-block">
                            {{ $errors->first('reason') }}
                        </p>
                    @endif
                </div>
            </div>
<input type="hidden" name="employee_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
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