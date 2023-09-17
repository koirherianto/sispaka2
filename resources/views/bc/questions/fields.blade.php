<div class="form-group col-sm-6">
    {!! Form::label('bc_result_id', 'BC Result:') !!}
    {!! Form::select('bc_result_id', $bcResults->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('bc_fact_id', 'BC Fact:') !!}
    {!! Form::select('bc_fact_id', $bcFacts->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Question Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question', 'Question:') !!}
    {!! Form::text('question', null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 254,
    ]) !!}
</div>

<!-- Code Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code_name', 'Code Name:') !!}
    {!! Form::text('code_name', null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 100,
    ]) !!}
</div>
