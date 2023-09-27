@role('super-admin')
    <div class="form-group col-sm-6">
        {!! Form::label('user_id', 'User:') !!}
        {!! Form::select('user_id', $users->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
    </div>
@endrole

@role('individual')
    <input type="hidden" value="-" name="user_id">
@endrole

@if (!$isEditPage)
    <div class="form-group col-sm-6">
        {!! Form::label('method_id', 'Method:') !!}
        {!! Form::select('method_id', $methods->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
    </div>
@endif  

@if ($isEditPage)
    <div class="form-group col-sm-6">
        {!! Form::label('status_publish', 'Status Publish') !!}
        {!! Form::select(
            'status_publish',
            ['publish' => 'Publish', 'not_publish' => 'Not Publish'],
            $project->status_publish,
            ['class' => 'form-control'],
        ) !!}
    </div>
@else
    <input type="hidden" value="-" name="status_publish">
@endif



<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 100,
    ]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, [
        'class' => 'form-control',
        'maxlength' => 65535,
    ]) !!}
</div>
