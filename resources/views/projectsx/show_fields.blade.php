<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $project->title }}</p>
</div>

<!-- Status Publish Field -->
<div class="col-sm-12">
    {!! Form::label('status_publish', 'Status Publish:') !!}
    <p>{{ $project->status_publish }}</p>
</div>

<!-- Institution Field -->
<div class="col-sm-12">
    {!! Form::label('institution', 'Institution:') !!}
    <p>{{ $project->institution }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $project->description }}</p>
</div>

