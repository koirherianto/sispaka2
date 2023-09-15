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

<!-- Value Fact Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value_fact', 'Value Fact:') !!}
    {!! Form::number('value_fact', null, ['class' => 'form-control']) !!}
</div>