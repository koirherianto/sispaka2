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
    {!! Form::number('value_fact', null, ['class' => 'form-control', 'step' => 'any', 'min' => '0', 'max' => '10']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('image_fact', 'Image : (opsional)') !!}
    {!! Form::file('image_fact', ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('image_description', 'Image Description:') !!}
    {!! Form::text('image_description', isset($bcFact) && $bcFact->hasMedia('bc_fact') && count($bcFact->getMedia('bc_fact')) > 0 ? $bcFact->getMedia('bc_fact')[0]->getCustomProperty('description') : null, [
        'class' => 'form-control',
        'maxlength' => 125,
    ]) !!}
</div>


@if ($isEditPage && $bcFact->hasMedia('bc_fact'))
    <div class="form-group col-sm-12 col-lg-12">
        <label>Current Image:</label>
        <div class="">
            <img src="{{ $bcFact->getFirstMediaUrl('bc_fact') }}" alt="Current Image" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
        </div>
    </div>
@endif