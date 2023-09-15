<!-- Project Id Field -->
<div class="col-sm-12">
    {!! Form::label('project_id', 'Project') !!}
    <p>{{ $fact->project->title }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $fact->name }}</p>
</div>

<!-- Code Name Field -->
<div class="col-sm-12">
    {!! Form::label('code_name', 'Code Name:') !!}
    <p>{{ $fact->code_name }}</p>
</div>

<!-- Value Fact Field -->
<div class="col-sm-12">
    {!! Form::label('value_fact', 'Value Fact:') !!}
    <p>{{ $fact->value_fact }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('created_at', 'Dibuat pada:') !!}
    <p>{{ $fact->created_at->format('d/m/Y') }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('created_at', 'Diperbarui pada:') !!}
    <p>{{ $fact->updated_at->format('d/m/Y') }}</p>
</div>

