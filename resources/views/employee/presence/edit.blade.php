@extends('employee.layouts')

@section('content')
    <h3 class="page-title">@lang('quickadmin.leave.title')</h3>

    {!! Form::model($presence, ['method' => 'PUT', 'route' => ['employee.presence.update',$presence->id]]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('end', 'ساعة الانصراف'.'*', ['class' => 'control-label']) !!}
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
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
