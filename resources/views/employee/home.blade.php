<div class="modal fade" id="in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تسجيل حضور </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'POST', 'route' => ['employee.presence.store']]) !!}
                <input type="datetime" name="start" value="{{$start}}" class="form-control" placeholder="">
                <p class="help-block"></p>
                @if($errors->has('start'))
                    <p class="help-block">
                        {{ $errors->first('start') }}
                    </p>
                @endif
                <input type="hidden" name="employee_id" value="{{$emp_id}}" class="form-control" placeholder="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
