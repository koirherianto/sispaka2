<div class="col-sm-12">
    {!! Form::label('user_id', 'User ') !!}
    <p>
        @foreach ($project->users as $user)
            {{ $user->name }}
            @if (!$loop->last)
                , {{-- Mencegah tanda koma di akhir daftar --}}
            @endif
        @endforeach
    </p>
</div>

<div class="col-sm-12">
    {!! Form::label('Method', 'Method:') !!}
    <p>
    @foreach ($project->methods as $method)
        {{ $method->name }}
        @if (!$loop->last)
            ,
        @endif
    @endforeach
    </p>
</div>

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

<div class="col-sm-12">
    {!! Form::label('created_at', 'Dibuat pada:') !!}
    <p>{{ $project->created_at->format('d/m/Y') }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('created_at', 'Diperbarui pada:') !!}
    <p>{{ $project->updated_at->format('d/m/Y') }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $project->description }}</p>
</div>
