@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.leave.title')</h3>

    {!! Form::model($presence, ['method' => 'PUT', 'route' => ['admin.presence.update',$presence->id]]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('start', 'ساعة الحضور', ['class' => 'control-label']) !!}
                    {{--{!! Form::text('day', old('day'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}--}}
                    <input type="datetime" name="start" value="{{old('start')}}" class="form-control" placeholder="" >

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
                    {!! Form::label('day', 'ساعة الانصراف', ['class' => 'control-label']) !!}
                    {{--{!! Form::text('day', old('day'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}--}}
                    <input type="datetime" name="end" value="{{$end}}" class="form-control" placeholder="" required>

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

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
