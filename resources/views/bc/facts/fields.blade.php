<input type="hidden" value="-" name="backward_chaining_id">

@if (!$isEditPage)
    @role('super-admin')
        <div class="form-group col-sm-6">
            {!! Form::label('project_id', 'Project:') !!}
            {!! Form::select('project_id', $projects->pluck('title', 'id'), null, ['class' => 'form-control', 'required']) !!}
        </div>
    @endrole

    @role(['individu', 'institution'])
        <input type="hidden" value="-" name="project_id">
    @endrole
@endif


<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 200,
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

<!-- Value Fact Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value_fact', 'Value Fact:') !!}
    {!! Form::number('value_fact', null, ['class' => 'form-control']) !!}
</div>
