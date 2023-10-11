<!-- Project Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('project_id', 'Project Id:') !!}
    {!! Form::number('project_id', null, ['class' => 'form-control', 'required']) !!}
</div> --}}

<input type="hidden" name="project_id" value="{{ $project->id }}">

<!-- User Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div> --}}

<input type="hidden" name="user_id" value="">

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 45,
    ]) !!}
</div>

<!-- Contribution Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contribution', 'Contribution:') !!}
    {!! Form::text('contribution', null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 45,
    ]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, [
        'class' => 'form-control',
        'maxlength' => 255,
    ]) !!}
</div>

<!-- Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, [
        'class' => 'form-control',
        'maxlength' => 255,
        'type' => 'url'
    ]) !!}
</div>