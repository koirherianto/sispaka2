<!-- Backward Chaining Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('backward_chaining_id', 'Backward Chaining Id:') !!}
    {!! Form::number('backward_chaining_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 200, 'maxlength' => 200, 'maxlength' => 200]) !!}
</div>

<!-- Code Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code_name', 'Code Name:') !!}
    {!! Form::text('code_name', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>

<!-- Reason Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reason', 'Reason:') !!}
    {!! Form::text('reason', null, ['class' => 'form-control', 'maxlength' => 250, 'maxlength' => 250, 'maxlength' => 250]) !!}
</div>

<!-- Solution Field -->
<div class="form-group col-sm-6">
    {!! Form::label('solution', 'Solution:') !!}
    {!! Form::text('solution', null, ['class' => 'form-control', 'maxlength' => 250, 'maxlength' => 250, 'maxlength' => 250]) !!}
</div>