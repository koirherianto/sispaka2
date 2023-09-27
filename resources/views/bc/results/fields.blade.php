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


<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('reason', 'Reason:') !!}
    {!! Form::textarea('reason', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
    ]) !!}
</div>

<!-- Solution Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('solution', 'Solution:') !!}
    {!! Form::textarea('solution', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
    ]) !!}
</div>

<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('image_result', 'Image : (opsional)') !!}
    {!! Form::file('image_result', ['class' => 'form-control']) !!}
</div>

@if ($isEditPage && $bcResult->hasMedia('bc_result'))
    <div class="form-group col-sm-12 col-lg-12">
        <label>Current Image:</label>
        <div class="">
            <img src="{{ $bcResult->getFirstMediaUrl('bc_result') }}" alt="Current Image" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
        </div>
    </div>
@endif
