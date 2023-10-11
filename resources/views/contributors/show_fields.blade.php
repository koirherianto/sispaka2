<!-- Project Id Field -->
<div class="col-sm-12">
    {!! Form::label('project_title', 'Project title:') !!}
    <p>{{ $contributor->project->title }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {{-- terdaftar? --}}
    {!! Form::label('user_id', 'Registerd') !!}
    <p>{{ $contributor->user->name ? 'Yes' : 'No'}}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $contributor->name }}</p>
</div>

<!-- Contribution Field -->
<div class="col-sm-12">
    {!! Form::label('contribution', 'Contribution:') !!}
    <p>{{ $contributor->contribution }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $contributor->email }}</p>
</div>

<!-- Link Field -->
<div class="col-sm-12">
    {!! Form::label('link', 'Link:') !!}
    <p>{{ $contributor->link }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $contributor->updated_at->format('d/m/Y | h:m') }}</p>
</div>

