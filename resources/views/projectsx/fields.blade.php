<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>

<!-- Status Publish Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_publish', 'Status Publish:') !!}
    {!! Form::text('status_publish', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Institution Field -->
<div class="form-group col-sm-6">
    {!! Form::label('institution', 'Institution:') !!}
    {!! Form::text('institution', null, ['class' => 'form-control', 'maxlength' => 45, 'maxlength' => 45, 'maxlength' => 45]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>