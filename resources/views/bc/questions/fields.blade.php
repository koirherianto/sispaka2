<!-- Bc Result Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bc_result_id', 'Bc Result Id:') !!}
    {!! Form::number('bc_result_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Bc Fact Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bc_fact_id', 'Bc Fact Id:') !!}
    {!! Form::number('bc_fact_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Question Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question', 'Question:') !!}
    {!! Form::text('question', null, ['class' => 'form-control', 'required', 'maxlength' => 254, 'maxlength' => 254, 'maxlength' => 254]) !!}
</div>

<!-- Code Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code_name', 'Code Name:') !!}
    {!! Form::text('code_name', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>